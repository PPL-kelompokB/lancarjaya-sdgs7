<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Comment;
use App\Models\Blog;
use App\Models\Donation;
use App\Models\VolunteerRequest;

class InteractionController extends Controller
{
    private function getModel($type, $id)
    {
        return match ($type) {
            'blog' => Blog::findOrFail($id),
            'donation' => Donation::findOrFail($id),
            'volunteer' => VolunteerRequest::findOrFail($id),
        };
    }

    public function like($type, $id)
    {
        $model = $this->getModel($type, $id);

        $like = Like::where([
            'user_id' => auth()->id(),
            'likeable_type' => get_class($model),
            'likeable_id' => $model->id,
        ])->first();

        if ($like) {
            $like->delete(); // unlike
        } else {
            Like::create([
                'user_id' => auth()->id(),
                'likeable_type' => get_class($model),
                'likeable_id' => $model->id,
            ]);
        }

        return back();
    }

    public function comment(Request $request, $type, $id)
    {
        $request->validate([
            'body' => 'required'
        ]);

        $model = $this->getModel($type, $id);

        Comment::create([
            'user_id' => auth()->id(),
            'commentable_type' => get_class($model),
            'commentable_id' => $model->id,
            'body' => $request->body,
        ]);

        return back();
    }
}