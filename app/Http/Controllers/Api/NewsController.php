<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class NewsController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(News::orderBy('date', 'desc')->get());
    }

    public function show(int $id): JsonResponse
    {
        $item = News::findOrFail($id);
        return response()->json($item);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'date'       => 'required|date',
            'title_en'   => 'required|string|max:255',
            'title_ar'   => 'required|string|max:255',
            'summary_en' => 'required|string',
            'summary_ar' => 'required|string',
            'category'   => 'required|string|max:100',
            'image_en'   => 'nullable|string',
            'image_ar'   => 'nullable|string',
        ]);

        $item = News::create($data);
        return response()->json($item, 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $item = News::findOrFail($id);

        $data = $request->validate([
            'date'       => 'sometimes|date',
            'title_en'   => 'sometimes|string|max:255',
            'title_ar'   => 'sometimes|string|max:255',
            'summary_en' => 'sometimes|string',
            'summary_ar' => 'sometimes|string',
            'category'   => 'sometimes|string|max:100',
            'image_en'   => 'nullable|string',
            'image_ar'   => 'nullable|string',
        ]);

        $item->update($data);
        return response()->json($item);
    }

    public function destroy(int $id): JsonResponse
    {
        News::findOrFail($id)->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
