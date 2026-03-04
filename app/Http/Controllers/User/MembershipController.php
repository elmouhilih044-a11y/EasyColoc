<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Membership;
use App\Models\Colocation;
use Illuminate\Support\Facades\Auth;

class MembershipController extends Controller
{
    
    public function leave(Membership $membership)
    {
        if ($membership->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Accès refusé.');
        }

        if ($membership->role === 'owner') {
            $activeMembersCount = Membership::where('colocation_id', $membership->colocation_id)
                ->whereNull('left_at')
                ->count();

            if ($activeMembersCount > 1) {
                return redirect()->back()->with('error', 'Vous devez transférer la propriété avant de quitter car il reste d\'autres membres.');
            }
            $membership->colocation->update(['status' => 'cancelled']);
        }

        $membership->update(['left_at' => now()]);
        
        return redirect()->route('colocations.index')->with('success', 'Vous avez quitté la colocation.');
    }

    public function kick(Colocation $colocation, $userId)
    {
        $ownerMembership = Membership::where('user_id', Auth::id())
            ->where('colocation_id', $colocation->id)
            ->whereNull('left_at')
            ->first();

        if (!$ownerMembership || $ownerMembership->role !== 'owner') {
            return redirect()->back()->with('error', 'Accès refusé.');
        }

        $targetMembership = Membership::where('user_id', $userId)
            ->where('colocation_id', $colocation->id)
            ->whereNull('left_at')
            ->first();

        if (!$targetMembership) {
            return redirect()->back()->with('error', 'Membre introuvable.');
        }

        $targetMembership->update(['left_at' => now()]);
        return redirect()->back()->with('success', 'Membre expulsé.');
    }
}