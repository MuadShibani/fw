<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Page;

class MediaWebController extends Controller
{
    public function index()
    {
        return view('pages.media', [
            'page'       => Page::find('media'),
            'news'       => News::orderBy('date', 'desc')->paginate(9),
            'categories' => News::distinct()->orderBy('category')->pluck('category'),
        ]);
    }

    public function show(int $id)
    {
        return view('pages.media-single', [
            'item'        => News::findOrFail($id),
            'relatedNews' => News::where('id', '!=', $id)->orderBy('date', 'desc')->limit(5)->get(),
        ]);
    }
}
