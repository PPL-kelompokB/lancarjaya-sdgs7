<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Donation;
use App\Models\VolunteerRequest;

class ExploreController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $blogs = Blog::with('user.organization')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                      ->orWhere('content', 'like', "%{$search}%")
                      ->orWhereHas('user', function ($user) use ($search) {
                          $user->where('name', 'like', "%{$search}%")
                               ->orWhere('email', 'like', "%{$search}%");
                      })
                      ->orWhereHas('user.organization', function ($org) use ($search) {
                          $org->where('organization_name', 'like', "%{$search}%");
                      });
                });
            })
            ->latest()
            ->get();

        $donations = Donation::with('organization')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%")
                      ->orWhereHas('organization', function ($org) use ($search) {
                          $org->where('organization_name', 'like', "%{$search}%");
                      });
                });
            })
            ->latest()
            ->get();

        $volunteers = VolunteerRequest::with('organization')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%")
                      ->orWhereHas('organization', function ($org) use ($search) {
                          $org->where('organization_name', 'like', "%{$search}%");
                      });
                });
            })
            ->latest()
            ->get();

        $explore = collect();

        foreach ($blogs as $b) {
            $organization = $b->user?->organization;

            $explore->push((object)[
                'type' => 'blog',
                'id' => $b->id,
                'title' => $b->title,
                'content' => $b->content,
                'description' => null,
                'image' => $b->image,

                'author_type' => $organization ? 'organization' : 'user',

                'organization_id' => $organization?->id,
                'organization_name' => $organization?->organization_name,
                'organization_profile_image' => $organization?->profile_image,

                'user_id' => $b->user?->id,
                'user_name' => $b->user?->name,
                'user_profile_image' => $b->user?->profile_image,

                'created_at' => $b->created_at,
                'likes_count' => $b->likes()->count(),
                'comments_count' => $b->comments()->count(),
            ]);
        }

        foreach ($donations as $d) {
            $explore->push((object)[
                'type' => 'donation',
                'id' => $d->id,
                'title' => $d->title,
                'content' => null,
                'description' => $d->description,
                'image' => $d->image ?? null,

                'author_type' => 'organization',

                'organization_id' => $d->organization?->id,
                'organization_name' => $d->organization?->organization_name,
                'organization_profile_image' => $d->organization?->profile_image,

                'user_id' => null,
                'user_name' => null,
                'user_profile_image' => null,

                'created_at' => $d->created_at,
                'likes_count' => $d->likes()->count(),
                'comments_count' => $d->comments()->count(),
            ]);
        }

        foreach ($volunteers as $v) {
            $explore->push((object)[
                'type' => 'volunteer',
                'id' => $v->id,
                'title' => $v->title,
                'content' => null,
                'description' => $v->description,
                'image' => $v->image,

                'author_type' => 'organization',

                'organization_id' => $v->organization?->id,
                'organization_name' => $v->organization?->organization_name,
                'organization_profile_image' => $v->organization?->profile_image,

                'user_id' => null,
                'user_name' => null,
                'user_profile_image' => null,

                'created_at' => $v->created_at,
                'likes_count' => $v->likes()->count(),
                'comments_count' => $v->comments()->count(),
            ]);
        }

        $explore = $explore->sortByDesc('created_at')->values();

        return view('user.explore', compact('explore', 'search'));
    }

    public function detailBlog($id)
    {
        $blog = Blog::with('user.organization')->findOrFail($id);
        return view('user.explore-detail-blog', compact('blog'));
    }

    public function detailDonation($id)
    {
        $donation = Donation::with('organization')->findOrFail($id);
        return view('user.explore-detail-donation', compact('donation'));
    }

    public function detailVolunteer($id)
    {
        $volunteer = VolunteerRequest::with('organization')->findOrFail($id);
        return view('user.explore-detail-volunteer', compact('volunteer'));
    }
}