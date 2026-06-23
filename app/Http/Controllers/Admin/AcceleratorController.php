<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cohort;
use App\Models\Page;
use Illuminate\Http\Request;

class AcceleratorController extends Controller
{
    public function index()
    {
        return view('admin.accelerator.index', [
            'cohorts' => Cohort::orderBy('start_date')->get(),
            'page' => Page::find('accelerator'),
        ]);
    }

    public function createCohort()
    {
        return view('admin.accelerator.cohort-form', ['item' => null]);
    }

    public function storeCohort(Request $request)
    {
        $data = $this->validatedCohortData($request);
        Cohort::create($data);

        return redirect('/admin/accelerator')->with('success', 'Cohort created.');
    }

    public function editCohort(int $id)
    {
        return view('admin.accelerator.cohort-form', ['item' => Cohort::findOrFail($id)]);
    }

    public function updateCohort(Request $request, int $id)
    {
        $item = Cohort::findOrFail($id);
        $data = $this->validatedCohortData($request);
        $item->update($data);

        return redirect('/admin/accelerator')->with('success', 'Cohort updated.');
    }

    public function destroyCohort(int $id)
    {
        Cohort::findOrFail($id)->delete();

        return redirect('/admin/accelerator')->with('success', 'Cohort deleted.');
    }

    public function updatePage(Request $request)
    {
        $page = Page::findOrFail('accelerator');
        $page->update($request->only([
            'title_en', 'title_ar', 'subtitle_en', 'subtitle_ar', 'content_en', 'content_ar',
        ]));

        return redirect('/admin/accelerator')->with('success', 'Accelerator page updated.');
    }

    /**
     * @return array{name_en:string,name_ar:string,status:string,start_date:string,end_date:string,startups_count:int,startups_list:array<int,array{name:string,logo_url:string}>}
     */
    private function validatedCohortData(Request $request): array
    {
        $data = $request->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'status' => 'required|in:Active,Completed,Upcoming',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'startups_count' => 'nullable|integer|min:0|max:10',
            'startups_list' => 'nullable|array|max:10',
            'startups_list.*.name' => 'nullable|string|max:255',
            'startups_list.*.logo_url' => 'nullable|string|max:2048',
        ]);

        $startups = collect($data['startups_list'] ?? [])
            ->map(fn (array $startup): array => [
                'name' => trim((string) ($startup['name'] ?? '')),
                'logo_url' => trim((string) ($startup['logo_url'] ?? '')),
            ])
            ->filter(fn (array $startup): bool => $startup['name'] !== '' || $startup['logo_url'] !== '')
            ->take(10)
            ->values()
            ->all();

        $data['startups_list'] = $startups;
        $data['startups_count'] = count($startups) ?: (int) ($data['startups_count'] ?? 0);

        return $data;
    }
}
