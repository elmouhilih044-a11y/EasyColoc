<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function markAsPaid()
    {
        $colocationId = request('colocation_id');
        $debtorId     = request('debtor_id');
        $creditorId   = request('creditor_id');

        if (Auth::id() !== (int) $debtorId) {
            return redirect()->back()->with('error', 'Vous ne pouvez marquer que vos propres dettes.');
        }

        Payment::create([
            'amount'      => request('amount'),
            'payed_date'  => now(),
            'payer_id'    => $debtorId,
            'receiver_id' => $creditorId,
        ]);

        return redirect()->route('debts.index', $colocationId)->with('success', 'Paiement marqué !');
    }
}