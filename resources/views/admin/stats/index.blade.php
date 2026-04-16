@extends('layouts.admin')
@section('title','Homepage Stats')
@section('page-title','Homepage Stats Management')
@section('content')
<div class="panel-header mb-6">
    <p class="text-gray-500">These numbers appear in the stats bar on the homepage.</p>
    <a href="/admin/stats/create" class="btn btn-primary">+ Add Stat</a>
</div>
<div class="admin-panel">
    <table class="data-table">
        <thead><tr><th>Value</th><th>Label (EN)</th><th>Label (AR)</th><th>Icon</th><th>Actions</th></tr></thead>
        <tbody>
        @forelse($stats as $stat)
        <tr>
            <td><strong style="font-size:1.1rem;color:var(--brown)">{{ $stat->value }}</strong></td>
            <td>{{ $stat->label_en }}</td>
            <td dir="rtl">{{ $stat->label_ar }}</td>
            <td><span class="badge">{{ $stat->icon }}</span></td>
            <td class="actions-cell">
                <a href="/admin/stats/{{ $stat->id }}/edit" class="btn btn-xs">Edit</a>
                <form action="/admin/stats/{{ $stat->id }}" method="POST" class="inline" onsubmit="return confirm('Delete this stat?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-xs btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="5" class="empty-state">No stats yet. Add your first stat.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>

{{-- Preview --}}
<div class="admin-panel mt-6">
    <h3 class="panel-title">👁 Homepage Preview</h3>
    <div style="background:var(--brown);border-radius:10px;padding:2rem;display:flex;gap:2rem;justify-content:center;flex-wrap:wrap;">
        @foreach($stats as $stat)
        <div style="text-align:center;color:white;min-width:140px;">
            <div style="font-size:2rem;font-weight:800;color:var(--beige)">{{ $stat->value }}</div>
            <div style="font-size:.85rem;opacity:.7;margin-top:.25rem">{{ $stat->label_en }}</div>
        </div>
        @endforeach
    </div>
</div>
@endsection
