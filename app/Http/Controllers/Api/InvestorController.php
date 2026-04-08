<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Investor;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class InvestorController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Investor::orderBy('created_at', 'asc')->get());
    }

    public function show(int $id): JsonResponse
    {
        return response()->json(Investor::findOrFail($id));
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name_en'      => 'required|string|max:255',
            'name_ar'      => 'required|string|max:255',
            'role_en'      => 'required|string|max:255',
            'role_ar'      => 'required|string|max:255',
            'bio_en'       => 'required|string',
            'bio_ar'       => 'required|string',
            'image_url'    => 'required|string',
            'linkedin_url' => 'nullable|string|max:255',
            'twitter_url'  => 'nullable|string|max:255',
        ]);

        return response()->json(Investor::create($data), 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $item = Investor::findOrFail($id);

        $data = $request->validate([
            'name_en'      => 'sometimes|string|max:255',
            'name_ar'      => 'sometimes|string|max:255',
            'role_en'      => 'sometimes|string|max:255',
            'role_ar'      => 'sometimes|string|max:255',
            'bio_en'       => 'sometimes|string',
            'bio_ar'       => 'sometimes|string',
            'image_url'    => 'sometimes|string',
            'linkedin_url' => 'nullable|string|max:255',
            'twitter_url'  => 'nullable|string|max:255',
        ]);

        $item->update($data);
        return response()->json($item);
    }

    public function destroy(int $id): JsonResponse
    {
        Investor::findOrFail($id)->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
