<?php

namespace App\Http\Controllers;

use App\Models\Payment;

class PaymentController extends Controller
{
    public function markAsPaid()
    {
        Payment::create([
            'amount'      => request('amount'),
            'payed_date'  => now(),
            'payer_id'    => request('debtor_id'),
            'receiver_id' => request('creditor_id'),
        ]);

        return redirect()->route('debts.index', request('colocation_id'))->with('success', 'Paiement marqué !');
    }
}