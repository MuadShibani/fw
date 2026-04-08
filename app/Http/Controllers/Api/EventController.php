<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class EventController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Event::orderBy('event_date', 'asc')->get());
    }

    public function show(int $id): JsonResponse
    {
        return response()->json(Event::findOrFail($id));
    }

    public function store(Request $request): JsonResponse
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
            'capacity'          => 'nullable|integer',
            'registered_count'  => 'nullable|integer',
            'registration_link' => 'nullable|string',
        ]);

        return response()->json(Event::create($data), 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $item = Event::findOrFail($id);

        $data = $request->validate([
            'title_en'          => 'sometimes|string|max:255',
            'title_ar'          => 'sometimes|string|max:255',
            'description_en'    => 'nullable|string',
            'description_ar'    => 'nullable|string',
            'event_date'        => 'sometimes|date',
            'event_time'        => 'sometimes|string|max:100',
            'location_en'       => 'nullable|string|max:255',
            'location_ar'       => 'nullable|string|max:255',
            'type'              => 'sometimes|in:Workshop,Webinar,Networking,Pitch Day',
            'is_virtual'        => 'boolean',
            'capacity'          => 'nullable|integer',
            'registered_count'  => 'nullable|integer',
            'registration_link' => 'nullable|string',
        ]);

        $item->update($data);
        return response()->json($item);
    }

    public function destroy(int $id): JsonResponse
    {
        Event::findOrFail($id)->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
