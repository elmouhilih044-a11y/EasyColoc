@extends('layouts.app')

@section('content')
<div class="p-8 bg-light min-h-screen">

    <h1 class="text-3xl font-bold mb-6 text-dark">Expenses</h1>

    <a href="{{ route('expenses.create') }}"
       class="bg-primary text-light px-4 py-2 rounded">
        Add Expense
    </a>

    @if(session('success'))
        <p class="text-green-600 mt-3">{{ session('success') }}</p>
    @endif

    <div class="mt-6 bg-white rounded-xl shadow">
        <table class="w-full">
            <thead class="bg-primary text-light">
                <tr>
                    <th class="p-3">ID</th>
                    <th class="p-3">Title</th>
                    <th class="p-3">Amount</th>
                    <th class="p-3">Date</th>
                    <th class="p-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($expenses as $expense)
                <tr class="border-b text-center">
                    <td class="p-3">{{ $expense->id }}</td>
                    <td class="p-3">{{ $expense->title }}</td>
                    <td class="p-3">{{ $expense->amount }}</td>
                    <td class="p-3">{{ $expense->expense_date }}</td>
                    <td class="p-3 space-x-2">
                        <a href="{{ route('expenses.show', $expense) }}"
                           class="bg-accent text-dark px-3 py-1 rounded">Show</a>
                        <a href="{{ route('expenses.edit', $expense) }}"
                           class="bg-muted text-light px-3 py-1 rounded">Edit</a>
                        <form action="{{ route('expenses.destroy', $expense) }}"
                              method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="bg-dark text-light px-3 py-1 rounded">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection