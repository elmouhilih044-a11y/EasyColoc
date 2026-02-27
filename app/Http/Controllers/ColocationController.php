<?php

namespace App\Http\Controllers;

use App\Models\Colocation;
use App\Http\Requests\StoreColocationRequest;
use App\Http\Requests\UpdateColocationRequest;

class ColocationController extends Controller
{
    public function index()
    {
        $colocations = Colocation::all();
        return view('colocations.index', compact('colocations'));
    }

    public function create()
    {
        return view('colocations.create');
    }

    public function store(StoreColocationRequest $request)
    {
        Colocation::create($request->validated());
        return redirect()->route('colocations.index')->with('success', 'Colocation créée !');
    }

    public function show(Colocation $colocation)
    {
        return view('colocations.show', compact('colocation'));
    }

    public function edit(Colocation $colocation)
    {
        return view('colocations.edit', compact('colocation'));
    }

    public function update(UpdateColocationRequest $request, Colocation $colocation)
    {
        $colocation->update($request->validated());
        return redirect()->route('colocations.index')->with('success', 'Colocation mise à jour !');
    }

    public function destroy(Colocation $colocation)
    {
        $colocation->delete();
        return redirect()->route('colocations.index')->with('success', 'Colocation supprimée !');
    }
}