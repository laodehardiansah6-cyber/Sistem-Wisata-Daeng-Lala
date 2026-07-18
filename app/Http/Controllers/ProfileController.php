<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\File;

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
        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // --- TAMBAHAN LOGIKA UNTUK FOTO PROFIL ---
        if ($request->hasFile('profile_photo')) {
            // Hapus foto lama jika ada (agar file tidak menumpuk)
            if ($user->profile_photo && File::exists(public_path($user->profile_photo))) {
                File::delete(public_path($user->profile_photo));
            }

            // Simpan foto baru
            $file = $request->file('profile_photo');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('uploads/profile_photos'), $nama_file);
            
            // Simpan path ke database
            $user->profile_photo = 'uploads/profile_photos/' . $nama_file;
        }
        // -----------------------------------------

        $user->save();

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

        // Hapus foto profil dari folder jika user menghapus akun
        if ($user->profile_photo && File::exists(public_path($user->profile_photo))) {
            File::delete(public_path($user->profile_photo));
        }

        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
