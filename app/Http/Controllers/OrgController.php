<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Organization;
use Illuminate\Http\Request;
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
        ]);

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
            'verification_status' => 'pending',
        ]);

        return redirect('/login')->with('success', 'Registrasi organisasi berhasil. Menunggu verifikasi admin.');
    }

    public function dashboard()
    {
        $organization = \App\Models\Organization::where('user_id', auth()->id())->firstOrFail();

        return view('organization.dashboard', compact('organization'));
    }
}