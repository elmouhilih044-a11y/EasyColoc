@extends('layouts.app')

@section('content')
<div class="min-h-screen py-12 px-4" style="background-color: #F5F0A0;">
    <div class="max-w-2xl mx-auto bg-white rounded-2xl shadow-lg overflow-hidden">
        
        <div class="p-8 border-b border-gray-100">
            <div class="flex justify-between items-start">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">{{ $colocation->name }}</h1>
                    <p class="text-gray-500 mt-1">{{ $colocation->description }}</p>
                </div>
                <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider text-white"
                      style="background-color: {{ $colocation->status === 'active' ? '#B85C38' : '#8B2020' }};">
                    {{ $colocation->status }}
                </span>
            </div>
        </div>

        <div class="p-8 space-y-8">
            <div class="grid grid-cols-2 gap-4">
                @if($membership && $membership->left_at === null)
                <a href="{{ route('colocations.expenses.index', $colocation) }}"
                   class="flex items-center justify-center px-4 py-3 rounded-xl font-bold transition-all hover:opacity-90 text-white"
                   style="background-color: #D4894A;">
                    Dépenses
                </a>
                @endif
                <a href="{{ route('debts.index', $colocation) }}"
                   class="flex items-center justify-center px-4 py-3 rounded-xl font-bold transition-all hover:opacity-90 text-white"
                   style="background-color: #B85C38;">
                    Dettes
                </a>
            </div>

            @if($membership && $membership->role === 'owner')
            <section class="pt-6 border-t border-gray-100">
                <h2 class="text-sm font-bold uppercase tracking-widest text-gray-400 mb-4">Administration</h2>
                
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-semibold mb-2">Inviter un nouveau membre</label>
                        <form action="{{ route('invitations.store', $colocation) }}" method="POST" class="flex gap-2">
                            @csrf
                            <input type="email" name="email" placeholder="adresse@email.com"
                                   class="flex-1 border border-gray-300 p-2.5 rounded-lg focus:ring-2 focus:ring-orange-200 outline-none">
                            <button class="px-6 py-2.5 rounded-lg text-white font-bold"
                                    style="background-color: #B85C38;">Envoyer</button>
                        </form>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold mb-2">Gestion des membres</label>
                        <div class="space-y-2">
                            @foreach($members as $member)
                                @if($member->user_id !== auth()->id())
                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                    <span class="font-medium">{{ $member->user->name }}</span>
                                    <div class="flex gap-2">
                                        <form action="{{ route('colocations.transfer', [$colocation, $member->user_id]) }}" method="POST">
                                            @csrf
                                            <button class="text-xs font-bold px-3 py-1.5 rounded bg-gray-200 hover:bg-gray-300 transition-colors">Propriété</button>
                                        </form>
                                        <form action="{{ route('memberships.kick', [$colocation, $member->user_id]) }}" method="POST">
                                            @csrf @method('DELETE')
                                            <button class="text-xs font-bold px-3 py-1.5 rounded text-white bg-black hover:bg-gray-800 transition-colors">Retirer</button>
                                        </form>
                                    </div>
                                </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
            @endif
        </div>

        <div class="p-8 bg-gray-50 border-t border-gray-100">
            @if($membership)
                @if($membership->left_at === null)
                    @if($membership->role !== 'owner')
                    <form action="{{ route('memberships.leave', $membership) }}" method="POST">
                        @csrf
                        <button class="w-full py-3 rounded-xl text-white font-bold" style="background-color: #8B2020;">Quitter la colocation</button>
                    </form>
                    @else
                    <div class="text-center p-3 rounded-lg border border-red-200 text-red-700 text-sm font-medium bg-red-50">
                        Transférez la propriété avant de quitter la colocation.
                    </div>
                    @endif
                @else
                    <div class="text-center text-gray-500 font-medium">Quitté le {{ $membership->left_at }}</div>
                @endif
            @endif
            
            <a href="{{ route('colocations.index') }}" class="block text-center mt-6 text-sm font-bold text-gray-400 hover:text-gray-600">Retour à la liste</a>
        </div>
    </div>
</div>
@endsection