<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class BlogController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Blog::orderBy('date', 'desc')->get());
    }

    public function show(int $id): JsonResponse
    {
        return response()->json(Blog::findOrFail($id));
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'date'       => 'required|date',
            'title_en'   => 'required|string|max:255',
            'title_ar'   => 'required|string|max:255',
            'summary_en' => 'required|string',
            'summary_ar' => 'required|string',
            'content_en' => 'required|string',
            'content_ar' => 'required|string',
            'author_en'  => 'required|string|max:100',
            'author_ar'  => 'required|string|max:100',
            'image_en'   => 'nullable|string',
            'image_ar'   => 'nullable|string',
        ]);

        return response()->json(Blog::create($data), 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $item = Blog::findOrFail($id);

        $data = $request->validate([
            'date'       => 'sometimes|date',
            'title_en'   => 'sometimes|string|max:255',
            'title_ar'   => 'sometimes|string|max:255',
            'summary_en' => 'sometimes|string',
            'summary_ar' => 'sometimes|string',
            'content_en' => 'sometimes|string',
            'content_ar' => 'sometimes|string',
            'author_en'  => 'sometimes|string|max:100',
            'author_ar'  => 'sometimes|string|max:100',
            'image_en'   => 'nullable|string',
            'image_ar'   => 'nullable|string',
        ]);

        $item->update($data);
        return response()->json($item);
    }

    public function destroy(int $id): JsonResponse
    {
        Blog::findOrFail($id)->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
