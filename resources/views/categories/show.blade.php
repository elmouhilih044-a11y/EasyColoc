@extends('layouts.app')

@section('content')
<div class="min-h-screen flex justify-center items-center" style="background-color: #F5F0A0;">
    <div class="bg-white p-8 rounded-xl shadow w-96">

        <h1 class="text-2xl font-bold mb-4" style="color: #4A1040;">Détails Catégorie</h1>

        <p class="mb-2"><b>Nom :</b> {{ $category->name }}</p>
        <p class="mb-4"><b>Colocation :</b> {{ $category->colocation->name }}</p>

        <a href="{{ route('categories.index') }}"
           class="px-4 py-2 rounded text-white font-semibold"
           style="background-color: #4A1040;">Retour</a>
    </div>
</div>
@endsection