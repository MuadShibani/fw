<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Blog;

class BlogWebController extends Controller
{
    public function index()
    {
        return view('pages.blog', [
            'posts' => Blog::orderBy('date', 'desc')->paginate(9),
        ]);
    }

    public function show(int $id)
    {
        return view('pages.blog-post', [
            'post'        => Blog::findOrFail($id),
            'recentPosts' => Blog::orderBy('date', 'desc')->limit(5)->get(),
        ]);
    }
}
