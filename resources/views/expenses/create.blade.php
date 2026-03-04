@extends('layouts.app')

@section('content')
<div class="min-h-screen flex justify-center items-center" style="background-color: #F5F0A0;">
    <div class="bg-white p-8 rounded-xl shadow w-96">

        <h1 class="text-2xl font-bold mb-5" style="color: #000000;">Ajouter Dépense</h1>

        @if(session('error'))
            <p class="mb-3 text-sm font-semibold" style="color: #8B2020;">{{ session('error') }}</p>
        @endif

        <form action="{{ route('colocations.expenses.store', $colocation) }}" method="POST">
            @csrf

            <input type="text" name="title" placeholder="Titre"
                   class="w-full border p-2 mb-3 rounded">

            <input type="number" step="0.01" name="amount" placeholder="Montant"
                   class="w-full border p-2 mb-3 rounded">

            <input type="date" name="expense_date"
                   class="w-full border p-2 mb-3 rounded">

            <select name="category_id" class="w-full border p-2 mb-3 rounded">
                <option value="">-- Catégorie --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>

            <button class="w-full p-2 rounded text-white font-semibold"
                    style="background-color: #8B2020;">Enregistrer</button>
        </form>

        <a href="{{ route('colocations.expenses.index', $colocation) }}"
           class="block mt-4 text-center font-semibold"
           style="color: #000000;">Retour</a>
    </div>
</div>
@endsection