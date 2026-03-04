@extends('layouts.app')

@section('content')
<div class="p-8 min-h-screen" style="background-color: #F5F0A0;">

    <h1 class="text-3xl font-bold mb-6" style="color: #000000;">Dépenses — {{ $colocation->name }}</h1>

    <a href="{{ route('colocations.expenses.create', $colocation) }}"
       class="px-4 py-2 rounded text-white font-semibold"
       style="background-color: #8B2020;">
        + Ajouter
    </a>

    @if(session('success'))
        <p class="mt-3 font-semibold" style="color: #8B2020;">{{ session('success') }}</p>
    @endif

    @if(session('error'))
        <p class="mt-3 font-semibold" style="color: #8B2020;">{{ session('error') }}</p>
    @endif

    <div class="mt-6 rounded-xl shadow overflow-hidden">
        <table class="w-full">
            <thead style="background-color: #000000; color: #F5F0A0;">
                <tr>
                    <th class="p-3 text-left">Titre</th>
                    <th class="p-3 text-left">Montant</th>
                    <th class="p-3 text-left">Date</th>
                    <th class="p-3 text-left">Catégorie</th>
                    <th class="p-3 text-left">Ajouté par</th>
                    <th class="p-3 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($expenses as $expense)
                <tr style="background-color: white; border-bottom: 1px solid #D4894A;">
                    <td class="p-3">{{ $expense->title }}</td>
                    <td class="p-3">{{ $expense->amount }} €</td>
                    <td class="p-3">{{ $expense->expense_date }}</td>
                    <td class="p-3">{{ $expense->category->name }}</td>
                    <td class="p-3">{{ $expense->user->name }}</td>
                    <td class="p-3 space-x-2">
                        @if($expense->user_id === auth()->id())
                        <a href="{{ route('expenses.edit', $expense) }}"
                           class="px-3 py-1 rounded text-white text-sm"
                           style="background-color: #B85C38;">Modifier</a>
                        @endif
                        @if($expense->user_id === auth()->id() || $currentMembership?->role === 'owner')
                        <form action="{{ route('expenses.destroy', $expense) }}"
                              method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button class="px-3 py-1 rounded text-white text-sm"
                                    style="background-color: #000000;">Supprimer</button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <a href="{{ route('colocations.show', $colocation) }}"
       class="inline-block mt-6 px-4 py-2 rounded text-white font-semibold"
       style="background-color: #000000;">Retour</a>
</div>
@endsection