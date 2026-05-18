<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WiifMember;
use Illuminate\Http\Request;

class WiifMemberController extends Controller
{
    public function index()
    {
        return view('admin.wiif-members.index', [
            'gps'       => WiifMember::gps()->get(),
            'committee' => WiifMember::committee()->get(),
        ]);
    }

    public function create(Request $request)
    {
        return view('admin.wiif-members.form', [
            'item' => null,
            'defaultType' => $request->query('type', 'gp'),
        ]);
    }

    public function store(Request $request)
    {
        WiifMember::create($this->validated($request));
        return redirect('/admin/wiif-members')->with('success', 'Member added.');
    }

    public function edit(int $id)
    {
        return view('admin.wiif-members.form', [
            'item' => WiifMember::findOrFail($id),
            'defaultType' => null,
        ]);
    }

    public function update(Request $request, int $id)
    {
        WiifMember::findOrFail($id)->update($this->validated($request));
        return redirect('/admin/wiif-members')->with('success', 'Member updated.');
    }

    public function destroy(int $id)
    {
        WiifMember::findOrFail($id)->delete();
        return redirect('/admin/wiif-members')->with('success', 'Member removed.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'type'       => 'required|in:gp,committee',
            'name_en'    => 'required|string|max:255',
            'name_ar'    => 'required|string|max:255',
            'role_en'    => 'nullable|string|max:255',
            'role_ar'    => 'nullable|string|max:255',
            'bio_en'     => 'nullable|string',
            'bio_ar'     => 'nullable|string',
            'image_url'  => 'nullable|string',
            'sort_order' => 'nullable|integer',
        ]);
    }
}
