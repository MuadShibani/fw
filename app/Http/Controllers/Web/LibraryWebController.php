<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Library;
use App\Models\Page;

class LibraryWebController extends Controller
{
    public function index()
    {
        return view('pages.library', [
            'page'  => Page::find('library'),
            'items' => Library::orderBy('file_date', 'desc')->get(),
        ]);
    }
}
