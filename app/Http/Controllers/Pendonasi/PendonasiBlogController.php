<?php

namespace App\Http\Controllers\Pendonasi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PendonasiBlog;

class PendonasiBlogController extends Controller
{
    // ================== READ (LIST) ==================
    public function index()
    {
        $blogs = PendonasiBlog::latest()->get();
        return view('pendonasi.blog.index', compact('blogs'));
    }

    // ================== CREATE (FORM) ==================
    public function create()
    {
        return view('pendonasi.blog.create');
    }

    // ================== STORE (SIMPAN DATA) ==================
    public function store(Request $request)
    {
        $request->validate([
            'title'    => 'required|max:255',
            'content'  => 'required',
            'category' => 'required',
            'image'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // Handle upload gambar (opsional)
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('blog_images', 'public');
        }

        PendonasiBlog::create([
            'title'    => $request->title,
            'content'  => $request->content,
            'category' => $request->category,
            'tags'     => $request->tags,
            'image'    => $imagePath,
            'user_id'  => auth()->id()
        ]);

        return redirect()->route('blog.index')
                         ->with('success', 'Blog berhasil ditambahkan');
    }

    // ================== READ (DETAIL) ==================
    public function show($id)
    {
        $blog = PendonasiBlog::findOrFail($id);
        return view('pendonasi.blog.show', compact('blog'));
    }

    // ================== EDIT (FORM EDIT) ==================
    public function edit($id)
    {
        $blog = PendonasiBlog::findOrFail($id);
        return view('pendonasi.blog.edit', compact('blog'));
    }

    // ================== UPDATE ==================
    public function update(Request $request, $id)
    {
        $blog = PendonasiBlog::findOrFail($id);

        $request->validate([
            'title'    => 'required|max:255',
            'content'  => 'required',
            'category' => 'required',
            'image'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // Update gambar jika ada
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('blog_images', 'public');
            $blog->image = $imagePath;
        }

        $blog->update([
            'title'    => $request->title,
            'content'  => $request->content,
            'category' => $request->category,
            'tags'     => $request->tags,
        ]);

        return redirect()->route('blog.index')
                         ->with('success', 'Blog berhasil diupdate');
    }

    // ================== DELETE ==================
    public function destroy($id)
    {
        $blog = PendonasiBlog::findOrFail($id);
        $blog->delete();

        return redirect()->route('blog.index')
                         ->with('success', 'Blog berhasil dihapus');
    }
}