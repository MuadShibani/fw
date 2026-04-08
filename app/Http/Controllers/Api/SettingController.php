<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class SettingController extends Controller
{
    public function index(): JsonResponse
    {
        $settings = Setting::all()->pluck('setting_value', 'setting_key');
        return response()->json($settings);
    }

    public function show(string $key): JsonResponse
    {
        $setting = Setting::findOrFail($key);
        return response()->json($setting);
    }

    public function upsert(Request $request): JsonResponse
    {
        $data = $request->validate([
            'setting_key'   => 'required|string|max:100',
            'setting_value' => 'required',
        ]);

        $value = is_array($data['setting_value'])
            ? json_encode($data['setting_value'])
            : $data['setting_value'];

        $setting = Setting::updateOrCreate(
            ['setting_key' => $data['setting_key']],
            ['setting_value' => $value]
        );

        return response()->json($setting);
    }

    public function updateMany(Request $request): JsonResponse
    {
        $data = $request->validate([
            'settings'   => 'required|array',
            'settings.*' => 'required',
        ]);

        foreach ($data['settings'] as $key => $value) {
            Setting::setValue($key, $value);
        }

        return response()->json(['message' => 'Settings updated successfully']);
    }
}
