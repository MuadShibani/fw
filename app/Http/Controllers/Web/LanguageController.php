<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function switch(Request $request)
    {
        $lang = in_array($request->input('lang'), ['en', 'ar']) ? $request->input('lang') : 'en';
        session(['lang' => $lang]);
        return back();
    }
}
