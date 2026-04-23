<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    // INDEX
    public function index()
    {
        $blogs = Blog::with('user')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        $role = Auth::user()->role;

        // 🔥 SESUAIKAN DENGAN VIEW YANG KAMU PUNYA
        return view('user.index', compact('blogs'));
    }

    // STORE
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imagePath = $request->hasFile('image')
            ? $request->file('image')->store('blogs', 'public')
            : null;

        Blog::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imagePath,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('user.blog.index')
            ->with('success', 'Blog berhasil dibuat!');
    }

    // EDIT
   public function edit($id)
{
    $blog = Blog::where('user_id', Auth::id())
        ->where('id', $id)
        ->firstOrFail();

    return view('user.editBlog', compact('blog'));
}

    // UPDATE
    public function update(Request $request, $id)
    {
        $blog = Blog::where('user_id', Auth::id())
            ->where('id', $id)
            ->firstOrFail();

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = [
            'title' => $request->title,
            'content' => $request->content,
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('blogs', 'public');
        }

        $blog->update($data);

        return redirect()->route('user.blog.index')
            ->with('success', 'Blog berhasil diupdate!');
    }

    // DELETE
    public function destroy($id)
    {
        $blog = Blog::where('user_id', Auth::id())
            ->where('id', $id)
            ->firstOrFail();

        $blog->delete();

        return redirect()->route('user.blog.index')
            ->with('success', 'Blog berhasil dihapus!');
    }
}