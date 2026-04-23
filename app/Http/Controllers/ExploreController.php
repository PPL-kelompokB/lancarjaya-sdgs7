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

        $blogs = Blog::with('user')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', '%' . $search . '%')
                      ->orWhere('content', 'like', '%' . $search . '%');
                });
            })
            ->get();

        $donations = Donation::with('organization')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', '%' . $search . '%')
                      ->orWhere('description', 'like', '%' . $search . '%');
                });
            })
            ->get();

        $volunteers = VolunteerRequest::with('organization')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', '%' . $search . '%')
                      ->orWhere('description', 'like', '%' . $search . '%');
                });
            })
            ->get();

        $explore = collect();

        foreach ($blogs as $b) {
            $explore->push((object)[
                'type' => 'blog',
                'id' => $b->id,
                'title' => $b->title,
                'content' => $b->content,
                'image' => $b->image,
                'user' => $b->user
            ]);
        }

        foreach ($donations as $d) {
            $explore->push((object)[
                'type' => 'donation',
                'id' => $d->id,
                'title' => $d->title,
                'description' => $d->description,
                'image' => $d->image,
                'organization' => $d->organization
            ]);
        }

        foreach ($volunteers as $v) {
            $explore->push((object)[
                'type' => 'volunteer',
                'id' => $v->id,
                'title' => $v->title,
                'description' => $v->description,
                'image' => $v->image,
                'organization' => $v->organization
            ]);
        }

        return view('user.explore', compact('explore', 'search'));
    }

    public function detailBlog($id)
    {
        $blog = Blog::with('user')->findOrFail($id);

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