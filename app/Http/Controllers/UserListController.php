<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserListController extends Controller
{
    public function index()
    {
        $currentUser = Auth::user();

        $users = User::where('id', '!=', $currentUser->id)
            ->with('followers')
            ->get()
            ->map(function ($user) use ($currentUser) {
                $user->is_followed = $user->followers->contains($currentUser->id);
                return $user;
            });

        return view('users.index', compact('users'));
    }

    public function search(Request $request)
    {
        $currentUser = Auth::user();
        $keyword = $request->input('q');

        $users = User::where('id', '!=', $currentUser->id)
            ->where(function ($query) use ($keyword) {
                $query->where('name', 'like', "%{$keyword}%")
                    ->orWhere('email', 'like', "%{$keyword}%");
            })
            ->with('followers')
            ->get()
            ->map(function ($user) use ($currentUser) {
                $user->is_followed = $user->followers->contains($currentUser->id);
                return $user;
            });

        return view('users.index', compact('users', 'keyword'));
    }
}
