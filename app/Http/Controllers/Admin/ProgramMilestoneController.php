<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProgramMilestone;
use Illuminate\Http\Request;

class ProgramMilestoneController extends Controller
{
    public function index()
    {
        return view('admin.program-milestones.index', [
            'items' => ProgramMilestone::orderBy('sort_order')->orderBy('id')->get(),
        ]);
    }

    public function create() { return view('admin.program-milestones.form', ['item' => null]); }
    public function edit(int $id) { return view('admin.program-milestones.form', ['item' => ProgramMilestone::findOrFail($id)]); }

    public function store(Request $request)
    {
        ProgramMilestone::create($this->validated($request));
        return redirect('/admin/program-milestones')->with('success', 'Milestone added.');
    }

    public function update(Request $request, int $id)
    {
        ProgramMilestone::findOrFail($id)->update($this->validated($request));
        return redirect('/admin/program-milestones')->with('success', 'Milestone updated.');
    }

    public function destroy(int $id)
    {
        ProgramMilestone::findOrFail($id)->delete();
        return redirect('/admin/program-milestones')->with('success', 'Milestone removed.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'title_en'      => 'required|string|max:255',
            'title_ar'      => 'required|string|max:255',
            'activities_en' => 'nullable|string',
            'activities_ar' => 'nullable|string',
            'output_en'     => 'nullable|string',
            'output_ar'     => 'nullable|string',
            'timeline_en'   => 'nullable|string|max:120',
            'timeline_ar'   => 'nullable|string|max:120',
            'icon'          => 'nullable|string|max:50',
            'color'         => ['nullable', 'string', 'regex:/^#([0-9a-fA-F]{3}|[0-9a-fA-F]{6})$/'],
            'sort_order'    => 'nullable|integer',
        ]);
    }
}
