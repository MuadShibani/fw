<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSlide;
use Illuminate\Http\Request;

class HeroSlideController extends Controller
{
    public function index()
    {
        return view('admin.hero.index', [
            'items' => HeroSlide::orderBy('sort_order')->orderBy('id')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.hero.form', ['item' => null]);
    }

    public function store(Request $request)
    {
        HeroSlide::create($this->validated($request));
        return redirect('/admin/hero')->with('success', 'Hero slide created.');
    }

    public function edit(int $id)
    {
        return view('admin.hero.form', ['item' => HeroSlide::findOrFail($id)]);
    }

    public function update(Request $request, int $id)
    {
        HeroSlide::findOrFail($id)->update($this->validated($request));
        return redirect('/admin/hero')->with('success', 'Hero slide updated.');
    }

    public function destroy(int $id)
    {
        HeroSlide::findOrFail($id)->delete();
        return redirect('/admin/hero')->with('success', 'Hero slide deleted.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'title_en'     => 'nullable|string|max:255',
            'title_ar'     => 'nullable|string|max:255',
            'subtitle_en'  => 'nullable|string',
            'subtitle_ar'  => 'nullable|string',
            'image_url'    => 'nullable|string',
            'cta_label_en' => 'nullable|string|max:100',
            'cta_label_ar' => 'nullable|string|max:100',
            'cta_link'     => 'nullable|string|max:500',
            'sort_order'   => 'nullable|integer',
            'is_active'    => 'nullable',
        ]);
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);
        $data['is_active']  = (bool) ($request->input('is_active', false));
        return $data;
    }
}
