<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;
use App\Models\Expense;
use App\Models\Category;
use App\Models\Membership;
use App\Models\Colocation;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Colocation $colocation)
    {
        $expenses = Expense::with(['category', 'user'])
            ->whereHas('category', fn($q) => $q->where('colocation_id', $colocation->id))
            ->get();

        $currentMembership = Membership::where('user_id', Auth::id())
            ->where('colocation_id', $colocation->id)
            ->whereNull('left_at')
            ->first();

        return view('expenses.index', compact('expenses', 'colocation', 'currentMembership'));
    }
    
    public function create(Colocation $colocation)
    {
        $membership = Membership::where('user_id', Auth::id())
            ->where('colocation_id', $colocation->id)
            ->whereNull('left_at')
            ->first();

        if (!$membership) {
            return redirect()->back()->with('error', 'Accès refusé.');
        }

        $categories = Category::where('colocation_id', $colocation->id)->get();
        return view('expenses.create', compact('categories', 'colocation'));
    }

    public function store(StoreExpenseRequest $request, Colocation $colocation)
    {
        $membership = Membership::where('user_id', Auth::id())
            ->where('colocation_id', $colocation->id)
            ->whereNull('left_at')
            ->first();

        if (!$membership) {
            return redirect()->back()->with('error', 'Accès refusé.');
        }

      
        Expense::create(array_merge($request->validated(), [
            'user_id' => Auth::id()
        ]));

        return redirect()->route('colocations.expenses.index', $colocation)->with('success', 'Dépense créée !');
    }

    public function edit(Expense $expense)
    {
        if ($expense->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Accès refusé.');
        }

        $colocation = $expense->category->colocation;
        $categories = Category::where('colocation_id', $colocation->id)->get();
        return view('expenses.edit', compact('expense', 'categories', 'colocation'));
    }

    public function update(UpdateExpenseRequest $request, Expense $expense)
    {
        if ($expense->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Accès refusé.');
        }

        $expense->update($request->validated());
        $colocation = $expense->category->colocation;
        return redirect()->route('colocations.expenses.index', $colocation)->with('success', 'Dépense mise à jour !');
    }

    public function destroy(Expense $expense)
    {
        $colocation = $expense->category->colocation;

        $membership = Membership::where('user_id', Auth::id())
            ->where('colocation_id', $colocation->id)
            ->whereNull('left_at')
            ->first();

        if (!$membership || ($expense->user_id !== Auth::id() && $membership->role !== 'owner')) {
            return redirect()->back()->with('error', 'Accès refusé.');
        }

        $expense->delete();
        return redirect()->route('colocations.expenses.index', $colocation)->with('success', 'Dépense supprimée !');
    }
}