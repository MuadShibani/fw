<?php

namespace App\Http\Controllers\Api;

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
use Illuminate\Http\JsonResponse;

class DashboardController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'counts' => [
                'news'           => News::count(),
                'blog'           => Blog::count(),
                'events'         => Event::count(),
                'library'        => Library::count(),
                'investors'      => Investor::count(),
                'startups'       => Startup::count(),
                'cohorts'        => Cohort::count(),
                'wiif_portfolio' => WiifPortfolio::count(),
                'messages'       => Message::count(),
                'unread_messages'=> Message::where('is_read', false)->count(),
            ],
            'recent_news'     => News::orderBy('date', 'desc')->limit(5)->get(),
            'recent_blog'     => Blog::orderBy('date', 'desc')->limit(5)->get(),
            'upcoming_events' => Event::where('event_date', '>=', now()->toDateString())
                                      ->orderBy('event_date', 'asc')
                                      ->limit(5)
                                      ->get(),
            'latest_messages' => Message::orderBy('created_at', 'desc')->limit(5)->get(),
            'active_cohort'   => Cohort::where('status', 'Active')->first(),
        ]);
    }
}
