<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ProgramController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Program::all());
    }

    public function show(string $id): JsonResponse
    {
        return response()->json(Program::findOrFail($id));
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'id'             => 'required|string|max:50|unique:programs,id',
            'title_en'       => 'required|string|max:255',
            'title_ar'       => 'required|string|max:255',
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
            'color'          => 'required|string|max:50',
            'path'           => 'required|string|max:255',
            'features'       => 'nullable|array',
        ]);

        return response()->json(Program::create($data), 201);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $item = Program::findOrFail($id);

        $data = $request->validate([
            'title_en'       => 'sometimes|string|max:255',
            'title_ar'       => 'sometimes|string|max:255',
            'description_en' => 'sometimes|string',
            'description_ar' => 'sometimes|string',
            'color'          => 'sometimes|string|max:50',
            'path'           => 'sometimes|string|max:255',
            'features'       => 'nullable|array',
        ]);

        $item->update($data);
        return response()->json($item);
    }

    public function destroy(string $id): JsonResponse
    {
        Program::findOrFail($id)->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
