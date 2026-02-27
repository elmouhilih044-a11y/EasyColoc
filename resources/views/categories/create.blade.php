@extends('layouts.app')

@section('content')
<div class="min-h-screen flex justify-center items-center" style="background-color: #F5F0A0;">
    <div class="bg-white p-8 rounded-xl shadow w-96">

        <h1 class="text-2xl font-bold mb-5" style="color: #4A1040;">Ajouter Catégorie</h1>

        <form action="{{ route('categories.store') }}" method="POST">
            @csrf

            <input type="text" name="name" placeholder="Nom"
                   class="w-full border p-2 mb-3 rounded">

            <select name="colocation_id" class="w-full border p-2 mb-3 rounded">
                <option value="">-- Colocation --</option>
                @foreach($colocations as $colocation)
                    <option value="{{ $colocation->id }}">{{ $colocation->name }}</option>
                @endforeach
            </select>

            <button class="w-full p-2 rounded text-white font-semibold"
                    style="background-color: #8B2020;">Enregistrer</button>
        </form>

        <a href="{{ route('categories.index') }}"
           class="block mt-4 text-center font-semibold"
           style="color: #4A1040;">Retour</a>
    </div>
</div>
@endsection