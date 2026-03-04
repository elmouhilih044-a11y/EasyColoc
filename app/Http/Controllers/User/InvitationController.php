<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Invitation;
use App\Models\Membership;
use App\Models\Colocation;
use App\Mail\InvitationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Exception;

class InvitationController extends Controller
{
    public function store(Request $request, Colocation $colocation)
    {
        $membership = Membership::where('user_id', Auth::id())
            ->where('colocation_id', $colocation->id)
            ->whereNull('left_at')
            ->first();

        if (!$membership || $membership->role !== 'owner') {
            return redirect()->back()->with('error', 'Accès refusé. Seul le propriétaire peut inviter.');
        }

        $request->validate([
            'email' => 'required|email',
        ]);

        $existing = Invitation::where('email', $request->email)
            ->where('colocation_id', $colocation->id)
            ->where('status', 'pending')
            ->first();

        if ($existing) {
            return redirect()->back()->with('error', 'Une invitation est déjà en cours pour cet email.');
        }

        $invitation = Invitation::create([
            'email'         => $request->email,
            'token'         => (string) Str::uuid(),
            'colocation_id' => $colocation->id,
            'invited_by'    => Auth::id(),
            'status'        => 'pending',
        ]);

        try {
            $invitation->load(['invitedBy', 'colocation']);
            Mail::to($request->email)->send(new InvitationMail($invitation));
            return redirect()->back()->with('success', 'Invitation envoyée !');
            } catch (Exception $e) {
                    $invitation->delete();
                }
            }

    public function show($token)
    {
        $invitation = Invitation::where('token', $token)
            ->where('status', 'pending')
            ->with(['colocation', 'invitedBy'])
            ->firstOrFail();

        return view('invitations.show', compact('invitation'));
    }

    public function accept($token)
    {
        $invitation = Invitation::where('token', $token)
            ->where('status', 'pending')
            ->firstOrFail();

        $user = Auth::user();

        $activeColocation = Membership::where('user_id', $user->id)
            ->whereNull('left_at')
            ->first();

        if ($activeColocation) {
            return redirect()->route('colocations.index')
                ->with('error', 'Vous avez déjà une colocation active. Quittez-la avant d\'en rejoindre une nouvelle.');
        }

        Membership::create([
            'user_id'       => $user->id,
            'colocation_id' => $invitation->colocation_id,
            'role'          => 'member',
            'joined_at'     => now(),
            'left_at'       => null,
        ]);

        $invitation->update(['status' => 'accepted']);

        return redirect()->route('colocations.show', $invitation->colocation_id)
            ->with('success', 'Bienvenue dans la colocation !');
    }

    public function refuse($token)
    {
        $invitation = Invitation::where('token', $token)
            ->where('status', 'pending')
            ->firstOrFail();

        $invitation->update(['status' => 'refused']);

        return redirect()->route('colocations.index')
            ->with('success', 'Invitation refusée.');
    }
}