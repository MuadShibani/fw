<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        return view('admin.news.index', [
            'items' => News::orderBy('date', 'desc')->paginate(15),
        ]);
    }

    public function create()
    {
        return view('admin.news.form', ['item' => null]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'date'       => 'required|date',
            'title_en'   => 'required|string|max:255',
            'title_ar'   => 'required|string|max:255',
            'summary_en' => 'required|string',
            'summary_ar' => 'required|string',
            'content_en' => 'nullable|string',
            'content_ar' => 'nullable|string',
            'category'   => 'required|string|max:100',
            'image_en'   => 'nullable|string',
            'image_ar'   => 'nullable|string',
        ]);
        News::create($data);
        return redirect('/admin/news')->with('success', 'News article created.');
    }

    public function edit(int $id)
    {
        return view('admin.news.form', ['item' => News::findOrFail($id)]);
    }

    public function update(Request $request, int $id)
    {
        $item = News::findOrFail($id);
        $data = $request->validate([
            'date'       => 'required|date',
            'title_en'   => 'required|string|max:255',
            'title_ar'   => 'required|string|max:255',
            'summary_en' => 'required|string',
            'summary_ar' => 'required|string',
            'content_en' => 'nullable|string',
            'content_ar' => 'nullable|string',
            'category'   => 'required|string|max:100',
            'image_en'   => 'nullable|string',
            'image_ar'   => 'nullable|string',
        ]);
        $item->update($data);
        return redirect('/admin/news')->with('success', 'News article updated.');
    }

    public function destroy(int $id)
    {
        News::findOrFail($id)->delete();
        return redirect('/admin/news')->with('success', 'News article deleted.');
    }
}
