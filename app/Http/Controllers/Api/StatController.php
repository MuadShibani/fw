<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Stat;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class StatController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Stat::orderBy('id', 'asc')->get());
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'value'    => 'required|string|max:50',
            'label_en' => 'required|string|max:255',
            'label_ar' => 'required|string|max:255',
            'icon'     => 'required|string|max:50',
        ]);

        return response()->json(Stat::create($data), 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $item = Stat::findOrFail($id);

        $data = $request->validate([
            'value'    => 'sometimes|string|max:50',
            'label_en' => 'sometimes|string|max:255',
            'label_ar' => 'sometimes|string|max:255',
            'icon'     => 'sometimes|string|max:50',
        ]);

        $item->update($data);
        return response()->json($item);
    }

    public function destroy(int $id): JsonResponse
    {
        Stat::findOrFail($id)->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
