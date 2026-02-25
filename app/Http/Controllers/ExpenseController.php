<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    $expenses=Expense::all();
    return view('expenses.index',compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('expenses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store( StoreExpenseRequest $request)
    {
    $data = $request->validated(); 
    Expense::create($data);       
   return redirect()->route('expenses.index')->with('success','Expense crée avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Expense $expense)
    {
       return view('expenses.show',compact('expense'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expense $expense)
    {
      return view('expenses.edit',compact('expense'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExpenseRequest $request, Expense $expense)
    {
    $data = $request->validated();  
    $expense->update($data);      
    return redirect()->route('expenses.index')->with('success', 'expense mise à jour avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expense $expense)
    {
        $expense->delete();
        return redirect()->route('expenses.index');
        
    }
}
