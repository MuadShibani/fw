@extends('layouts.admin')
@section('title','News')
@section('page-title','News Management')
@section('content')
<div class="panel-header mb-6">
    <a href="/admin/news/create" class="btn btn-primary">+ Add News Article</a>
</div>
<div class="admin-panel">
    <table class="data-table">
        <thead><tr><th>Title (EN)</th><th>Category</th><th>Date</th><th>Actions</th></tr></thead>
        <tbody>
        @forelse($items as $item)
        <tr>
            <td>{{ $item->title_en }}</td>
            <td><span class="badge">{{ $item->category }}</span></td>
            <td>{{ $item->date->format('d M Y') }}</td>
            <td class="actions-cell">
                <a href="/admin/news/{{ $item->id }}/edit" class="btn btn-xs">Edit</a>
                <form action="/admin/news/{{ $item->id }}" method="POST" class="inline" onsubmit="return confirm('Delete?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-xs btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="4" class="empty-state">No news articles yet.</td></tr>
        @endforelse
        </tbody>
    </table>
    <div class="mt-4">{{ $items->links() }}</div>
</div>
@endsection
