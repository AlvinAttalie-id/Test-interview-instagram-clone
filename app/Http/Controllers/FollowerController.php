<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowerController extends Controller
{
    public function follow(User $user)
    {
        if (Auth::id() === $user->id) {
            return back()->with('error', 'Anda tidak dapat mengikuti diri sendiri.');
        }

        if (!Auth::user()->isFollowing($user)) {
            Auth::user()->following()->attach($user->id);
            return back()->with('success', 'Sekarang mengikuti ' . $user->name);
        }

        return back()->with('error', 'Anda sudah mengikuti pengguna ini.');
    }

    public function unfollow(User $user)
    {
        if (Auth::user()->isFollowing($user)) {
            Auth::user()->following()->detach($user->id);
            return back()->with('success', 'Berhenti mengikuti ' . $user->name);
        }

        return back()->with('error', 'Anda belum mengikuti pengguna ini.');
    }

    public function toggle(User $user)
    {
        if (Auth::id() === $user->id) {
            return back()->with('error', 'Tidak bisa mengikuti diri sendiri.');
        }

        Auth::user()->following()->toggle($user->id); // Laravel akan attach/detach otomatis
        return back()->with('success', 'Status follow diperbarui.');
    }
}
