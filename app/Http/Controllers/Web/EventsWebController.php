<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Event;

class EventsWebController extends Controller
{
    public function index()
    {
        return view('pages.events', [
            'events' => Event::orderBy('event_date', 'asc')->get(),
        ]);
    }
}
