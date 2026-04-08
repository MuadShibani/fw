<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Library;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class LibraryController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Library::orderBy('file_date', 'desc')->get());
    }

    public function show(int $id): JsonResponse
    {
        return response()->json(Library::findOrFail($id));
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'title_en'       => 'required|string|max:255',
            'title_ar'       => 'required|string|max:255',
            'description_en' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'type'           => 'required|in:document,image,video',
            'url'            => 'required|string',
            'file_date'      => 'required|date',
            'size'           => 'nullable|string|max:50',
        ]);

        return response()->json(Library::create($data), 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $item = Library::findOrFail($id);

        $data = $request->validate([
            'title_en'       => 'sometimes|string|max:255',
            'title_ar'       => 'sometimes|string|max:255',
            'description_en' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'type'           => 'sometimes|in:document,image,video',
            'url'            => 'sometimes|string',
            'file_date'      => 'sometimes|date',
            'size'           => 'nullable|string|max:50',
        ]);

        $item->update($data);
        return response()->json($item);
    }

    public function destroy(int $id): JsonResponse
    {
        Library::findOrFail($id)->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
