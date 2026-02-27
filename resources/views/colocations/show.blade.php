@extends('layouts.app')

@section('content')
<div class="min-h-screen flex justify-center items-center" style="background-color: #F5F0A0;">
    <div class="bg-white p-8 rounded-xl shadow w-96">

        <h1 class="text-2xl font-bold mb-4" style="color: #4A1040;">Détails Colocation</h1>

        <p class="mb-2"><b>Nom :</b> {{ $colocation->name }}</p>
        <p class="mb-2"><b>Description :</b> {{ $colocation->description }}</p>
        <p class="mb-4">
            <b>Statut :</b>
            <span class="px-2 py-1 rounded text-white text-sm"
                  style="background-color: {{ $colocation->status === 'active' ? '#B85C38' : '#8B2020' }};">
                {{ $colocation->status }}
            </span>
        </p>

        {{-- Bouton Quitter --}}
        @if($membership)
            @if($membership->left_at === null)
                <form action="{{ route('memberships.leave', $membership) }}" method="POST" class="mb-4">
                    @csrf
                    <button class="w-full px-3 py-2 rounded text-white font-semibold"
                            style="background-color: #8B2020;">
                        Quitter la colocation
                    </button>
                </form>
            @else
                <p class="mb-4 px-3 py-2 rounded text-white text-sm text-center"
                   style="background-color: #D4894A;">
                    Quitté le {{ $membership->left_at }}
                </p>
            @endif
        @endif

        <a href="{{ route('colocations.index') }}"
           class="block text-center px-4 py-2 rounded text-white font-semibold"
           style="background-color: #4A1040;">Retour</a>
    </div>
</div>
@endsection