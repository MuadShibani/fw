<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PageController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Page::all());
    }

    public function show(string $pageKey): JsonResponse
    {
        return response()->json(Page::findOrFail($pageKey));
    }

    public function update(Request $request, string $pageKey): JsonResponse
    {
        $page = Page::findOrFail($pageKey);

        $data = $request->validate([
            'title_en'      => 'sometimes|string|max:255',
            'title_ar'      => 'sometimes|string|max:255',
            'subtitle_en'   => 'nullable|string',
            'subtitle_ar'   => 'nullable|string',
            'content_en'    => 'nullable|string',
            'content_ar'    => 'nullable|string',
            'image_url'     => 'nullable|string',
            'custom_fields' => 'nullable|array',
        ]);

        $page->update($data);
        return response()->json($page);
    }
}
