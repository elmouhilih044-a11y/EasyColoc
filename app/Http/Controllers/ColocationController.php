<?php

namespace App\Http\Controllers;

use App\Models\Colocation;
use App\Models\Membership;
use App\Http\Requests\StoreColocationRequest;
use App\Http\Requests\UpdateColocationRequest;
use Illuminate\Support\Facades\Auth;

class ColocationController extends Controller
{
    public function index()
    {
        $colocations = Colocation::all();
        return view('colocations.index', compact('colocations'));
    }

    public function create()
    {
        if (Auth::user()->role === 'member') {
            return redirect()->route('colocations.index')->with('error', 'Acces refuse.');
        }
        return view('colocations.create');
    }

    public function store(StoreColocationRequest $request)
    {
        if (Auth::user()->role === 'member') {
            return redirect()->route('colocations.index')->with('error', 'Acces refuse.');
        }
        Colocation::create($request->validated());
        return redirect()->route('colocations.index')->with('success', 'Colocation creee !');
    }

    public function show(Colocation $colocation)
    {
        $membership = Membership::where('user_id', Auth::user()->id)
                                ->where('colocation_id', $colocation->id)
                                ->first();
        return view('colocations.show', compact('colocation', 'membership'));
    }

    public function edit(Colocation $colocation)
    {
        if (Auth::user()->role === 'member') {
            return redirect()->route('colocations.index')->with('error', 'Acces refuse.');
        }
        return view('colocations.edit', compact('colocation'));
    }

    public function update(UpdateColocationRequest $request, Colocation $colocation)
    {
        if (Auth::user()->role === 'member') {
            return redirect()->route('colocations.index')->with('error', 'Acces refuse.');
        }
        $colocation->update($request->validated());
        return redirect()->route('colocations.index')->with('success', 'Colocation mise a jour !');
    }

    public function destroy(Colocation $colocation)
    {
        if (Auth::user()->role === 'member') {
            return redirect()->route('colocations.index')->with('error', 'Acces refuse.');
        }
        $colocation->delete();
        return redirect()->route('colocations.index')->with('success', 'Colocation supprimee !');
    }
}