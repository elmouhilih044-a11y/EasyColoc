@extends('layouts.app')

@section('content')
<div class="min-h-screen flex justify-center items-center" style="background-color: #F5F0A0;">
    <div class="bg-white p-8 rounded-xl shadow w-96">

        <h1 class="text-2xl font-bold mb-5" style="color: #000000;">Modifier Catégorie</h1>

        <form action="{{ route('categories.update', $category) }}" method="POST">
            @csrf @method('PUT')

            <input type="text" name="name" value="{{ $category->name }}"
                   class="w-full border p-2 mb-3 rounded">

            <button class="w-full p-2 rounded text-white font-semibold"
                    style="background-color: #B85C38;">Mettre à jour</button>
        </form>

        <a href="{{ route('colocations.categories.index', $colocation) }}"
           class="block mt-4 text-center font-semibold"
           style="color: #000000;">Retour</a>
    </div>
</div>
@endsection