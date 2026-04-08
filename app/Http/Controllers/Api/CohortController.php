<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cohort;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CohortController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Cohort::orderBy('start_date', 'asc')->get());
    }

    public function show(int $id): JsonResponse
    {
        return response()->json(Cohort::findOrFail($id));
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name_en'        => 'required|string|max:255',
            'name_ar'        => 'required|string|max:255',
            'status'         => 'required|in:Active,Completed,Upcoming',
            'start_date'     => 'required|date',
            'end_date'       => 'required|date|after:start_date',
            'startups_count' => 'nullable|integer|min:0',
        ]);

        return response()->json(Cohort::create($data), 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $item = Cohort::findOrFail($id);

        $data = $request->validate([
            'name_en'        => 'sometimes|string|max:255',
            'name_ar'        => 'sometimes|string|max:255',
            'status'         => 'sometimes|in:Active,Completed,Upcoming',
            'start_date'     => 'sometimes|date',
            'end_date'       => 'sometimes|date',
            'startups_count' => 'nullable|integer|min:0',
        ]);

        $item->update($data);
        return response()->json($item);
    }

    public function destroy(int $id): JsonResponse
    {
        Cohort::findOrFail($id)->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
