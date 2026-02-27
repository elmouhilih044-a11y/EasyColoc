@extends('layouts.app')

@section('content')
<div class="min-h-screen flex justify-center items-center" style="background-color: #F5F0A0;">
    <div class="bg-white p-8 rounded-xl shadow w-96">

        <h1 class="text-2xl font-bold mb-5" style="color: #4A1040;">Ajouter Colocation</h1>

        <form action="{{ route('colocations.store') }}" method="POST">
            @csrf

            <input type="text" name="name" placeholder="Nom"
                   class="w-full border p-2 mb-3 rounded">

            <textarea name="description" placeholder="Description"
                      class="w-full border p-2 mb-3 rounded"></textarea>

            <select name="status" class="w-full border p-2 mb-3 rounded">
                <option value="active">Active</option>
                <option value="cancelled">Cancelled</option>
            </select>

            <button class="w-full p-2 rounded text-white font-semibold"
                    style="background-color: #8B2020;">Enregistrer</button>
        </form>

        <a href="{{ route('colocations.index') }}"
           class="block mt-4 text-center font-semibold"
           style="color: #4A1040;">Retour</a>
    </div>
</div>
@endsection