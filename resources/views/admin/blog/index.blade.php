@extends('layouts.admin')
@section('title','Blog')
@section('page-title','Blog Management')
@section('content')
<div class="panel-header mb-6">
    <a href="/admin/blog/create" class="btn btn-primary">+ Write Blog Post</a>
</div>
<div class="admin-panel">
    <table class="data-table">
        <thead><tr><th>Title (EN)</th><th>Author</th><th>Date</th><th>Actions</th></tr></thead>
        <tbody>
        @forelse($items as $item)
        <tr>
            <td>{{ $item->title_en }}</td>
            <td>{{ $item->author_en }}</td>
            <td>{{ $item->date->format('d M Y') }}</td>
            <td class="actions-cell">
                <a href="/admin/blog/{{ $item->id }}/edit" class="btn btn-xs">Edit</a>
                <form action="/admin/blog/{{ $item->id }}" method="POST" class="inline" onsubmit="return confirm('Delete?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-xs btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="4" class="empty-state">No blog posts yet.</td></tr>
        @endforelse
        </tbody>
    </table>
    <div class="mt-4">{{ $items->links() }}</div>
</div>
@endsection
