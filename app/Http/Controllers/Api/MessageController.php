<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class MessageController extends Controller
{
    // Public: submit a contact form message
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
            'email'      => 'required|email|max:255',
            'message'    => 'required|string',
        ]);

        $message = Message::create($data);
        return response()->json(['message' => 'Message sent successfully', 'data' => $message], 201);
    }

    // Admin: list all messages
    public function index(): JsonResponse
    {
        return response()->json(Message::orderBy('created_at', 'desc')->get());
    }

    // Admin: mark as read
    public function markRead(int $id): JsonResponse
    {
        $message = Message::findOrFail($id);
        $message->update(['is_read' => true]);
        return response()->json($message);
    }

    // Admin: delete
    public function destroy(int $id): JsonResponse
    {
        Message::findOrFail($id)->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
