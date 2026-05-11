<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Organization;
use App\Models\Donation;
use App\Models\VolunteerRequest;

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

    public function activityMonitor(Request $request)
    {
        $orgId    = $request->get('org_id');
        $type     = $request->get('type');
        $status   = $request->get('status');
        $search   = $request->get('search');

        // -- Volunteer --
        $volunteerQuery = VolunteerRequest::with('organization')->latest();
        if ($orgId)  $volunteerQuery->where('organization_id', $orgId);
        if ($search) $volunteerQuery->where(function($q) use ($search) {
            $q->where('title', 'like', "%$search%")
              ->orWhere('description', 'like', "%$search%");
        });

        // -- Donation --
        $donationQuery = Donation::with('organization')->latest();
        if ($orgId)  $donationQuery->where('organization_id', $orgId);
        if ($status) $donationQuery->where('status', $status);
        if ($search) $donationQuery->where(function($q) use ($search) {
            $q->where('title', 'like', "%$search%")
              ->orWhere('description', 'like', "%$search%");
        });

        // Build activity feed
        $activities = collect();

        if (!$type || $type === 'volunteer') {
            foreach ($volunteerQuery->get() as $v) {
                $activities->push((object)[
                    'type'              => 'volunteer',
                    'id'                => $v->id,
                    'title'             => $v->title,
                    'description'       => $v->description,
                    'status'            => $v->event_type ?? '-',
                    'org_name'          => $v->organization->organization_name ?? '-',
                    'org_id'            => $v->organization_id,
                    'event_date'        => $v->event_date,
                    'deadline'          => $v->deadline,
                    'volunteer_quota'   => $v->volunteer_quota,
                    'location'          => $v->location,
                    'created_at'        => $v->created_at,
                ]);
            }
        }

        if (!$type || $type === 'donation') {
            foreach ($donationQuery->get() as $d) {
                $activities->push((object)[
                    'type'        => 'donation',
                    'id'          => $d->id,
                    'title'       => $d->title,
                    'description' => $d->description,
                    'status'      => $d->status,
                    'org_name'    => $d->organization->organization_name ?? '-',
                    'org_id'      => $d->organization_id,
                    'event_date'  => null,
                    'deadline'    => null,
                    'item_name'   => $d->item_name ?? null,
                    'created_at'  => $d->created_at,
                ]);
            }
        }

        $activities = $activities->sortByDesc('created_at')->values();

        // Stats
        $totalVolunteer   = VolunteerRequest::count();
        $totalDonation    = Donation::count();
        $openDonations    = Donation::where('status', 'open')->count();
        $doneDonations    = Donation::where('status', 'completed')->count();

        $organizations = Organization::where('verification_status', 'verified')
            ->orderBy('organization_name')->get();

        return view('admin.activity-monitor', compact(
            'activities', 'organizations', 'orgId', 'type', 'status', 'search',
            'totalVolunteer', 'totalDonation', 'openDonations', 'doneDonations'
        ));
    }
}