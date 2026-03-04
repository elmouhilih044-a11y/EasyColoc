<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
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

        $myMemberships = Membership::where('user_id', Auth::id())->whereNull('left_at')->pluck('role', 'colocation_id');

        return view('colocations.index', compact('colocations', 'myMemberships'));
    }

    public function create()
    {
        return view('colocations.create');
    }

    public function store(StoreColocationRequest $request)
    {
        $user = Auth::user();

        $activeMembership = Membership::where('user_id', $user->id)
            ->whereNull('left_at')
            ->with('colocation')
            ->first();

        if ($activeMembership) {
            $activeColocation = $activeMembership->colocation;

            $hasMembers = Membership::where('colocation_id', $activeColocation->id)
                ->whereNull('left_at')
                ->where('user_id', '!=', $user->id)
                ->exists();

            if ($hasMembers) {
                return redirect()->back()->with('error', 'Vous avez déjà une colocation active avec des membres.');
            }

            $activeMembership->update(['left_at' => now()]);
            $activeColocation->update(['status' => 'cancelled']);
        }

        $colocation = Colocation::create(array_merge($request->validated(), ['status' => 'active']));

        Membership::create([
            'user_id'       => $user->id,
            'colocation_id' => $colocation->id,
            'role'          => 'owner',
            'joined_at'     => now(),
            'left_at'       => null,
        ]);

        return redirect()->route('colocations.index')->with('success', 'Colocation créée !');
    }

    public function show(Colocation $colocation)
    {
        $membership = Membership::where('user_id', Auth::id())->where('colocation_id', $colocation->id)->first();

        $members = Membership::with('user')->where('colocation_id', $colocation->id)->whereNull('left_at')
            ->get();

        return view('colocations.show', compact('colocation', 'membership', 'members'));
    }

    public function edit(Colocation $colocation)
    {
        $membership = Membership::where('user_id', Auth::id())
            ->where('colocation_id', $colocation->id)
            ->whereNull('left_at')
            ->first();

        if (!$membership || $membership->role !== 'owner') {
            return redirect()->route('colocations.index')->with('error', 'Accès refusé.');
        }

        return view('colocations.edit', compact('colocation'));
    }

    public function update(UpdateColocationRequest $request, Colocation $colocation)
    {
        $membership = Membership::where('user_id', Auth::id())->where('colocation_id', $colocation->id)->whereNull('left_at')->first();

        if (!$membership || $membership->role !== 'owner') {
            return redirect()->route('colocations.index')->with('error', 'Accès refusé.');
        }

        $colocation->update($request->validated());
        return redirect()->route('colocations.index')->with('success', 'Colocation mise à jour !');
    }

    public function destroy(Colocation $colocation)
    {
        $membership = Membership::where('user_id', Auth::id())
            ->where('colocation_id', $colocation->id)
            ->whereNull('left_at')
            ->first();

        if (!$membership || $membership->role !== 'owner') {
            return redirect()->route('colocations.index')->with('error', 'Accès refusé.');
        }

        $colocation->delete();
        return redirect()->route('colocations.index')->with('success', 'Colocation supprimée !');
    }

    public function transferOwnership(Colocation $colocation, $userId)
    {
        $ownerMembership = Membership::where('user_id', Auth::id())->where('colocation_id', $colocation->id)->whereNull('left_at')->first();

        if (!$ownerMembership || $ownerMembership->role !== 'owner') {
            return redirect()->back()->with('error', 'Accès refusé.');
        }

        $newOwnerMembership = Membership::where('user_id', $userId)
            ->where('colocation_id', $colocation->id)
            ->whereNull('left_at')
            ->first();

        if (!$newOwnerMembership) {
            return redirect()->back()->with('error', 'Membre introuvable.');
        }

        $ownerMembership->update(['role' => 'member']);
        $newOwnerMembership->update(['role' => 'owner']);

        return redirect()->back()->with('success', 'Propriété transférée.');
    }
}