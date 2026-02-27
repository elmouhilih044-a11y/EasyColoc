@extends('layouts.app')

@section('content')
<div class="p-8 min-h-screen" style="background-color: #F5F0A0;">

    <h1 class="text-3xl font-bold mb-2" style="color: #000000;">Qui doit quoi à qui ?</h1>
    <p class="mb-6" style="color: #8B2020;">Colocation : <b>{{ $colocation->name }}</b></p>

    @if(session('success'))
        <div class="p-4 rounded-lg mb-4" style="background-color: #B85C38; color: #F5F0A0;">
            {{ session('success') }}
        </div>
    @endif

    @if(count($debts) === 0)
        <div class="p-6 rounded-xl text-center" style="background-color: #6B1A1A; color: #F5F0A0;">
            Aucune dette — tout est réglé !
        </div>
    @else
        <div class="grid gap-4">
            @foreach($debts as $debt)
            <div class="p-5 rounded-xl flex items-center justify-between shadow"
                 style="background-color: white; border-left: 5px solid #B85C38;">

                <div>
                    <span class="font-bold text-lg" style="color: #8B2020;">{{ $debt['debtor']->name }}</span>
                    <span style="color: #000000;"> doit </span>
                    <span class="font-bold text-lg" style="color: #070006;">{{ $debt['creditor']->name }}</span>
                </div>

                <div class="flex items-center gap-4">
                    <span class="text-2xl font-bold" style="color: #B85C38;">{{ $debt['amount'] }} €</span>

                    {{-- Le débiteur clique quand il a donné l'argent --}}
                    @if(auth()->user()->id === $debt['debtor_id'])
                        <form action="{{ route('debts.markAsPaid', $colocation) }}" method="POST">
                            @csrf
                            <input type="hidden" name="debtor_id"   value="{{ $debt['debtor_id'] }}">
                            <input type="hidden" name="creditor_id" value="{{ $debt['creditor_id'] }}">
                            <input type="hidden" name="amount"      value="{{ $debt['amount'] }}">
                            <button class="px-3 py-2 rounded font-semibold text-sm"
                                    style="background-color: #000000; color: #F5F0A0;">
                                Marquer payé
                            </button>
                        </form>
                    @endif
                </div>

            </div>
            @endforeach
        </div>
    @endif

    <a href="{{ route('colocations.show', $colocation) }}"
       class="block mt-6 text-center px-4 py-2 rounded font-semibold w-48 mx-auto"
       style="background-color: #000000; color: #F5F0A0;">
        Retour
    </a>
</div>
@endsection