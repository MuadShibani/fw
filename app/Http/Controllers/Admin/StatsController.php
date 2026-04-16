<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Stat;
use Illuminate\Http\Request;

class StatsController extends Controller
{
    public function index()
    {
        return view('admin.stats.index', ['stats' => Stat::orderBy('sort_order')->get()]);
    }

    public function create()
    {
        return view('admin.stats.form', ['stat' => null]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'value'    => 'required|string|max:50',
            'label_en' => 'required|string|max:255',
            'label_ar' => 'required|string|max:255',
            'icon'     => 'nullable|string|max:50',
        ]);
        $data['sort_order'] = Stat::max('sort_order') + 1;
        Stat::create($data);
        return redirect('/admin/stats')->with('success', 'Stat created.');
    }

    public function edit(int $id)
    {
        return view('admin.stats.form', ['stat' => Stat::findOrFail($id)]);
    }

    public function update(Request $request, int $id)
    {
        $stat = Stat::findOrFail($id);
        $data = $request->validate([
            'value'    => 'required|string|max:50',
            'label_en' => 'required|string|max:255',
            'label_ar' => 'required|string|max:255',
            'icon'     => 'nullable|string|max:50',
        ]);
        $stat->update($data);
        return redirect('/admin/stats')->with('success', 'Stat updated.');
    }

    public function destroy(int $id)
    {
        Stat::findOrFail($id)->delete();
        return redirect('/admin/stats')->with('success', 'Stat deleted.');
    }
}
