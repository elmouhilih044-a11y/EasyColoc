<?php

namespace App\Http\Controllers;

use App\Models\Membership;
use Illuminate\Http\Request;

class MembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     */


      public function leave(Membership $membership)
    {
        $membership->update(['left_at' => now()]);
        return redirect()->back()->with('success', 'Vous avez quitté la colocation.');
    }



   
}
