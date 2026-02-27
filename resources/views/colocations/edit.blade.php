@extends('layouts.app')

@section('content')
<div class="min-h-screen flex justify-center items-center" style="background-color: #F5F0A0;">
    <div class="bg-white p-8 rounded-xl shadow w-96">

        <h1 class="text-2xl font-bold mb-5" style="color: #4A1040;">Modifier Colocation</h1>

        <form action="{{ route('colocations.update', $colocation) }}" method="POST">
            @csrf @method('PUT')

            <input type="text" name="name" value="{{ $colocation->name }}"
                   class="w-full border p-2 mb-3 rounded">

            <textarea name="description" class="w-full border p-2 mb-3 rounded">{{ $colocation->description }}</textarea>

            <select name="status" class="w-full border p-2 mb-3 rounded">
                <option value="active"    {{ $colocation->status === 'active'    ? 'selected' : '' }}>Active</option>
                <option value="cancelled" {{ $colocation->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>

            <button class="w-full p-2 rounded text-white font-semibold"
                    style="background-color: #B85C38;">Mettre à jour</button>
        </form>

        <a href="{{ route('colocations.index') }}"
           class="block mt-4 text-center font-semibold"
           style="color: #4A1040;">Retour</a>
    </div>
</div>
@endsection