<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Cohort;
use App\Models\Investor;
use App\Models\Startup;
use App\Models\WiifPortfolio;
use App\Models\Setting;

class PageViewController extends Controller
{
    public function about()
    {
        return view('pages.about', [
            'page' => Page::findOrFail('about'),
        ]);
    }

    public function accelerator()
    {
        return view('pages.accelerator', [
            'page'     => Page::findOrFail('accelerator'),
            'cohorts'  => Cohort::orderBy('start_date')->get(),
            'appLinks' => Setting::getValue('app_links', true) ?? [],
        ]);
    }

    public function yain()
    {
        return view('pages.yain', [
            'page'      => Page::findOrFail('yain'),
            'investors' => Investor::all(),
            'startups'  => Startup::all(),
            'appLinks'  => Setting::getValue('app_links', true) ?? [],
        ]);
    }

    public function wiif()
    {
        return view('pages.wiif', [
            'page'      => Page::findOrFail('wiif'),
            'portfolio' => WiifPortfolio::orderBy('investment_date', 'desc')->get(),
        ]);
    }

        public function sil()
    {
        $page = Page::findOrFail('sil');
        $silLink = $page->custom_fields['external_link'] ?? null;
        if ($silLink) {
            return redirect()->away($silLink);
        }
        return view('pages.sil', compact('page'));
    }
}
