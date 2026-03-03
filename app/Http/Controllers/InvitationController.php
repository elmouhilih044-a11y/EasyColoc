<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use Illuminate\Http\Request;
use App\Models\Membership;

class InvitationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Colocation $colocation)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        // Vérifier si invitation déjà envoyée
        $existing = Invitation::where('email', $request->email)
                              ->where('colocation_id', $colocation->id)
                              ->where('status', 'pending')
                              ->first();

        if ($existing) {
            return redirect()->back()->with('error', 'Une invitation a déjà été envoyée à cet email.');
        }

        // Créer l'invitation
        $invitation = Invitation::create([
            'email'         => $request->email,
            'token'         => Str::uuid(),
            'colocation_id' => $colocation->id,
            'invited_by'    => auth()->user()->id,
            'status'        => 'pending',
        ]);

        // Envoyer l'email
        Mail::to($request->email)->send(new InvitationMail($invitation));

        return redirect()->back()->with('success', 'Invitation envoyée à ' . $request->email);
    }

    // Page que l'invité voit en cliquant sur le lien
    public function show($token)
    {
        $invitation = Invitation::where('token', $token)
                                ->where('status', 'pending')
                                ->with(['colocation', 'invitedBy'])
                                ->firstOrFail();

        return view('invitations.show', compact('invitation'));
    }

    // L'invité accepte
    public function accept($token)
    {
        $invitation = Invitation::where('token', $token)
                                ->where('status', 'pending')
                                ->firstOrFail();

        $user = auth()->user();

        // Vérifier si l'utilisateur a déjà une colocation active
        $activeColocation = Membership::where('user_id', $user->id)
                                      ->whereNull('left_at')
                                      ->first();

        if ($activeColocation) {
            return redirect()->route('colocations.index')
                             ->with('error', 'Vous avez déjà une colocation active.');
        }

        // Créer le membership
        Membership::create([
            'user_id'       => $user->id,
            'colocation_id' => $invitation->colocation_id,
            'role'          => 'member',
            'joined_at'     => now(),
            'left_at'       => null,
        ]);

        // Marquer l'invitation comme acceptée
        $invitation->update(['status' => 'accepted']);

        return redirect()->route('colocations.show', $invitation->colocation_id)
                         ->with('success', 'Vous avez rejoint la colocation !');
    }

    // L'invité refuse
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



    
    

