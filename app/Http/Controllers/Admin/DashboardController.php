<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Blog;
use App\Models\Event;
use App\Models\Library;
use App\Models\Investor;
use App\Models\Startup;
use App\Models\Cohort;
use App\Models\Message;
use App\Models\WiifPortfolio;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'counts' => [
                'news'            => News::count(),
                'blog'            => Blog::count(),
                'events'          => Event::count(),
                'library'         => Library::count(),
                'investors'       => Investor::count(),
                'startups'        => Startup::count(),
                'cohorts'         => Cohort::count(),
                'wiif_portfolio'  => WiifPortfolio::count(),
                'messages'        => Message::count(),
                'unread_messages' => Message::where('is_read', false)->count(),
            ],
            'recentNews'      => News::orderBy('date', 'desc')->limit(5)->get(),
            'recentBlog'      => Blog::orderBy('date', 'desc')->limit(5)->get(),
            'upcomingEvents'  => Event::where('event_date', '>=', now()->toDateString())->orderBy('event_date')->limit(5)->get(),
            'latestMessages'  => Message::orderBy('created_at', 'desc')->limit(5)->get(),
            'activeCohort'    => Cohort::where('status', 'Active')->first(),
        ]);
    }
}
