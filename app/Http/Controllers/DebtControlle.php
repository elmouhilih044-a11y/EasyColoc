<?php

namespace App\Http\Controllers;

use App\Models\Colocation;
use App\Models\Expense;
use App\Models\Payment;
use App\Models\Membership;

class DebtController extends Controller
{
    public function index(Colocation $colocation)
    {
        $debts = $this->calculateDebts($colocation);
        return view('debts.index', compact('debts', 'colocation'));
    }

    public function markAsPaid(Colocation $colocation)
    {
        Payment::create([
            'amount'      => request('amount'),
            'payed_date'  => now(),
            'payer_id'    => request('debtor_id'),
            'receiver_id' => request('creditor_id'),
        ]);

        return redirect()->route('debts.index', $colocation)
                         ->with('success', 'Paiement marqué !');
    }

    private function calculateDebts(Colocation $colocation)
    {
        $memberships = Membership::with('user')
            ->where('colocation_id', $colocation->id)
            ->whereNull('left_at')
            ->get();

        $memberCount = $memberships->count();
        if ($memberCount === 0) return [];

        $memberIds = $memberships->pluck('user_id')->toArray();

        // Total dépensé par chaque membre
        $paid = [];
        foreach ($memberIds as $id) {
            $paid[$id] = 0;
        }

        $expenses = Expense::whereIn('user_id', $memberIds)
            ->whereHas('category', fn($q) => $q->where('colocation_id', $colocation->id))
            ->get();

        foreach ($expenses as $expense) {
            $paid[$expense->user_id] += $expense->amount;
        }

        // Part équitable
        $total = array_sum($paid);
        $share = $total / $memberCount;

        // Solde de chaque membre
        $balances = [];
        foreach ($memberIds as $id) {
            $balances[$id] = round($paid[$id] - $share, 2);
        }

        // Déduire les payments déjà effectués
        $payments = Payment::whereIn('payer_id', $memberIds)
                           ->whereIn('receiver_id', $memberIds)
                           ->get();

        foreach ($payments as $payment) {
            $balances[$payment->payer_id]    -= $payment->amount;
            $balances[$payment->receiver_id] += $payment->amount;
        }

        // Construire la liste des dettes
        $users    = $memberships->pluck('user', 'user_id');
        $debts    = [];
        $debtors  = array_filter($balances, fn($b) => $b < 0);
        $creditors= array_filter($balances, fn($b) => $b > 0);

        asort($debtors);
        arsort($creditors);

        while (!empty($debtors) && !empty($creditors)) {
            $debtorId   = array_key_first($debtors);
            $creditorId = array_key_first($creditors);
            $amount     = min(abs($debtors[$debtorId]), $creditors[$creditorId]);

            $debts[] = [
                'debtor'     => $users[$debtorId],
                'creditor'   => $users[$creditorId],
                'debtor_id'  => $debtorId,
                'creditor_id'=> $creditorId,
                'amount'     => round($amount, 2),
            ];

            $debtors[$debtorId]   += $amount;
            $creditors[$creditorId] -= $amount;

            if (abs($debtors[$debtorId]) < 0.01)   unset($debtors[$debtorId]);
            if (abs($creditors[$creditorId]) < 0.01) unset($creditors[$creditorId]);
        }

        return $debts;
    }
}