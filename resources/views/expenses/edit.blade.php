@extends('layouts.app')

@section('content')
<div class="min-h-screen flex justify-center items-center" style="background-color: #F5F0A0;">
    <div class="bg-white p-8 rounded-xl shadow w-96">

        <h1 class="text-2xl font-bold mb-5" style="color: #4A1040;">Modifier Dépense</h1>

        <form action="{{ route('expenses.update', $expense) }}" method="POST">
            @csrf @method('PUT')

            <input type="text" name="title" value="{{ $expense->title }}"
                   class="w-full border p-2 mb-3 rounded">

            <input type="number" step="0.01" name="amount" value="{{ $expense->amount }}"
                   class="w-full border p-2 mb-3 rounded">

            <input type="date" name="expense_date" value="{{ $expense->expense_date }}"
                   class="w-full border p-2 mb-3 rounded">

            <select name="category_id" class="w-full border p-2 mb-3 rounded">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $expense->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            <select name="user_id" class="w-full border p-2 mb-3 rounded">
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $expense->user_id == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>

            <button class="w-full p-2 rounded text-white font-semibold"
                    style="background-color: #B85C38;">Mettre à jour</button>
        </form>

        <a href="{{ route('expenses.index') }}"
           class="block mt-4 text-center font-semibold"
           style="color: #4A1040;">Retour</a>
    </div>
</div>
@endsection