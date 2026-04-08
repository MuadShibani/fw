<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Investor;
use App\Models\Startup;
use Illuminate\Http\Request;

class YainController extends Controller
{
    public function index()
    {
        return view('admin.yain.index', [
            'investors' => Investor::all(),
            'startups'  => Startup::all(),
        ]);
    }

    // --- Investors ---
    public function createInvestor()
    {
        return view('admin.yain.investor-form', ['item' => null]);
    }

    public function storeInvestor(Request $request)
    {
        $data = $request->validate([
            'name_en'      => 'required|string|max:255',
            'name_ar'      => 'required|string|max:255',
            'role_en'      => 'required|string|max:255',
            'role_ar'      => 'required|string|max:255',
            'bio_en'       => 'required|string',
            'bio_ar'       => 'required|string',
            'image_url'    => 'required|string',
            'linkedin_url' => 'nullable|string',
            'twitter_url'  => 'nullable|string',
        ]);
        Investor::create($data);
        return redirect('/admin/yain')->with('success', 'Investor added.');
    }

    public function editInvestor(int $id)
    {
        return view('admin.yain.investor-form', ['item' => Investor::findOrFail($id)]);
    }

    public function updateInvestor(Request $request, int $id)
    {
        $item = Investor::findOrFail($id);
        $data = $request->validate([
            'name_en'      => 'required|string|max:255',
            'name_ar'      => 'required|string|max:255',
            'role_en'      => 'required|string|max:255',
            'role_ar'      => 'required|string|max:255',
            'bio_en'       => 'required|string',
            'bio_ar'       => 'required|string',
            'image_url'    => 'required|string',
            'linkedin_url' => 'nullable|string',
            'twitter_url'  => 'nullable|string',
        ]);
        $item->update($data);
        return redirect('/admin/yain')->with('success', 'Investor updated.');
    }

    public function destroyInvestor(int $id)
    {
        Investor::findOrFail($id)->delete();
        return redirect('/admin/yain')->with('success', 'Investor deleted.');
    }

    // --- Startups ---
    public function createStartup()
    {
        return view('admin.yain.startup-form', ['item' => null]);
    }

    public function storeStartup(Request $request)
    {
        $data = $request->validate([
            'name'           => 'required|string|max:255',
            'sector'         => 'required|string|max:100',
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
            'logo_url'       => 'required|string',
            'stage'          => 'required|in:Pre-Seed,Seed,Series A,Bootstrapped',
            'founder_name'   => 'nullable|string|max:255',
        ]);
        Startup::create($data);
        return redirect('/admin/yain')->with('success', 'Startup added.');
    }

    public function editStartup(int $id)
    {
        return view('admin.yain.startup-form', ['item' => Startup::findOrFail($id)]);
    }

    public function updateStartup(Request $request, int $id)
    {
        $item = Startup::findOrFail($id);
        $data = $request->validate([
            'name'           => 'required|string|max:255',
            'sector'         => 'required|string|max:100',
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
            'logo_url'       => 'required|string',
            'stage'          => 'required|in:Pre-Seed,Seed,Series A,Bootstrapped',
            'founder_name'   => 'nullable|string|max:255',
        ]);
        $item->update($data);
        return redirect('/admin/yain')->with('success', 'Startup updated.');
    }

    public function destroyStartup(int $id)
    {
        Startup::findOrFail($id)->delete();
        return redirect('/admin/yain')->with('success', 'Startup deleted.');
    }
}
