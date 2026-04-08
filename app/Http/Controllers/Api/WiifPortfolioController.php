<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\WiifPortfolio;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class WiifPortfolioController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(WiifPortfolio::orderBy('investment_date', 'desc')->get());
    }

    public function show(int $id): JsonResponse
    {
        return response()->json(WiifPortfolio::findOrFail($id));
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name'            => 'required|string|max:255',
            'sector_en'       => 'required|string|max:255',
            'sector_ar'       => 'required|string|max:255',
            'description_en'  => 'required|string',
            'description_ar'  => 'required|string',
            'logo_url'        => 'required|string',
            'investment_date' => 'required|date',
        ]);

        return response()->json(WiifPortfolio::create($data), 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $item = WiifPortfolio::findOrFail($id);

        $data = $request->validate([
            'name'            => 'sometimes|string|max:255',
            'sector_en'       => 'sometimes|string|max:255',
            'sector_ar'       => 'sometimes|string|max:255',
            'description_en'  => 'sometimes|string',
            'description_ar'  => 'sometimes|string',
            'logo_url'        => 'sometimes|string',
            'investment_date' => 'sometimes|date',
        ]);

        $item->update($data);
        return response()->json($item);
    }

    public function destroy(int $id): JsonResponse
    {
        WiifPortfolio::findOrFail($id)->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
