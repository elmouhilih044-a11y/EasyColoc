@extends('layouts.app')

@section('content')
<div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8" style="background-color: #F5F0A0;">
    <div class="max-w-4xl mx-auto">
        @if (session('success'))
    <div style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div style="background-color: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
        {{ session('error') }}
    </div>
@endif

@if ($errors->any())
    <div style="background-color: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        <div class="bg-white rounded-t-2xl shadow-sm p-8 border-b border-gray-100">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">
                        {{ $colocation->name }}
                    </h1>
                    <p class="mt-2 text-lg text-gray-600 italic">
                        {{ $colocation->description }}
                    </p>
                </div>
                <div>
                    <span class="inline-flex items-center px-4 py-1.5 rounded-full text-sm font-bold text-white shadow-sm"
                          style="background-color: {{ $colocation->status === 'active' ? '#B85C38' : '#8B2020' }};">
                        {{ strtoupper($colocation->status) }}
                    </span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
            
            <div class="md:col-span-1 space-y-4">
                <div class="bg-white p-6 rounded-2xl shadow-sm">
                    <h2 class="text-sm font-semibold text-gray-400 uppercase tracking-wider mb-4">Gestion</h2>
                    
                    @if($membership && $membership->left_at === null)
                        <a href="{{ route('colocations.expenses.index', $colocation) }}" 
                           class="flex items-center justify-center w-full px-4 py-3 mb-3 rounded-xl font-bold transition-transform hover:scale-105"
                           style="background-color: #D4894A; color: #F5F0A0;">
                            Voir les Dépenses
                        </a>

                        <a href="{{ route('colocations.categories.index', $colocation) }}" 
                           class="flex items-center justify-center w-full px-4 py-3 mb-3 rounded-xl font-bold transition-transform hover:scale-105 border-2"
                           style="border-color: #D4894A; color: #D4894A;">
                            Gérer les Catégories
                        </a>

                        <a href="{{ route('colocations.expenses.create', $colocation) }}" 
                           class="flex items-center justify-center w-full px-4 py-3 mb-3 rounded-xl font-bold text-white transition-transform hover:scale-105"
                           style="background-color: #8B2020;">
                            Nouvelle Dépense
                        </a>
                    @endif

                    <a href="{{ route('debts.index', $colocation) }}" 
                       class="flex items-center justify-center w-full px-4 py-3 rounded-xl font-bold transition-transform hover:scale-105"
                       style="background-color: #B85C38; color: #F5F0A0;">
                        Équilibre des dettes
                    </a>
                </div>

                <a href="{{ route('colocations.index') }}" 
                   class="flex items-center justify-center w-full px-4 py-3 rounded-xl font-bold bg-black text-white hover:bg-gray-800 transition-colors">
                    Retour à la liste
                </a>
            </div>

            <div class="md:col-span-2 space-y-6">
                
                @if($membership)
                    <div class="p-6 rounded-xl border flex flex-col md:flex-row md:items-center md:justify-between gap-4 {{ $membership->left_at ? 'bg-gray-100 border-gray-300' : 'bg-green-50 border-green-200' }}">
                        <div>
                            <span class="text-sm font-medium {{ $membership->left_at ? 'text-gray-600' : 'text-green-800' }}">
                                @if($membership->left_at)
                                    Vous avez quitté cette colocation le {{ $membership->left_at }}
                                @else
                                    Vous êtes membre actif (Rôle: {{ ucfirst($membership->role) }})
                                @endif
                            </span>
                        </div>
                        
                        @if($membership->left_at === null)
                            @php
                                $activeMembersCount = $members->whereNull('left_at')->count();
                            @endphp

                            @if($membership->role !== 'owner' || $activeMembersCount === 1)
                                <form action="{{ route('memberships.leave', $membership) }}" method="POST">
                                    @csrf
                                    <button type="submit" 
                                            onclick="return confirm('{{ $activeMembersCount === 1 ? 'Vous êtes le dernier membre. Quitter rendra la colocation inactive. Confirmer ?' : 'Êtes-vous sûr de vouloir quitter cette colocation ?' }}')"
                                            class="px-6 py-2 rounded-xl text-white font-bold transition-transform hover:scale-105 shadow-md"
                                            style="background-color: #8B2020;">
                                        Quitter la colocation
                                    </button>
                                </form>
                            @else
                                <span class="text-xs font-bold text-red-700 bg-red-100 px-3 py-2 rounded-lg border border-red-200">
                                    Propriétaire : Transférez la propriété pour quitter (il reste des membres).
                                </span>
                            @endif
                        @endif
                    </div>
                @endif

                @if($membership && $membership->role === 'owner')
                    <div class="bg-white p-8 rounded-2xl shadow-sm border-l-4 border-black">
                        <h3 class="text-xl font-bold text-gray-900 mb-6">Panneau d'Administration</h3>
                        
                        <div class="mb-8">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Inviter un nouveau colocataire</label>
                            <form action="{{ route('invitations.store', $colocation) }}" method="POST" class="flex gap-2">
                                @csrf
                                <input type="email" name="email" placeholder="email@exemple.com" required
                                       class="flex-1 border-gray-300 rounded-xl focus:ring-black focus:border-black p-3 bg-gray-50">
                                <button class="px-6 py-2 rounded-xl text-white font-bold transition-colors"
                                        style="background-color: #B85C38;">Inviter</button>
                            </form>
                        </div>

                        <div class="space-y-4">
                            <h4 class="text-sm font-semibold text-gray-400 uppercase">Membres Actuels</h4>
                            <div class="divide-y divide-gray-100">
                                @foreach($members as $member)
                                    <div class="py-4 flex items-center justify-between">
                                        <span class="font-medium text-gray-800">{{ $member->user->name }}</span>
                                        
                                        @if($member->user_id !== auth()->id())
                                            <div class="flex gap-2">
                                                <form action="{{ route('colocations.transfer', [$colocation, $member->user_id]) }}" method="POST">
                                                    @csrf
                                                    <button class="text-xs px-3 py-1.5 rounded-lg border border-red-200 text-red-600 hover:bg-red-50 font-semibold">
                                                        Transférer Propriété
                                                    </button>
                                                </form>
                                                
                                                <form action="{{ route('memberships.kick', [$colocation, $member->user_id]) }}" method="POST">
                                                    @csrf @method('DELETE')
                                                    <button class="text-xs px-3 py-1.5 rounded-lg bg-black text-white hover:bg-gray-800 font-semibold">
                                                        Expulser
                                                    </button>
                                                </form>
                                            </div>
                                        @else
                                            <span class="text-xs font-bold text-gray-400 bg-gray-100 px-2 py-1 rounded">VOUS</span>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection