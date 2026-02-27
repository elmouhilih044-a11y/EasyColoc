@extends('layouts.app')

@section('content')
<div class="bg-light min-h-screen flex justify-center items-center">
    <div class="bg-white p-8 rounded-xl shadow w-96">
        <h1 class="text-2xl font-bold mb-4 text-primary">Expense Details</h1>
        <p class="mb-2"><b>Title :</b> {{ $expense->title }}</p>
        <p class="mb-2"><b>Amount :</b> {{ $expense->amount }}</p>
        <p class="mb-4"><b>Date :</b> {{ $expense->expense_date }}</p>
        <a href="{{ route('expenses.index') }}"
           class="bg-primary text-light px-4 py-2 rounded">Back</a>
    </div>
</div>
@endsection