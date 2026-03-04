<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Colocation;

class AdminController extends Controller
{
    public function statistiques()
    {
        $totalUsers       = User::count();
        $totalColocations = Colocation::count();
        $bannedUsers      = User::where('is_banned', 1)->count();

      
        $users = User::where('is_admin', 0)->get();

        return view('admin.dashboard', compact('totalUsers', 'totalColocations', 'bannedUsers', 'users'));
    }

    public function toggleBan(User $user)
    {
        

        $user->is_banned = !$user->is_banned;
        $user->save();

        return redirect()->back()->with('success', 'Le statut de l\'utilisateur a été mis à jour.');
    }
}