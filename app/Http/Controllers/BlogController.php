<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    // ================== READ (LIST) ==================
    public function index()
    {
        $blogs = Blog::latest()->get();
        return view('blog.index', compact('blogs'));
    }

    // ================== CREATE FORM ==================
    public function create()
    {
        return view('blog.create');
    }

    // ================== STORE ==================
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        Blog::create([
            'title' => $request->title,
            'content' => $request->content,
            'organization_id' => null // sementara dulu
        ]);

        return redirect()->route('blog.index')
            ->with('success', 'Blog berhasil dibuat!');
    }

    // ================== SHOW DETAIL ==================
    public function show($id)
    {
        $blog = Blog::findOrFail($id);
        return view('blog.show', compact('blog'));
    }

    // ================== EDIT FORM ==================
    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('blog.edit', compact('blog'));
    }

    // ================== UPDATE ==================
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        $blog = Blog::findOrFail($id);

        $blog->update([
            'title' => $request->title,
            'content' => $request->content
        ]);

        return redirect()->route('blog.index')
            ->with('success', 'Blog berhasil diupdate!');
    }

    // ================== DELETE ==================
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();

        return redirect()->route('blog.index')
            ->with('success', 'Blog berhasil dihapus!');
    }
}