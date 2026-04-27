<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Blog;
use App\Models\Program;
use App\Models\Stat;
use App\Models\Event;
use App\Models\Page;

class HomeController extends Controller
{
    public function index()
    {
        return view('pages.home', [
            'homePage'       => Page::find('home'),
            'stats'          => Stat::orderBy('sort_order')->get(),
            'programs'       => Program::all(),
            'latestNews'     => News::orderBy('date', 'desc')->limit(3)->get(),
            'latestBlog'     => Blog::orderBy('date', 'desc')->limit(3)->get(),
            'upcomingEvents' => Event::where('event_date', '>=', now()->toDateString())
                                     ->orderBy('event_date')->limit(3)->get(),
        ]);
    }
}
