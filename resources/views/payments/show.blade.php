@extends('layouts.app')

@section('content')
<div class="min-h-screen flex justify-center items-center" style="background-color: #F5F0A0;">
    <div class="bg-white p-8 rounded-xl shadow w-96">

        <h1 class="text-2xl font-bold mb-4" style="color: #4A1040;">Détails Paiement</h1>

        <p class="mb-2"><b>Montant :</b> {{ $payment->amount }} €</p>
        <p class="mb-2"><b>Date :</b> {{ $payment->payed_date }}</p>
        <p class="mb-2"><b>Payeur :</b> {{ $payment->payer->name }}</p>
        <p class="mb-4"><b>Receveur :</b> {{ $payment->receiver->name }}</p>

        <a href="{{ route('payments.index') }}"
           class="px-4 py-2 rounded text-white font-semibold"
           style="background-color: #4A1040;">Retour</a>
    </div>
</div>
@endsection