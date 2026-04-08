<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    public function index()
    {
        return view('admin.messages.index', [
            'messages' => Message::orderBy('created_at', 'desc')->paginate(20),
        ]);
    }

    public function show(int $id)
    {
        $message = Message::findOrFail($id);
        $message->update(['is_read' => true]);
        return view('admin.messages.show', compact('message'));
    }

    public function destroy(int $id)
    {
        Message::findOrFail($id)->delete();
        return redirect('/admin/messages')->with('success', 'Message deleted.');
    }

    public function markRead(int $id)
    {
        Message::findOrFail($id)->update(['is_read' => true]);
        return back()->with('success', 'Marked as read.');
    }
}
