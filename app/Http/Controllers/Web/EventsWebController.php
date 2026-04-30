<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Page;

class EventsWebController extends Controller
{
    public function index()
    {
        return view('pages.events', [
            'page'   => Page::find('events'),
            'events' => Event::orderBy('event_date', 'asc')->get(),
        ]);
    }
}
