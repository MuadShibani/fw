<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        return view('admin.blog.index', [
            'items' => Blog::orderBy('date', 'desc')->paginate(15),
        ]);
    }

    public function create()
    {
        return view('admin.blog.form', ['item' => null]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'date'       => 'required|date',
            'title_en'   => 'required|string|max:255',
            'title_ar'   => 'required|string|max:255',
            'summary_en' => 'required|string',
            'summary_ar' => 'required|string',
            'content_en' => 'required|string',
            'content_ar' => 'required|string',
            'author_en'  => 'required|string|max:100',
            'author_ar'  => 'required|string|max:100',
            'image_en'   => 'nullable|string',
            'image_ar'   => 'nullable|string',
        ]);
        Blog::create($data);
        return redirect('/admin/blog')->with('success', 'Blog post created.');
    }

    public function edit(int $id)
    {
        return view('admin.blog.form', ['item' => Blog::findOrFail($id)]);
    }

    public function update(Request $request, int $id)
    {
        $item = Blog::findOrFail($id);
        $data = $request->validate([
            'date'       => 'required|date',
            'title_en'   => 'required|string|max:255',
            'title_ar'   => 'required|string|max:255',
            'summary_en' => 'required|string',
            'summary_ar' => 'required|string',
            'content_en' => 'required|string',
            'content_ar' => 'required|string',
            'author_en'  => 'required|string|max:100',
            'author_ar'  => 'required|string|max:100',
            'image_en'   => 'nullable|string',
            'image_ar'   => 'nullable|string',
        ]);
        $item->update($data);
        return redirect('/admin/blog')->with('success', 'Blog post updated.');
    }

    public function destroy(int $id)
    {
        Blog::findOrFail($id)->delete();
        return redirect('/admin/blog')->with('success', 'Blog post deleted.');
    }
}
