@extends('layouts.admin')
@section('title','YAIN')
@section('page-title','YAIN — Investors & Startups')
@section('content')
<div class="tabs-wrap mb-6" id="yainTabs">
    <button class="tab-btn active" data-tab="investors">👥 Investors ({{ count($investors) }})</button>
    <button class="tab-btn" data-tab="startups">🚀 Startups ({{ count($startups) }})</button>
</div>

{{-- Investors --}}
<div class="tab-panel active" id="tab-investors">
    <div class="panel-header mb-4">
        <a href="/admin/yain/investors/create" class="btn btn-primary">+ Add Investor</a>
    </div>
    <div class="admin-panel">
        <table class="data-table">
            <thead><tr><th>Name (EN)</th><th>Role (EN)</th><th>LinkedIn</th><th>Actions</th></tr></thead>
            <tbody>
            @forelse($investors as $inv)
            <tr>
                <td class="flex items-center gap-3"><img src="{{ $inv->image_url }}" class="avatar-sm" alt="">{{ $inv->name_en }}</td>
                <td>{{ $inv->role_en }}</td>
                <td>{{ $inv->linkedin_url ? 'Yes' : '-' }}</td>
                <td class="actions-cell">
                    <a href="/admin/yain/investors/{{ $inv->id }}/edit" class="btn btn-xs">Edit</a>
                    <form action="/admin/yain/investors/{{ $inv->id }}" method="POST" class="inline" onsubmit="return confirm('Delete?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-xs btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="4" class="empty-state">No investors yet.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Startups --}}
<div class="tab-panel hidden" id="tab-startups">
    <div class="panel-header mb-4">
        <a href="/admin/yain/startups/create" class="btn btn-primary">+ Add Startup</a>
    </div>
    <div class="admin-panel">
        <table class="data-table">
            <thead><tr><th>Name</th><th>Sector</th><th>Stage</th><th>Founder</th><th>Actions</th></tr></thead>
            <tbody>
            @forelse($startups as $s)
            <tr>
                <td>{{ $s->name }}</td>
                <td>{{ $s->sector }}</td>
                <td><span class="badge">{{ $s->stage }}</span></td>
                <td>{{ $s->founder_name ?? '-' }}</td>
                <td class="actions-cell">
                    <a href="/admin/yain/startups/{{ $s->id }}/edit" class="btn btn-xs">Edit</a>
                    <form action="/admin/yain/startups/{{ $s->id }}" method="POST" class="inline" onsubmit="return confirm('Delete?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-xs btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="empty-state">No startups yet.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
@push('scripts')
<script>
document.querySelectorAll('.tab-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
        document.querySelectorAll('.tab-panel').forEach(p => { p.classList.add('hidden'); p.classList.remove('active'); });
        btn.classList.add('active');
        document.getElementById('tab-' + btn.dataset.tab).classList.remove('hidden');
        document.getElementById('tab-' + btn.dataset.tab).classList.add('active');
    });
});
</script>
@endpush
