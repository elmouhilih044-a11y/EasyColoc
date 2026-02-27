<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;
use App\Models\Expense;
use App\Models\User;
use App\Models\Category;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
  
        $expenses = Expense::with(['category', 'user'])->get();
        return view('expenses.index', compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        $categories = Category::all();
        $users = User::all();
        return view('expenses.create', compact('categories', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store( StoreExpenseRequest $request)
    {
         Expense::create($request->validated());
        return redirect()->route('expenses.index')->with('success', 'Dépense créée !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Expense $expense)
    {
      
        return view('expenses.show', compact('expense'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expense $expense)
    {
        $categories = Category::all();
        $users = User::all();
        return view('expenses.edit', compact('expense', 'categories', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExpenseRequest $request, Expense $expense)
    {
    $expense->update($request->validated());
        return redirect()->route('expenses.index')->with('success', 'Dépense mise à jour !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expense $expense)
    {
        $expense->delete();
        return redirect()->route('expenses.index')->with('success', 'Dépense supprimée !');
    }
}
