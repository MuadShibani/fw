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

    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
            'email'      => 'required|email|max:255',
            'message'    => 'required|string',
            '_subject'   => 'nullable|string|max:120',
        ]);

        // Optional subject prefix (e.g. "WIIF Meeting Request") gets folded
        // into the message body so admins can see the context at a glance
        // in the existing /admin/messages screen.
        if (!empty($data['_subject'])) {
            $data['message'] = '[' . $data['_subject'] . "]\n\n" . $data['message'];
        }
        unset($data['_subject']);

        Message::create($data);
        return back()->with('success', 'Your message has been sent. We will get back to you soon.');
    }

    // Keep the old name working in case anything still references it.
    public function submit(Request $request)
    {
        return $this->store($request);
    }
}
