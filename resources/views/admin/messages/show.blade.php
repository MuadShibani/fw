@extends('layouts.admin')
@section('title','Message')
@section('page-title','View Message')
@section('content')
<div class="admin-panel message-detail">
    <div class="message-detail-header">
        <div>
            <h2>{{ $message->first_name }} {{ $message->last_name }}</h2>
            <a href="mailto:{{ $message->email }}" class="message-email-link">{{ $message->email }}</a>
        </div>
        <span class="text-gray-400 text-sm">{{ $message->created_at->format('d M Y, H:i') }}</span>
    </div>
    <div class="message-body">{{ $message->message }}</div>
    <div class="form-actions">
        <a href="/admin/messages" class="btn btn-outline">← Back</a>
        <a href="mailto:{{ $message->email }}" class="btn btn-primary">Reply by Email</a>
        <form action="/admin/messages/{{ $message->id }}" method="POST" class="inline" onsubmit="return confirm('Delete?')">
            @csrf @method('DELETE')
            <button class="btn btn-danger">Delete</button>
        </form>
    </div>
</div>
@endsection
