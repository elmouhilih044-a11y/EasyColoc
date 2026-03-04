<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Colocation;
use App\Models\Membership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index(Colocation $colocation)
    {
        $categories = Category::where('colocation_id', $colocation->id)->get();
        
        $membership = Membership::where('user_id', Auth::id())
            ->where('colocation_id', $colocation->id)
            ->whereNull('left_at')
            ->first();

        return view('categories.index', compact('categories', 'colocation', 'membership'));
    }

    public function create(Colocation $colocation)
    {
        return view('categories.create', compact('colocation'));
    }

    public function store(Request $request, Colocation $colocation)
    {
        $request->validate(['name' => 'required|string|max:255']);

        Category::create([
            'name' => $request->name,
            'colocation_id' => $colocation->id
        ]);

        return redirect()->route('colocations.categories.index', $colocation)
            ->with('success', 'Catégorie ajoutée !');
    }

    public function destroy(Category $category)
    {
        $colocation = $category->colocation;
        $category->delete();

        return redirect()->route('colocations.categories.index', $colocation)
            ->with('success', 'Catégorie supprimée.');
    }
}