<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    private function allPages(): \Illuminate\Support\Collection
    {
        $order = ['home', 'about', 'accelerator', 'yain', 'wiif', 'sil', 'blog', 'events', 'library', 'media', 'contact'];
        $pages = Page::all()->keyBy('page_key');
        return collect($order)->map(fn($k) => $pages->get($k))->filter()->values();
    }

    public function index()
    {
        $pages = $this->allPages();
        if ($pages->isNotEmpty()) {
            return redirect('/admin/pages/' . $pages->first()->page_key . '/edit');
        }
        return view('admin.pages.index', compact('pages'));
    }

    public function edit(string $key)
    {
        return view('admin.pages.form', [
            'page'  => Page::findOrFail($key),
            'pages' => $this->allPages(),
        ]);
    }

    public function update(Request $request, string $key)
    {
        $page = Page::findOrFail($key);

        $request->validate([
            'title_en'    => 'required|string|max:255',
            'title_ar'    => 'required|string|max:255',
            'subtitle_en' => 'nullable|string',
            'subtitle_ar' => 'nullable|string',
            'content_en'  => 'nullable|string',
            'content_ar'  => 'nullable|string',
            'image_url'   => 'nullable|string',
        ]);

        // Build updated custom_fields by merging form input
        // over the existing JSON structure — preserves keys we don't edit
        $existing = $page->custom_fields ?? [];
        $cf = $existing;

        // Each page type has specific custom_fields it manages
        switch ($key) {

            case 'home':
                $cf['cta_primary']   = ['en' => $request->input('cf_cta_primary_en',   ''), 'ar' => $request->input('cf_cta_primary_ar',   '')];
                $cf['cta_secondary'] = ['en' => $request->input('cf_cta_secondary_en', ''), 'ar' => $request->input('cf_cta_secondary_ar', '')];
                break;

            case 'about':
                foreach (['mission', 'vision', 'values'] as $block) {
                    $cf["{$block}_title"] = ['en' => $request->input("cf_{$block}_title_en", ''), 'ar' => $request->input("cf_{$block}_title_ar", '')];
                    $cf["{$block}_body"]  = ['en' => $request->input("cf_{$block}_body_en",  ''), 'ar' => $request->input("cf_{$block}_body_ar",  '')];
                }
                break;

            case 'accelerator':
                $cf['apply_link']      = $request->input('cf_apply_link', '');
                $cf['timelineTitle']   = ['en' => $request->input('cf_timelineTitle_en', ''), 'ar' => $request->input('cf_timelineTitle_ar', '')];
                // timelineSteps and features kept from existing (not editable inline — managed via JSON)
                break;

            case 'yain':
                $cf['championsTitle']    = ['en' => $request->input('cf_championsTitle_en',    ''), 'ar' => $request->input('cf_championsTitle_ar',    '')];
                $cf['championsSubtitle'] = ['en' => $request->input('cf_championsSubtitle_en', ''), 'ar' => $request->input('cf_championsSubtitle_ar', '')];
                $cf['portfolioTitle']    = ['en' => $request->input('cf_portfolioTitle_en',    ''), 'ar' => $request->input('cf_portfolioTitle_ar',    '')];
                $cf['portfolioSubtitle'] = ['en' => $request->input('cf_portfolioSubtitle_en', ''), 'ar' => $request->input('cf_portfolioSubtitle_ar', '')];
                $cf['ctaTitle']          = ['en' => $request->input('cf_ctaTitle_en',          ''), 'ar' => $request->input('cf_ctaTitle_ar',          '')];
                $cf['ctaSubtitle']       = ['en' => $request->input('cf_ctaSubtitle_en',       ''), 'ar' => $request->input('cf_ctaSubtitle_ar',       '')];
                $cf['investor_join_link'] = $request->input('cf_investor_join_link', '');
                $cf['startup_pitch_link'] = $request->input('cf_startup_pitch_link', '');
                break;

            case 'wiif':
                $cf['sdgTitle'] = ['en' => $request->input('cf_sdgTitle_en', ''), 'ar' => $request->input('cf_sdgTitle_ar', '')];
                $cf['sdgDesc']  = ['en' => $request->input('cf_sdgDesc_en',  ''), 'ar' => $request->input('cf_sdgDesc_ar',  '')];
                // listItems kept from existing
                break;

            case 'sil':
                $cf['external_link']   = $request->input('cf_external_link', '');
                foreach (['grants', 'community', 'impact'] as $block) {
                    $cf["{$block}_title"] = ['en' => $request->input("cf_{$block}_title_en", ''), 'ar' => $request->input("cf_{$block}_title_ar", '')];
                    $cf["{$block}_body"]  = ['en' => $request->input("cf_{$block}_body_en",  ''), 'ar' => $request->input("cf_{$block}_body_ar",  '')];
                }
                break;
        }

        $page->update([
            'title_en'      => $request->title_en,
            'title_ar'      => $request->title_ar,
            'subtitle_en'   => $request->subtitle_en,
            'subtitle_ar'   => $request->subtitle_ar,
            'content_en'    => $request->content_en,
            'content_ar'    => $request->content_ar,
            'image_url'     => $request->image_url,
            'custom_fields' => $cf,
        ]);

        return redirect('/admin/pages/' . $key . '/edit')
            ->with('success', ucfirst($key) . ' page saved successfully.');
    }
}
