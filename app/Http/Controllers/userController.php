<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // DASHBOARD
    public function dashboard()
    {
        $user = Auth::user();
        $donations = collect();

        return view('user.dashboard', compact('user', 'donations'));
    }

    // UPDATE PROFILE
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name'    => ['required', 'string', 'max:255'],
            'email'   => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'phone'   => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:255'],
        ]);

        $user->update($validated);

        return back()->with('success', 'Profile berhasil diupdate');
    }

    // UPLOAD FOTO PROFILE
    public function updatePhoto(Request $request)
    {
        $request->validate([
            'profile_photo' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        $user = Auth::user();

        if (!empty($user->profile_photo) && Storage::disk('public')->exists($user->profile_photo)) {
            Storage::disk('public')->delete($user->profile_photo);
        }

        $path = $request->file('profile_photo')->store('profile', 'public');

        $user->update([
            'profile_photo' => $path,
        ]);

        return back()->with('success', 'Foto berhasil diupload');
    }
}