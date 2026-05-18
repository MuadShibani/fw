@extends('layouts.admin')
@section('title', 'Program Timeline')
@section('page-title', 'Accelerator — Program Timeline Roadmap')

@section('content')
<div class="admin-panel">
    <div class="panel-header">
        <h2>{{ $items->count() }} milestone{{ $items->count() === 1 ? '' : 's' }}</h2>
        <a href="/admin/program-milestones/create" class="btn btn-sm btn-primary">+ Add Milestone</a>
    </div>
    <p style="color:#6b5b50;margin: 0 0 1rem;">Each milestone becomes a node on the interactive roadmap. Set timeline (e.g. "Month 1", "Months 3–5"), an icon (emoji or short text), and a color.</p>
    <table class="data-table">
        <thead><tr><th>Order</th><th>Icon</th><th>Title</th><th>Timeline</th><th>Color</th><th>Actions</th></tr></thead>
        <tbody>
            @forelse ($items as $m)
                <tr>
                    <td>{{ $m->sort_order }}</td>
                    <td style="font-size:1.4rem;">{{ $m->icon ?: '—' }}</td>
                    <td><strong>{{ $m->title_en }}</strong><div style="color:#6b5b50;font-size:.85em;" dir="rtl">{{ $m->title_ar }}</div></td>
                    <td>{{ $m->timeline_en ?: '—' }}</td>
                    <td>
                        @if($m->color)
                            <span style="display:inline-flex;align-items:center;gap:.5rem;">
                                <span style="width:20px;height:20px;border-radius:50%;background:{{ $m->color }};display:inline-block;border:1px solid #ddd;"></span>
                                <code style="font-family:monospace;">{{ $m->color }}</code>
                            </span>
                        @else — @endif
                    </td>
                    <td class="actions-cell">
                        <a href="/admin/program-milestones/{{ $m->id }}/edit" class="btn btn-xs">Edit</a>
                        <form action="/admin/program-milestones/{{ $m->id }}" method="POST" class="inline" onsubmit="return confirm('Remove this milestone?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-xs btn-danger">Remove</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="empty-state">No milestones yet. <a href="/admin/program-milestones/create">Add the first one →</a></td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
