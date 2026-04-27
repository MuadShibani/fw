<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Cohort;
use App\Models\Investor;
use App\Models\Startup;
use App\Models\WiifPortfolio;
use App\Models\Setting;
use App\Models\News;

class PageViewController extends Controller
{
    /**
     * Helper: fetch news related to a component's category.
     * Matches news.category against the component label or related keywords.
     */
    private function relatedNews(array $categories, int $limit = 3)
    {
        return News::where(function ($q) use ($categories) {
                foreach ($categories as $cat) {
                    $q->orWhere('category', 'LIKE', "%{$cat}%");
                }
            })
            ->orderBy('date', 'desc')
            ->limit($limit)
            ->get();
    }

    public function about()
    {
        return view('pages.about', ['page' => Page::findOrFail('about')]);
    }

    public function accelerator()
    {
        return view('pages.accelerator', [
            'page'         => Page::findOrFail('accelerator'),
            'cohorts'      => Cohort::orderBy('start_date', 'desc')->get(),
            'relatedNews'  => $this->relatedNews(['Accelerator', 'Cohort']),
        ]);
    }

    public function yain()
    {
        return view('pages.yain', [
            'page'         => Page::findOrFail('yain'),
            'investors'    => Investor::all(),
            'startups'     => Startup::all(),
            'relatedNews'  => $this->relatedNews(['YAIN', 'Investment', 'Investor']),
        ]);
    }

    public function wiif()
    {
        return view('pages.wiif', [
            'page'         => Page::findOrFail('wiif'),
            'portfolio'    => WiifPortfolio::orderBy('investment_date', 'desc')->get(),
            'relatedNews'  => $this->relatedNews(['WIIF', 'Fund', 'Investment']),
        ]);
    }

    public function sil()
    {
        $page = Page::findOrFail('sil');
        $silLink = $page->custom_fields['external_link'] ?? null;
        if ($silLink) {
            return redirect()->away($silLink);
        }
        return view('pages.sil', [
            'page'         => $page,
            'relatedNews'  => $this->relatedNews(['SIL', 'Social Innovation', 'Innovation']),
        ]);
    }
}
