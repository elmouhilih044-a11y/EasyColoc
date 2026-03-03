<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Colocation;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role === 'member') {
            return redirect()->route('colocations.index')->with('error', 'Accès refusé.');
        }
        $categories = Category::with('colocation')->get();
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->role === 'member') {
            return redirect()->route('colocations.index')->with('error', 'Accès refusé.');
        }
        $colocations = Colocation::all();
        return view('categories.create', compact('colocations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        if (Auth::user()->role === 'member') {
            return redirect()->route('colocations.index')->with('error', 'Accès refusé.');
        }
        Category::create($request->validated());
        return redirect()->route('categories.index')->with('success', 'Catégorie créée !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        if (Auth::user()->role === 'member') {
            return redirect()->route('colocations.index')->with('error', 'Accès refusé.');
        }
        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        if (Auth::user()->role === 'member') {
            return redirect()->route('colocations.index')->with('error', 'Accès refusé.');
        }
        $colocations = Colocation::all();
        return view('categories.edit', compact('category', 'colocations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        if (Auth::user()->role === 'member') {
            return redirect()->route('colocations.index')->with('error', 'Accès refusé.');
        }
        $category->update($request->validated());
        return redirect()->route('categories.index')->with('success', 'Catégorie mise à jour !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if (Auth::user()->role === 'member') {
            return redirect()->route('colocations.index')->with('error', 'Accès refusé.');
        }
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Catégorie supprimée !');
    }
}