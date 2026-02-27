<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Colocation;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    $categories = Category::with('colocation')->get();
    return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $colocations = Colocation::all();
        return view('categories.create', compact('colocations'));
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(StoreCategoryRequest $request)
{
      Category::create($request->validated());
        return redirect()->route('categories.index')->with('success', 'Catégorie créée !');
}

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
       return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
         $colocations = Colocation::all();
        return view('categories.edit', compact('category', 'colocations'));
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(UpdateCategoryRequest $request, Category $category)
{
      $category->update($request->validated());
        return redirect()->route('categories.index')->with('success', 'Catégorie mise à jour !');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
       
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Catégorie supprimée !');
    }
}
