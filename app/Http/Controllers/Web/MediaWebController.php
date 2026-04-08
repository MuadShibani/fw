<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\News;

class MediaWebController extends Controller
{
    public function index()
    {
        return view('pages.media', [
            'news'       => News::orderBy('date', 'desc')->paginate(9),
            'categories' => News::distinct()->orderBy('category')->pluck('category'),
        ]);
    }
}
