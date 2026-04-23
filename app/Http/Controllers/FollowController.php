<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    /**
     * Toggle follow / unfollow sebuah organisasi.
     */
    public function toggle(Organization $organization)
    {
        $user = Auth::user();

        if ($user->isFollowing($organization)) {
            // Unfollow
            $user->followingOrganizations()->detach($organization->id);
            $followed = false;
            $message  = 'Anda berhenti mengikuti ' . $organization->organization_name;
        } else {
            // Follow
            $user->followingOrganizations()->attach($organization->id);
            $followed = true;
            $message  = 'Anda sekarang mengikuti ' . $organization->organization_name;
        }

        $followersCount = $organization->fresh()->followers()->count();

        if (request()->wantsJson()) {
            return response()->json([
                'followed'       => $followed,
                'followers_count' => $followersCount,
                'message'        => $message,
            ]);
        }

        return back()->with('success', $message);
    }

    /**
     * Feed aktivitas dari organisasi yang di-follow user.
     */
    public function feed()
    {
        $user = Auth::user();

        $followedOrgIds = $user->followingOrganizations()->pluck('organizations.id');

        $blogs = \App\Models\Blog::with('organization')
            ->whereIn('organization_id', $followedOrgIds)
            ->latest()
            ->paginate(10);

        $followingOrganizations = $user->followingOrganizations()->latest('organization_follows.created_at')->get();

        return view('user.feed', compact('blogs', 'followingOrganizations'));
    }

    /**
     * Halaman profil publik sebuah organisasi.
     */
    public function publicProfile(Organization $organization)
    {
        $organization->load(['blogs', 'donations', 'followers']);
        $followersCount = $organization->followers()->count();
        $isFollowing    = Auth::check() ? Auth::user()->isFollowing($organization) : false;

        return view('organization.public-profile', compact('organization', 'followersCount', 'isFollowing'));
    }
}
