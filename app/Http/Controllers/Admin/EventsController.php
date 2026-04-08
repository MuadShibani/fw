<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    public function index()
    {
        return view('admin.events.index', [
            'items' => Event::orderBy('event_date', 'asc')->paginate(15),
        ]);
    }

    public function create()
    {
        return view('admin.events.form', ['item' => null]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title_en'          => 'required|string|max:255',
            'title_ar'          => 'required|string|max:255',
            'description_en'    => 'nullable|string',
            'description_ar'    => 'nullable|string',
            'event_date'        => 'required|date',
            'event_time'        => 'required|string|max:100',
            'location_en'       => 'nullable|string|max:255',
            'location_ar'       => 'nullable|string|max:255',
            'type'              => 'required|in:Workshop,Webinar,Networking,Pitch Day',
            'is_virtual'        => 'boolean',
            'capacity'          => 'nullable|integer|min:0',
            'registered_count'  => 'nullable|integer|min:0',
            'registration_link' => 'nullable|string',
        ]);
        $data['is_virtual'] = $request->boolean('is_virtual');
        Event::create($data);
        return redirect('/admin/events')->with('success', 'Event created.');
    }

    public function edit(int $id)
    {
        return view('admin.events.form', ['item' => Event::findOrFail($id)]);
    }

    public function update(Request $request, int $id)
    {
        $item = Event::findOrFail($id);
        $data = $request->validate([
            'title_en'          => 'required|string|max:255',
            'title_ar'          => 'required|string|max:255',
            'description_en'    => 'nullable|string',
            'description_ar'    => 'nullable|string',
            'event_date'        => 'required|date',
            'event_time'        => 'required|string|max:100',
            'location_en'       => 'nullable|string|max:255',
            'location_ar'       => 'nullable|string|max:255',
            'type'              => 'required|in:Workshop,Webinar,Networking,Pitch Day',
            'is_virtual'        => 'boolean',
            'capacity'          => 'nullable|integer|min:0',
            'registered_count'  => 'nullable|integer|min:0',
            'registration_link' => 'nullable|string',
        ]);
        $data['is_virtual'] = $request->boolean('is_virtual');
        $item->update($data);
        return redirect('/admin/events')->with('success', 'Event updated.');
    }

    public function destroy(int $id)
    {
        Event::findOrFail($id)->delete();
        return redirect('/admin/events')->with('success', 'Event deleted.');
    }
}
