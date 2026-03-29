<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organization;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUsers = \App\Models\User::where('role', 'user')->count();
        $totalOrganizations = \App\Models\Organization::count();
        $pendingOrganizationsCount = \App\Models\Organization::where('verification_status', 'pending')->count();
        $organizations = \App\Models\Organization::where('verification_status', 'pending')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalOrganizations',
            'pendingOrganizationsCount',
            'organizations'
        ));
    }
    public function pendingOrganizations()
    {
        $organizations = Organization::where('verification_status', 'pending')->get();
        return view('admin.pending-organizations', compact('organizations'));
    }

    public function approve($id)
    {
        $organization = Organization::findOrFail($id);

        $organization->update([
            'verification_status' => 'verified',
            'verification_note' => null,
        ]);

        return back()->with('success', 'Organisasi berhasil diverifikasi');
    }

    public function reject(Request $request, $id)
    {
        $organization = Organization::findOrFail($id);

        $request->validate([
            'note' => 'required|string'
        ]);

        $organization->update([
            'verification_status' => 'rejected',
            'verification_note' => $request->note,
        ]);

        return back()->with('success', 'Organisasi ditolak');
    }

}
