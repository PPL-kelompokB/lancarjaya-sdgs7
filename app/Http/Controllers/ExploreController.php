<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Like;
use App\Models\Comment;
use App\Models\Donation;
use App\Models\VolunteerRequest;
use App\Models\VolunteerComment;

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
<<<<<<< HEAD
            $b->likes_count = Like::where('likeable_id', $b->id)
                ->where('likeable_type', 'App\Models\Blog')
                ->count();
                
=======
            $organization = $b->user?->organization;

>>>>>>> 49b0fcc4eb28c8626a36b75eb9e3a73d851e5315
            $explore->push((object)[
                'type' => 'blog',
                'id' => $b->id,
                'title' => $b->title,
                'content' => $b->content,
                'description' => null,
                'image' => $b->image,
<<<<<<< HEAD
                'user' => $b->user,
                'likes' => $b->likes_count,
                'comments' => $b->comments ?? 0,
=======

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
>>>>>>> 49b0fcc4eb28c8626a36b75eb9e3a73d851e5315
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
            $likeCount = Like::where('likeable_id', $v->id)
                ->where('likeable_type', VolunteerRequest::class)
                ->count();

            $commentCount = VolunteerComment::where('volunteer_request_id', $v->id)
                ->count();

            $explore->push((object)[
                'type' => 'volunteer',
                'id' => $v->id,
                'title' => $v->title,
                'content' => null,
                'description' => $v->description,
                'image' => $v->image,
<<<<<<< HEAD
                'organization' => $v->organization,
                'likes' => $likeCount,
                'comments' => $commentCount
=======

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
>>>>>>> 49b0fcc4eb28c8626a36b75eb9e3a73d851e5315
            ]);
        }

        $explore = $explore->sortByDesc('created_at')->values();

        return view('user.explore', compact('explore', 'search'));
    }

    public function detailBlog($id)
    {
<<<<<<< HEAD
        $blog = Blog::with('user')->findOrFail($id);

        $liked = Like::where('user_id', auth()->id())
            ->where('likeable_id', $blog->id)
            ->where('likeable_type', Blog::class)
            ->exists();

        $likeCount = Like::where('likeable_id', $blog->id)
            ->where('likeable_type', Blog::class)
            ->count();

        $comments = Comment::with('user')
            ->where('blog_id', $id)
            ->latest()
            ->get();

        return view('user.explore-detail-blog', compact(
            'blog',
            'liked',
            'likeCount',
            'comments'
        ));
=======
        $blog = Blog::with('user.organization')->findOrFail($id);
        return view('user.explore-detail-blog', compact('blog'));
>>>>>>> 49b0fcc4eb28c8626a36b75eb9e3a73d851e5315
    }

    public function detailDonation($id)
    {
        $donation = Donation::with('organization')->findOrFail($id);
        return view('user.explore-detail-donation', compact('donation'));
    }

    public function detailVolunteer($id)
    {

        $volunteer = VolunteerRequest::with('organization')->findOrFail($id);
<<<<<<< HEAD

        $liked = Like::where('user_id', auth()->id())
            ->where('likeable_id', $id)
            ->where('likeable_type', VolunteerRequest::class)
            ->exists();

        $comments = VolunteerComment::with('user')
            ->where('volunteer_request_id', $id)
            ->latest()
            ->get();

        return view('user.explore-detail-volunteer', compact(
            'volunteer',
            'liked',
            'comments'
        ));
    }

    public function likeBlog($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->increment('likes');

        return back();
    }

    public function commentBlog(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required|string|max:500'
        ]);

        Comment::create([
            'user_id' => auth()->id(),
            'blog_id' => $id,
            'comment' => $request->comment
        ]);

        $blog = Blog::findOrFail($id);
        $blog->increment('comments');

        return back();
    }

    public function toggleLikeBlog($id)
    {
        $blog = Blog::findOrFail($id);

        $like = Like::where('user_id', auth()->id())
            ->where('likeable_id', $blog->id)
            ->where('likeable_type', Blog::class)
            ->first();

        if ($like) {
            $like->delete();
        } else {
            Like::create([
                'user_id' => auth()->id(),
                'likeable_id' => $blog->id,
                'likeable_type' => Blog::class,
            ]);
        }

        return back();
    }

    public function commentVolunteer(Request $request, $id)
    {
        $request->validate([
        'comment' => 'required|max:500'
        ]);

        VolunteerComment::create([
            'user_id' => auth()->id(),
            'volunteer_request_id' => $id,
            'comment' => $request->comment
        ]);

        return back();
    }

    public function toggleLikeVolunteer($id)
    {
        $volunteer = VolunteerRequest::findOrFail($id);

        $like = Like::where('user_id', auth()->id())
            ->where('likeable_id', $id)
            ->where('likeable_type', VolunteerRequest::class)
            ->first();

        if ($like) {
            $like->delete();
        } else {
            Like::create([
                'user_id' => auth()->id(),
                'likeable_id' => $id,
                'likeable_type' => VolunteerRequest::class,
            ]);
        }

        return back();
=======
        return view('user.explore-detail-volunteer', compact('volunteer'));
>>>>>>> 49b0fcc4eb28c8626a36b75eb9e3a73d851e5315
    }
}