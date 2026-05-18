<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProgramFeature;
use Illuminate\Http\Request;

class ProgramFeatureController extends Controller
{
    public function index()
    {
        return view('admin.program-features.index', [
            'items' => ProgramFeature::orderBy('sort_order')->orderBy('id')->get(),
        ]);
    }

    public function create() { return view('admin.program-features.form', ['item' => null]); }
    public function edit(int $id) { return view('admin.program-features.form', ['item' => ProgramFeature::findOrFail($id)]); }

    public function store(Request $request)
    {
        ProgramFeature::create($this->validated($request));
        return redirect('/admin/program-features')->with('success', 'Feature added.');
    }

    public function update(Request $request, int $id)
    {
        ProgramFeature::findOrFail($id)->update($this->validated($request));
        return redirect('/admin/program-features')->with('success', 'Feature updated.');
    }

    public function destroy(int $id)
    {
        ProgramFeature::findOrFail($id)->delete();
        return redirect('/admin/program-features')->with('success', 'Feature removed.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'name_en'        => 'required|string|max:255',
            'name_ar'        => 'required|string|max:255',
            'description_en' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'sort_order'     => 'nullable|integer',
        ]);
    }
}
