<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Page;
use Illuminate\Http\Request;

class ContactWebController extends Controller
{
    public function index()
    {
        return view('pages.contact', [
            'page' => Page::find('contact'),
        ]);
    }

    public function submit(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
            'email'      => 'required|email|max:255',
            'message'    => 'required|string',
        ]);

        Message::create($data);
        return redirect('/contact')->with('success', 'Your message has been sent. We will get back to you soon.');
    }
}
