@extends('layouts.admin')
@section('title','Messages')
@section('page-title','Contact Messages')
@section('content')
<div class="admin-panel">
    <table class="data-table">
        <thead><tr><th></th><th>Name</th><th>Email</th><th>Preview</th><th>Date</th><th>Actions</th></tr></thead>
        <tbody>
        @forelse($messages as $msg)
        <tr class="{{ !$msg->is_read ? 'row-unread' : '' }}">
            <td>{{ !$msg->is_read ? '🔵' : '' }}</td>
            <td>{{ $msg->first_name }} {{ $msg->last_name }}</td>
            <td>{{ $msg->email }}</td>
            <td>{{ Str::limit($msg->message, 60) }}</td>
            <td>{{ $msg->created_at->format('d M Y') }}</td>
            <td class="actions-cell">
                <a href="/admin/messages/{{ $msg->id }}" class="btn btn-xs">View</a>
                <form action="/admin/messages/{{ $msg->id }}" method="POST" class="inline" onsubmit="return confirm('Delete?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-xs btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="6" class="empty-state">No messages yet.</td></tr>
        @endforelse
        </tbody>
    </table>
    <div class="mt-4">{{ $messages->links() }}</div>
</div>
@endsection
