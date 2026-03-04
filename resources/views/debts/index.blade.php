@extends('layouts.app')

@section('content')
<div class="p-8 min-h-screen" style="background-color: #F5F0A0;">

    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold mb-1 text-black">Équilibre des comptes</h1>
        <p class="mb-8 text-lg font-medium" style="color: #8B2020;">{{ $colocation->name }}</p>

        @if(session('success'))
            <div class="p-4 rounded-xl mb-6 font-bold shadow-sm" style="background-color: #B85C38; color: #F5F0A0;">
                {{ session('success') }}
            </div>
        @endif

        @if(count($debts) === 0)
            <div class="p-10 rounded-2xl text-center border-2 border-dashed border-black/10">
                <p class="text-xl font-bold text-black/40">Tout est réglé</p>
            </div>
        @else
            <div class="grid gap-3">
                @foreach($debts as $debt)
                <div class="bg-white p-6 rounded-xl flex flex-wrap items-center justify-between shadow-sm border border-gray-100">
                    
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center text-white font-bold" style="background-color: #8B2020;">
                            {{ substr($debt['debtor']->name, 0, 1) }}
                        </div>
                        <div>
                            <span class="font-bold text-gray-900">{{ $debt['debtor']->name }}</span>
                            <span class="text-gray-500 mx-2">doit à</span>
                            <span class="font-bold text-gray-900">{{ $debt['creditor']->name }}</span>
                        </div>
                    </div>

                    <div class="flex items-center gap-6">
                        <span class="text-2xl font-black" style="color: #B85C38;">{{ number_format($debt['amount'], 2) }} €</span>

                        @if(auth()->id() === $debt['debtor_id'])
                            <form action="{{ route('payments.markAsPaid') }}" method="POST">
                                @csrf
                                <input type="hidden" name="colocation_id" value="{{ $colocation->id }}">
                                <input type="hidden" name="debtor_id"     value="{{ $debt['debtor_id'] }}">
                                <input type="hidden" name="creditor_id"   value="{{ $debt['creditor_id'] }}">
                                <input type="hidden" name="amount"        value="{{ $debt['amount'] }}">
                                <button class="px-5 py-2 rounded-lg font-bold text-sm transition-transform active:scale-95 shadow-md"
                                        style="background-color: #000000; color: #F5F0A0;">
                                    Régler la dette
                                </button>
                            </form>
                        @else
                             <span class="px-3 py-1 bg-gray-100 text-gray-400 rounded text-xs font-bold tracking-widest uppercase">En attente</span>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        @endif

        <div class="mt-10 flex justify-center">
            <a href="{{ route('colocations.show', $colocation) }}"
               class="px-8 py-3 rounded-xl font-bold transition-all hover:bg-gray-900 shadow-lg"
               style="background-color: #000000; color: #F5F0A0;">
                Retour au tableau de bord
            </a>
        </div>
    </div>
</div>
@endsection