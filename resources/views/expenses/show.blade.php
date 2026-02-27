@extends('layouts.app')

@section('content')
<div class="min-h-screen flex justify-center items-center" style="background-color: #F5F0A0;">
    <div class="bg-white p-8 rounded-xl shadow w-96">

        <h1 class="text-2xl font-bold mb-4" style="color: #4A1040;">Détails Dépense</h1>

        <p class="mb-2"><b>Titre :</b> {{ $expense->title }}</p>
        <p class="mb-2"><b>Montant :</b> {{ $expense->amount }} €</p>
        <p class="mb-2"><b>Date :</b> {{ $expense->expense_date }}</p>
        <p class="mb-2"><b>Catégorie :</b> {{ $expense->category->name }}</p>
        <p class="mb-4"><b>Utilisateur :</b> {{ $expense->user->name }}</p>

        <a href="{{ route('expenses.index') }}"
           class="px-4 py-2 rounded text-white font-semibold"
           style="background-color: #4A1040;">Retour</a>
    </div>
</div>
@endsection