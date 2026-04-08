<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Library;

class LibraryWebController extends Controller
{
    public function index()
    {
        return view('pages.library', [
            'items' => Library::orderBy('file_date', 'desc')->get(),
        ]);
    }
}
