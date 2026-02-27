@extends('layouts.app')

@section('content')
<div class="bg-light min-h-screen flex justify-center items-center">
    <div class="bg-white p-8 rounded-xl shadow w-96">
        <h1 class="text-2xl mb-5 font-bold text-dark">Add Expense</h1>
        <form action="{{ route('expenses.store') }}" method="POST">
            @csrf
            <input type="text" name="title" placeholder="Title"
                   class="w-full border p-2 mb-3 rounded">
            <input type="number" name="amount" placeholder="Amount"
                   class="w-full border p-2 mb-3 rounded">
            <input type="date" name="expense_date"
                   class="w-full border p-2 mb-3 rounded">
            <button class="w-full bg-primary text-light p-2 rounded">Save</button>
        </form>
        <a href="{{ route('expenses.index') }}"
           class="block mt-4 text-primary">Back</a>
    </div>
</div>
@endsection