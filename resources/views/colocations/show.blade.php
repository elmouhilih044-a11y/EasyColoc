@extends('layouts.app')

@section('content')
<div class="min-h-screen flex justify-center items-center" style="background-color: #F5F0A0;">
    <div class="bg-white p-8 rounded-xl shadow w-96">

        <h1 class="text-2xl font-bold mb-4" style="color: #000000;">Détails Colocation</h1>

        <p class="mb-2"><b>Nom :</b> {{ $colocation->name }}</p>
        <p class="mb-2"><b>Description :</b> {{ $colocation->description }}</p>
        <p class="mb-4">
            <b>Statut :</b>
            <span class="px-2 py-1 rounded text-white text-sm"
                  style="background-color: {{ $colocation->status === 'active' ? '#B85C38' : '#8B2020' }};">
                {{ $colocation->status }}
            </span>
        </p>

        <a href="{{ route('debts.index', $colocation) }}"
           class="block text-center px-4 py-2 rounded font-semibold mt-3"
           style="background-color: #B85C38; color: #F5F0A0;">
            Qui doit quoi à qui ?
        </a>

        {{-- Formulaire invitation (owner uniquement) --}}
        @if(auth()->user()->role === 'owner')
        <div class="mt-4">
            <h2 class="font-bold mb-2" style="color: #000000;">Inviter un membre</h2>
            <form action="{{ route('invitations.store', $colocation) }}" method="POST" class="flex gap-2">
                @csrf
                <input type="email" name="email" placeholder="Email de l'invité"
                       class="border p-2 rounded flex-1">
                <button class="px-4 py-2 rounded text-white font-semibold"
                        style="background-color: #B85C38;">Inviter</button>
            </form>
        </div>
        @endif

        {{-- Bouton Quitter --}}
        @if($membership)
            @if($membership->left_at === null)
                <form action="{{ route('memberships.leave', $membership) }}" method="POST" class="mt-4">
                    @csrf
                    <button class="w-full px-3 py-2 rounded text-white font-semibold"
                            style="background-color: #8B2020;">
                        Quitter la colocation
                    </button>
                </form>
            @else
                <p class="mt-4 px-3 py-2 rounded text-white text-sm text-center"
                   style="background-color: #D4894A;">
                    Quitté le {{ $membership->left_at }}
                </p>
            @endif
        @endif

        <a href="{{ route('colocations.index') }}"
           class="block text-center px-4 py-2 rounded text-white font-semibold mt-4"
           style="background-color: #4A1040;">Retour</a>

    </div>
</div>
@endsection