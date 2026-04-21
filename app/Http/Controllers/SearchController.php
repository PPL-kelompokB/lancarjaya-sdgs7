<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Organization;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Search semua data sekaligus:
     * - blogs
     * - organizations
     */
    public function globalSearch(Request $request)
    {
        $keyword = trim($request->query('keyword', ''));

        $blogs = collect();
        $organizations = collect();

        if ($keyword !== '') {
            $blogs = Blog::with('organization')
                ->where(function ($query) use ($keyword) {
                    $query->where('title', 'like', '%' . $keyword . '%')
                          ->orWhere('content', 'like', '%' . $keyword . '%');
                })
                ->latest()
                ->get();

            $organizations = Organization::where(function ($query) use ($keyword) {
                    $query->where('organization_name', 'like', '%' . $keyword . '%')
                          ->orWhere('organization_type', 'like', '%' . $keyword . '%')
                          ->orWhere('description', 'like', '%' . $keyword . '%')
                          ->orWhere('pic_name', 'like', '%' . $keyword . '%')
                          ->orWhere('pic_email', 'like', '%' . $keyword . '%');
                })
                ->latest()
                ->get();
        }

        return view('search.index', compact('keyword', 'blogs', 'organizations'));
    }

    /**
     * Search khusus blog
     */
    public function searchBlogs(Request $request)
    {
        $keyword = trim($request->query('keyword', ''));

        $blogs = Blog::with('organization')
            ->when($keyword !== '', function ($query) use ($keyword) {
                $query->where(function ($q) use ($keyword) {
                    $q->where('title', 'like', '%' . $keyword . '%')
                      ->orWhere('content', 'like', '%' . $keyword . '%');
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('search.blogs', compact('keyword', 'blogs'));
    }

    /**
     * Search khusus akun organisasi
     */
    public function searchOrganizations(Request $request)
    {
        $keyword = trim($request->query('keyword', ''));

        $organizations = Organization::when($keyword !== '', function ($query) use ($keyword) {
                $query->where(function ($q) use ($keyword) {
                    $q->where('organization_name', 'like', '%' . $keyword . '%')
                      ->orWhere('organization_type', 'like', '%' . $keyword . '%')
                      ->orWhere('description', 'like', '%' . $keyword . '%')
                      ->orWhere('pic_name', 'like', '%' . $keyword . '%')
                      ->orWhere('pic_email', 'like', '%' . $keyword . '%');
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('search.organizations', compact('keyword', 'organizations'));
    }
}