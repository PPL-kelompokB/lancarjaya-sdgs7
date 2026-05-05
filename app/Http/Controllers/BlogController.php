<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    // ✅ Tampilkan semua blog
    public function index()
    {
        $blogs = Blog::latest()->get();
        return view('blog.index', compact('blogs'));
    }

    // ✅ Form create
    public function create()
    {
        return view('blog.create');
    }

    // ✅ Simpan data
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required'
        ]);

        Blog::create([
            'title' => $request->title,
            'content' => $request->content
        ]);

        return redirect()->route('blog.index')
                         ->with('success', 'Blog berhasil dibuat');
    }

    // ✅ Form edit
    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('blog.edit', compact('blog'));
    }

    // ✅ Update data
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required'
        ]);

        $blog = Blog::findOrFail($id);

        $blog->update([
            'title' => $request->title,
            'content' => $request->content
        ]);

        return redirect()->route('blog.index')
                         ->with('success', 'Blog berhasil diupdate');
    }

    // ✅ Hapus data
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();

        return redirect()->route('blog.index')
                         ->with('success', 'Blog berhasil dihapus');
    }
}