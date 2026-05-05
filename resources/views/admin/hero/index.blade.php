@extends('layouts.admin')
@section('title', 'Hero Slides')
@section('page-title', 'Homepage Hero Slides')

@section('content')
<div class="admin-panel">
    <div class="panel-header">
        <h2>{{ $items->count() }} slide{{ $items->count() === 1 ? '' : 's' }}</h2>
        <a href="/admin/hero/create" class="btn btn-sm btn-primary">+ New Slide</a>
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th></th>
                <th>Order</th>
                <th>Title</th>
                <th>CTA</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($items as $item)
            <tr>
                <td>
                    @if($item->image_url)
                        <img src="{{ $item->image_url }}" alt="" style="width:60px;height:40px;object-fit:cover;border-radius:4px;">
                    @else
                        <span style="color:#aaa;">—</span>
                    @endif
                </td>
                <td>{{ $item->sort_order }}</td>
                <td>
                    <strong>{{ $item->title_en ?: '(no English title)' }}</strong>
                    @if($item->title_ar)<div style="color:#6b5b50;font-size:.85em" dir="rtl">{{ $item->title_ar }}</div>@endif
                </td>
                <td>
                    @if($item->cta_label_en && $item->cta_link)
                        <span class="badge">{{ $item->cta_label_en }}</span>
                        <div style="font-size:.8em;color:#888;">{{ $item->cta_link }}</div>
                    @else
                        <span style="color:#aaa;">—</span>
                    @endif
                </td>
                <td>
                    @if($item->is_active)
                        <span class="status-badge status-active">Active</span>
                    @else
                        <span class="status-badge">Hidden</span>
                    @endif
                </td>
                <td class="actions-cell">
                    <a href="/admin/hero/{{ $item->id }}/edit" class="btn btn-xs">Edit</a>
                    <form action="/admin/hero/{{ $item->id }}" method="POST" class="inline" onsubmit="return confirm('Delete this slide?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-xs btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="empty-state">No hero slides yet. <a href="/admin/hero/create">Add the first one →</a></td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
