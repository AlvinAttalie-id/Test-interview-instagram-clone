<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserListController extends Controller
{
    public function index(Request $request)
    {
        $currentUser = Auth::user();
        $keyword = $request->input('q', '');

        $users = User::where('id', '!=', $currentUser->id)
            ->where(function ($query) use ($keyword) {
                $query->where('username', 'like', "%{$keyword}%");
            })
            ->whereDoesntHave('followers', function ($query) use ($currentUser) {
                $query->where('follower_id', $currentUser->id);
            })
            ->with('followers')
            ->take(5)
            ->get()
            ->map(function ($user) use ($currentUser) {
                $user->is_followed = $user->followers->contains($currentUser->id);
                return $user;
            });

        return view('users.index', compact('users', 'keyword'));
    }

    public function search(Request $request)
    {
        $currentUser = Auth::user();
        $keyword = $request->input('q');

        $users = User::where('id', '!=', $currentUser->id)
            ->where(function ($query) use ($keyword) {
                $query->where('username', 'like', "%{$keyword}%");
            })
            ->whereDoesntHave('followers', function ($query) use ($currentUser) {
                $query->where('follower_id', $currentUser->id);
            })
            ->with('followers')
            ->take(5)
            ->get()
            ->map(function ($user) use ($currentUser) {
                $user->is_followed = $user->followers->contains($currentUser->id);
                return $user;
            });

        return view('users.index', compact('users', 'keyword'));
    }
}
