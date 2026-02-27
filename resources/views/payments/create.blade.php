@extends('layouts.app')

@section('content')
<div class="min-h-screen flex justify-center items-center" style="background-color: #F5F0A0;">
    <div class="bg-white p-8 rounded-xl shadow w-96">

        <h1 class="text-2xl font-bold mb-5" style="color: #4A1040;">Ajouter Paiement</h1>

        <form action="{{ route('payments.store') }}" method="POST">
            @csrf

            <input type="number" step="0.01" name="amount" placeholder="Montant"
                   class="w-full border p-2 mb-3 rounded">

            <input type="date" name="payed_date"
                   class="w-full border p-2 mb-3 rounded">

            <select name="payer_id" class="w-full border p-2 mb-3 rounded">
                <option value="">-- Payeur --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>

            <select name="receiver_id" class="w-full border p-2 mb-3 rounded">
                <option value="">-- Receveur --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>

            <button class="w-full p-2 rounded text-white font-semibold"
                    style="background-color: #8B2020;">Enregistrer</button>
        </form>

        <a href="{{ route('payments.index') }}"
           class="block mt-4 text-center font-semibold"
           style="color: #4A1040;">Retour</a>
    </div>
</div>
@endsection