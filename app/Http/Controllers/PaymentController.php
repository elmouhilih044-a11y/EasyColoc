<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\User;
use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with(['payer', 'receiver'])->get();
        return view('payments.index', compact('payments'));
    }

    public function create()
    {
        $users = User::all();
        return view('payments.create', compact('users'));
    }

    public function store(StorePaymentRequest $request)
    {
        Payment::create($request->validated());
        return redirect()->route('payments.index')->with('success', 'Paiement créé !');
    }

    public function show(Payment $payment)
    {
        return view('payments.show', compact('payment'));
    }

    public function edit(Payment $payment)
    {
        $users = User::all();
        return view('payments.edit', compact('payment', 'users'));
    }

    public function update(UpdatePaymentRequest $request, Payment $payment)
    {
        $payment->update($request->validated());
        return redirect()->route('payments.index')->with('success', 'Paiement mis à jour !');
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();
        return redirect()->route('payments.index')->with('success', 'Paiement supprimé !');
    }
}