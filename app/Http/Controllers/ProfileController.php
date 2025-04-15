<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use App\Models\ProfileSetting;

use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        // Validasi input
        $validated = $request->validated();

        // Isi data user dengan data yang divalidasi
        $user->fill($validated);

        // Jika email berubah, set email_verified_at menjadi null
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // Jika username berubah, simpan perubahan tersebut
        if ($user->isDirty('username')) {
            $user->save();
        }

        // Simpan ke profile_settings jika ada data tambahan (foto profil atau bio)
        $data = [];

        // Cek apakah ada foto profil yang diunggah
        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $path = $file->store('profile_pictures', 'public');
            $data['profile_picture'] = $path;
        }

        // Cek jika ada perubahan bio
        if ($request->filled('bio')) {
            $data['bio'] = $request->input('bio');
        }

        // Simpan atau perbarui pengaturan profil
        if (!empty($data)) {
            ProfileSetting::updateOrCreate(
                ['user_id' => $user->id],
                $data
            );
        }

        // Redirect dengan status berhasil diperbarui
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
