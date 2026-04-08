<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WiifPortfolio;
use App\Models\Page;
use Illuminate\Http\Request;

class WiifController extends Controller
{
    public function index()
    {
        return view('admin.wiif.index', [
            'portfolio' => WiifPortfolio::orderBy('investment_date', 'desc')->get(),
            'page'      => Page::find('wiif'),
        ]);
    }

    public function create()
    {
        return view('admin.wiif.form', ['item' => null]);
    }

    public function store(Request $request)
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
        WiifPortfolio::create($data);
        return redirect('/admin/wiif')->with('success', 'Portfolio company added.');
    }

    public function edit(int $id)
    {
        return view('admin.wiif.form', ['item' => WiifPortfolio::findOrFail($id)]);
    }

    public function update(Request $request, int $id)
    {
        $item = WiifPortfolio::findOrFail($id);
        $data = $request->validate([
            'name'            => 'required|string|max:255',
            'sector_en'       => 'required|string|max:255',
            'sector_ar'       => 'required|string|max:255',
            'description_en'  => 'required|string',
            'description_ar'  => 'required|string',
            'logo_url'        => 'required|string',
            'investment_date' => 'required|date',
        ]);
        $item->update($data);
        return redirect('/admin/wiif')->with('success', 'Portfolio company updated.');
    }

    public function destroy(int $id)
    {
        WiifPortfolio::findOrFail($id)->delete();
        return redirect('/admin/wiif')->with('success', 'Portfolio company deleted.');
    }
}
