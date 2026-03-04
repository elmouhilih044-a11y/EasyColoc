@extends('layouts.app')

@section('content')
<div class="min-h-screen flex justify-center items-center" style="background-color: #F5F0A0;">
    <div class="bg-white p-8 rounded-xl shadow w-96">

        <h1 class="text-2xl font-bold mb-5" style="color: #000000;">Ajouter Catégorie</h1>

        @if(session('error'))
            <p class="mb-3 text-sm font-semibold" style="color: #8B2020;">{{ session('error') }}</p>
        @endif

        <form action="{{ route('colocations.categories.store', $colocation) }}" method="POST">
            @csrf

            <input type="text" name="name" placeholder="Nom"
                   class="w-full border p-2 mb-3 rounded">

            <button class="w-full p-2 rounded text-white font-semibold"
                    style="background-color: #8B2020;">Enregistrer</button>
        </form>

        <a href="{{ route('colocations.categories.index', $colocation) }}"
           class="block mt-4 text-center font-semibold"
           style="color: #000000;">Retour</a>
    </div>
</div>
@endsection