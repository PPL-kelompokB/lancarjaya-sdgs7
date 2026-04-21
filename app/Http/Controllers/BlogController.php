<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'organization_id' => 'required|exists:organizations,id',
        ]);

        Blog::create([
            'title' => $request->title,
            'content' => $request->content,
            'organization_id' => $request->organization_id,
        ]);

        return redirect()->route('organization.dashboard')
            ->with('success', 'Blog berhasil dibuat!');
    }
}