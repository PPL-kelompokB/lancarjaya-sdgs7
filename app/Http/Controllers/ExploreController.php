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
            $b->likes_count = Like::where('likeable_id', $b->id)
                ->where('likeable_type', 'App\Models\Blog')
                ->count();
                
            $explore->push((object)[
                'type' => 'blog',
                'id' => $b->id,
                'title' => $b->title,
                'content' => $b->content,
                'image' => $b->image,
                'user' => $b->user,
                'likes' => $b->likes_count,
                'comments' => $b->comments ?? 0,
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
            $likeCount = Like::where('likeable_id', $v->id)
                ->where('likeable_type', VolunteerRequest::class)
                ->count();

            $commentCount = VolunteerComment::where('volunteer_request_id', $v->id)
                ->count();

            $explore->push((object)[
                'type' => 'volunteer',
                'id' => $v->id,
                'title' => $v->title,
                'description' => $v->description,
                'image' => $v->image,
                'organization' => $v->organization,
                'likes' => $likeCount,
                'comments' => $commentCount
            ]);
        }

        return view('user.explore', compact('explore', 'search'));
    }

    public function detailBlog($id)
    {
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
    }

    public function detailDonation($id)
    {
        $donation = Donation::with('organization')->findOrFail($id);

        return view('user.explore-detail-donation', compact('donation'));
    }

    public function detailVolunteer($id)
    {

        $volunteer = VolunteerRequest::with('organization')->findOrFail($id);

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
    }
}