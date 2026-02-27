@extends('layouts.app')

@section('content')
<div class="min-h-screen flex justify-center items-center" style="background-color: #F5F0A0;">
    <div class="bg-white p-8 rounded-xl shadow w-96">

        <h1 class="text-2xl font-bold mb-5" style="color: #4A1040;">Modifier Paiement</h1>

        <form action="{{ route('payments.update', $payment) }}" method="POST">
            @csrf @method('PUT')

            <input type="number" step="0.01" name="amount" value="{{ $payment->amount }}"
                   class="w-full border p-2 mb-3 rounded">

            <input type="date" name="payed_date" value="{{ $payment->payed_date }}"
                   class="w-full border p-2 mb-3 rounded">

            <select name="payer_id" class="w-full border p-2 mb-3 rounded">
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $payment->payer_id == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>

            <select name="receiver_id" class="w-full border p-2 mb-3 rounded">
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $payment->receiver_id == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>

            <button class="w-full p-2 rounded text-white font-semibold"
                    style="background-color: #B85C38;">Mettre à jour</button>
        </form>

        <a href="{{ route('payments.index') }}"
           class="block mt-4 text-center font-semibold"
           style="color: #4A1040;">Retour</a>
    </div>
</div>
@endsection