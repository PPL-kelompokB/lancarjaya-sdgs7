<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    // 🔥 DASHBOARD
    public function dashboard()
    {
        $user = Auth::user();

        return view('user.dashboard-user', compact('user'));
    }

    // 🔥 UPDATE PROFILE
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'phone'   => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        $user->update([
            'name'    => $request->name,
            'email'   => $request->email,
            'phone'   => $request->phone,
            'address' => $request->address,
        ]);

        return back()->with('success', 'Profile berhasil diupdate');
    }

    // 🔥 UPLOAD FOTO PROFILE
    public function updatePhoto(Request $request)
    {
        $request->validate([
            'profile_photo' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $user = Auth::user();

        // hapus foto lama kalau ada
        if ($user->profile_photo) {
            Storage::disk('public')->delete($user->profile_photo);
        }

        // upload baru
        $path = $request->file('profile_photo')->store('profile', 'public');

        $user->update([
            'profile_photo' => $path
        ]);

        return back()->with('success', 'Foto berhasil diupload');
    }
}