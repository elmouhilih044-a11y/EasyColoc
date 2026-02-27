@extends('layouts.app')

@section('content')
<div class="p-8 min-h-screen" style="background-color: #F5F0A0;">

    <h1 class="text-3xl font-bold mb-6" style="color: #4A1040;">Dépenses</h1>

    <a href="{{ route('expenses.create') }}"
       class="px-4 py-2 rounded text-white font-semibold"
       style="background-color: #8B2020;">
        + Ajouter
    </a>

    @if(session('success'))
        <p class="mt-3 font-semibold" style="color: #8B2020;">{{ session('success') }}</p>
    @endif

    <div class="mt-6 rounded-xl shadow overflow-hidden">
        <table class="w-full">
            <thead style="background-color: #4A1040; color: #F5F0A0;">
                <tr>
                    <th class="p-3 text-left">ID</th>
                    <th class="p-3 text-left">Titre</th>
                    <th class="p-3 text-left">Montant</th>
                    <th class="p-3 text-left">Date</th>
                    <th class="p-3 text-left">Catégorie</th>
                    <th class="p-3 text-left">Utilisateur</th>
                    <th class="p-3 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($expenses as $expense)
                <tr style="background-color: white; border-bottom: 1px solid #D4894A;">
                    <td class="p-3">{{ $expense->id }}</td>
                    <td class="p-3">{{ $expense->title }}</td>
                    <td class="p-3">{{ $expense->amount }} €</td>
                    <td class="p-3">{{ $expense->expense_date }}</td>
                    <td class="p-3">{{ $expense->category->name }}</td>
                    <td class="p-3">{{ $expense->user->name }}</td>
                    <td class="p-3 space-x-2">
                        <a href="{{ route('expenses.show', $expense) }}"
                           class="px-3 py-1 rounded text-white text-sm"
                           style="background-color: #D4894A;">Voir</a>
                        <a href="{{ route('expenses.edit', $expense) }}"
                           class="px-3 py-1 rounded text-white text-sm"
                           style="background-color: #B85C38;">Modifier</a>
                        <form action="{{ route('expenses.destroy', $expense) }}"
                              method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button class="px-3 py-1 rounded text-white text-sm"
                                    style="background-color: #4A1040;">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection