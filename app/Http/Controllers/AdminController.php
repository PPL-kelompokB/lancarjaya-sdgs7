<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Organization;
use App\Models\Donation;
use App\Models\VolunteerRequest;
use App\Models\Blog;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUsers = User::where('role', 'user')->count();

        // Tidak menghitung organisasi yang rejected
        $totalOrganizations = Organization::whereIn('verification_status', ['pending', 'verified'])->count();

        $pendingOrganizationsCount = Organization::where('verification_status', 'pending')->count();

        $organizations = Organization::where('verification_status', 'pending')
            ->latest()
            ->take(5)
            ->get();

        $totalDonations = Donation::count();
        $openDonations = Donation::where('status', 'open')->count();
        $inProgressDonations = Donation::where('status', 'in_progress')->count();
        $completedDonations = Donation::where('status', 'completed')->count();

        $latestDonations = Donation::with('organization')
            ->latest()
            ->take(6)
            ->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalOrganizations',
            'pendingOrganizationsCount',
            'organizations',
            'totalDonations',
            'openDonations',
            'inProgressDonations',
            'completedDonations',
            'latestDonations'
        ));
    }

    public function showOrganization($id)
    {
        $organization = Organization::with('user')->findOrFail($id);

        return view('admin.verifikasi-org', compact('organization'));
    }

    public function organizations(Request $request)
    {
        $status = $request->get('status');
        $type = $request->get('type');
        $search = $request->get('search');

        $query = Organization::query()->latest();

        if (!empty($status)) {
            $query->where('verification_status', $status);
        }

        if (!empty($type)) {
            $query->where('organization_type', $type);
        }

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('organization_name', 'like', '%' . $search . '%')
                  ->orWhere('pic_name', 'like', '%' . $search . '%')
                  ->orWhere('pic_email', 'like', '%' . $search . '%');
            });
        }

        $organizations = $query->paginate(10)->withQueryString();

        // Tidak menghitung rejected di total
        $totalOrganizations = Organization::whereIn('verification_status', ['pending', 'verified'])->count();

        $pendingCount = Organization::where('verification_status', 'pending')->count();
        $verifiedCount = Organization::where('verification_status', 'verified')->count();
        $rejectedCount = Organization::where('verification_status', 'rejected')->count();

        $organizationTypes = Organization::select('organization_type')
            ->whereNotNull('organization_type')
            ->distinct()
            ->pluck('organization_type');

        return view('admin.organizations', compact(
            'organizations',
            'totalOrganizations',
            'pendingCount',
            'verifiedCount',
            'rejectedCount',
            'organizationTypes',
            'status',
            'type',
            'search'
        ));
    }

    public function approve($id)
    {
        $organization = Organization::findOrFail($id);

        $organization->update([
            'verification_status' => 'verified',
            'verification_note' => null,
        ]);

        return redirect()
            ->route('admin.organizations.index')
            ->with('success', 'Organisasi berhasil diverifikasi');
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'note' => 'required|string',
        ]);

        $organization = Organization::findOrFail($id);

        $organization->update([
            'verification_status' => 'rejected',
            'verification_note' => $request->note,
        ]);

        return redirect()
            ->route('admin.organizations.index')
            ->with('success', 'Organisasi berhasil ditolak');
    }

    public function monitoring(Request $request)
    {
        $status = $request->get('status');
        $sort = $request->get('sort', 'latest');

        $query = Organization::where('verification_status', 'verified')
            ->with(['donations', 'volunteerRequests', 'followers', 'blogs']);

        if (!empty($status)) {
            $query->where('organization_type', $status);
        }

        if ($sort === 'most_active') {
            $query->withCount(['donations', 'volunteerRequests', 'followers', 'blogs'])
                ->orderBy('donations_count', 'desc');
        } else {
            $query->latest();
        }

        $organizations = $query->paginate(15)->withQueryString();

        // Hitung statistik aktivitas
        $organizationStats = [];
        foreach ($organizations as $org) {
            $organizationStats[$org->id] = [
                'donations_count' => $org->donations()->count(),
                'volunteer_requests_count' => $org->volunteerRequests()->count(),
                'followers_count' => $org->followers()->count(),
                'blogs_count' => $org->blogs()->count(),
                'total_activities' => $org->donations()->count() + $org->volunteerRequests()->count() + $org->blogs()->count(),
            ];
        }

        // Total statistik global
        $verifiedOrganizations = Organization::where('verification_status', 'verified')->count();
        $totalDonations = Donation::count();
        $totalVolunteerRequests = VolunteerRequest::count();
        $totalBlogs = Blog::count();
        $totalFollows = \DB::table('organization_followers')->count();

        // Organisasi paling aktif
        $mostActiveOrganizations = Organization::where('verification_status', 'verified')
            ->withCount(['donations', 'volunteerRequests', 'followers', 'blogs'])
            ->orderBy('donations_count', 'desc')
            ->take(5)
            ->get();

        $organizationTypes = Organization::where('verification_status', 'verified')
            ->select('organization_type')
            ->whereNotNull('organization_type')
            ->distinct()
            ->pluck('organization_type');

        return view('admin.monitoring-admin', compact(
            'organizations',
            'organizationStats',
            'verifiedOrganizations',
            'totalDonations',
            'totalVolunteerRequests',
            'totalBlogs',
            'totalFollows',
            'mostActiveOrganizations',
            'organizationTypes',
            'status',
            'sort'
        ));
    }
}