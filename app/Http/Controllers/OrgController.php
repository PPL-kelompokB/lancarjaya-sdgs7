<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Organization;
use App\Models\Blog;
use App\Models\VolunteerRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;


class OrgController extends Controller
{
    public function showRegisterOrganization()
    {
        return view('auth.register-org');
    }

    public function registerOrganization(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',

            'organization_name' => 'required|string|max:255',
            'organization_type' => 'required|string|max:255',
            'address' => 'required|string',
            'org_phone' => 'required|string|max:20',

            'pic_name' => 'required|string|max:255',
            'pic_email' => 'required|email|max:255',
            'pic_phone' => 'required|string|max:20',

            'founded_year' => 'nullable|digits:4',
            'description' => 'nullable|string',
            'bank_name' => 'nullable|string|max:255',
            'account_holder_name' => 'nullable|string|max:255',
            'rekening_number' => 'nullable|string|max:50',
            'bank_proof' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $bankProofPath = null;

        if ($request->hasFile('bank_proof')) {
            $bankProofPath = $request->file('bank_proof')->store('bank_proofs', 'public');
        }
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'organization',
        ]);

        Organization::create([
            'user_id' => $user->id,
            'organization_name' => $request->organization_name,
            'organization_type' => $request->organization_type,
            'address' => $request->address,
            'org_phone' => $request->org_phone,
            'pic_name' => $request->pic_name,
            'pic_email' => $request->pic_email,
            'pic_phone' => $request->pic_phone,
            'founded_year' => $request->founded_year,
            'description' => $request->description,
            'bank_name' => $request->bank_name,
            'account_holder_name' => $request->account_holder_name,
            'rekening_number' => $request->rekening_number,
            'bank_proof'=>$bankProofPath,
            'verification_status' => 'pending',
        ]);

        return redirect('/login')->with('success', 'Registrasi organisasi berhasil. Menunggu verifikasi admin.');
    }

    public function dashboard()
    {
        $organization = Organization::where('user_id', auth()->id())->firstOrFail();

        $volunteerRequests = VolunteerRequest::where('organization_id', $organization->id)
            ->latest()
            ->get();

        return view('organization.dashboard', compact('organization', 'volunteerRequests'));
    }

    public function updateProfile(Request $request)
{
    $organization = Organization::where('user_id', Auth::id())->firstOrFail();

    $validated = $request->validate([
        'organization_name' => 'required|string|max:255',
        'organization_type' => 'nullable|string|max:255',
        'founded_year' => 'nullable|digits:4|integer|min:1900|max:' . date('Y'),
        'description' => 'nullable|string',
        'org_phone' => 'nullable|string|max:30',
        'address' => 'nullable|string|max:1000',
        'pic_name' => 'nullable|string|max:255',
        'pic_email' => 'nullable|email|max:255',
        'pic_phone' => 'nullable|string|max:30',
    ]);

    $organization->update($validated);

    return redirect()
        ->route('organization.dashboard')
        ->with('success', 'Profil organisasi berhasil diperbarui.');
}

public function updateCoverImage(Request $request)
{
    $organization = Organization::where('user_id', Auth::id())->firstOrFail();

    $request->validate([
        'cover_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:4096',
    ]);

    if ($request->hasFile('cover_image')) {
        if (!empty($organization->cover_image) && Storage::disk('public')->exists($organization->cover_image)) {
            Storage::disk('public')->delete($organization->cover_image);
        }

        $path = $request->file('cover_image')->store('organization/covers', 'public');
        $organization->cover_image = $path;
        $organization->save();
    }

    return redirect()
        ->route('organization.dashboard')
        ->with('success', 'Cover organisasi berhasil diperbarui.');
}

public function updateProfileImage(Request $request)
{
    $organization = Organization::where('user_id', Auth::id())->firstOrFail();

    $request->validate([
        'profile_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:4096',
    ]);

    if ($request->hasFile('profile_image')) {
        if (!empty($organization->profile_image) && Storage::disk('public')->exists($organization->profile_image)) {
            Storage::disk('public')->delete($organization->profile_image);
        }

        $path = $request->file('profile_image')->store('organization/profiles', 'public');
        $organization->profile_image = $path;
        $organization->save();
    }

    return redirect()
        ->route('organization.dashboard')
        ->with('success', 'Foto profil organisasi berhasil diperbarui.');
}
    public function storeBlog(Request $request)
{
    $organization = Organization::where('user_id', auth()->id())->first();

    Blog::create([
        'organization_id' => $organization->id,
        'title' => $request->title,
        'content' => $request->content
    ]);

    return back()->with('success', 'Blog berhasil dibuat');
}

}