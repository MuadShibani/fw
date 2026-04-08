<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginForm()
    {
        if (session('admin_authenticated')) {
            return redirect('/admin/dashboard');
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('username', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['username' => 'Invalid credentials.'])->withInput();
        }

        session([
            'admin_authenticated' => true,
            'admin_user'          => $user->username,
            'admin_user_id'       => $user->id,
        ]);

        return redirect('/admin/dashboard');
    }

    public function logout(Request $request)
    {
        $request->session()->forget(['admin_authenticated', 'admin_user', 'admin_user_id']);
        return redirect('/admin/login');
    }
}
