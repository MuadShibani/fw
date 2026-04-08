@extends('layouts.admin')
@section('title','Library')
@section('page-title','Library Management')
@section('content')
<div class="panel-header mb-6">
    <a href="/admin/library/create" class="btn btn-primary">+ Add Item</a>
</div>
<div class="admin-panel">
    <table class="data-table">
        <thead><tr><th>Title (EN)</th><th>Type</th><th>Date</th><th>Size</th><th>Actions</th></tr></thead>
        <tbody>
        @forelse($items as $item)
        <tr>
            <td>{{ $item->title_en }}</td>
            <td><span class="badge">{{ $item->type }}</span></td>
            <td>{{ $item->file_date->format('d M Y') }}</td>
            <td>{{ $item->size ?? '-' }}</td>
            <td class="actions-cell">
                <a href="/admin/library/{{ $item->id }}/edit" class="btn btn-xs">Edit</a>
                <form action="/admin/library/{{ $item->id }}" method="POST" class="inline" onsubmit="return confirm('Delete?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-xs btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="5" class="empty-state">No library items yet.</td></tr>
        @endforelse
        </tbody>
    </table>
    <div class="mt-4">{{ $items->links() }}</div>
</div>
@endsection
