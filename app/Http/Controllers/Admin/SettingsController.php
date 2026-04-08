<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function index()
    {
        return view('admin.settings.index', [
            'appLinks' => Setting::getValue('app_links', true) ?? [],
            'siteName' => Setting::getValue('site_name_en') ?? 'Wathba Platform',
            'contactEmail' => Setting::getValue('contact_email') ?? '',
        ]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'site_name_en'                   => 'required|string|max:255',
            'contact_email'                  => 'required|email',
            'app_links.acceleratorApplication' => 'nullable|string',
            'app_links.yainStartupPitch'       => 'nullable|string',
            'app_links.yainInvestorJoin'       => 'nullable|string',
            'app_links.silExternalLink'        => 'nullable|string',
        ]);

        Setting::setValue('site_name_en', $data['site_name_en']);
        Setting::setValue('contact_email', $data['contact_email']);
        Setting::setValue('app_links', $data['app_links'] ?? []);

        return redirect('/admin/settings')->with('success', 'Settings saved.');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'new_password'     => 'required|string|min:6|confirmed',
        ]);

        $user = User::find(session('admin_user_id'));

        if (!$user || !Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $user->update(['password' => Hash::make($request->new_password)]);
        return redirect('/admin/settings')->with('success', 'Password changed successfully.');
    }
}
