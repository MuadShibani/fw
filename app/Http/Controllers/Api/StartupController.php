<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Startup;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class StartupController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Startup::orderBy('created_at', 'asc')->get());
    }

    public function show(int $id): JsonResponse
    {
        return response()->json(Startup::findOrFail($id));
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name'           => 'required|string|max:255',
            'sector'         => 'required|string|max:100',
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
            'logo_url'       => 'required|string',
            'stage'          => 'required|in:Pre-Seed,Seed,Series A,Bootstrapped',
            'founder_name'   => 'nullable|string|max:255',
        ]);

        return response()->json(Startup::create($data), 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $item = Startup::findOrFail($id);

        $data = $request->validate([
            'name'           => 'sometimes|string|max:255',
            'sector'         => 'sometimes|string|max:100',
            'description_en' => 'sometimes|string',
            'description_ar' => 'sometimes|string',
            'logo_url'       => 'sometimes|string',
            'stage'          => 'sometimes|in:Pre-Seed,Seed,Series A,Bootstrapped',
            'founder_name'   => 'nullable|string|max:255',
        ]);

        $item->update($data);
        return response()->json($item);
    }

    public function destroy(int $id): JsonResponse
    {
        Startup::findOrFail($id)->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
