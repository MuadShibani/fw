@extends('layouts.admin')
@section('title', 'WIIF Members')
@section('page-title', 'WIIF — GPs & Investment Committee')

@section('content')
<div class="admin-panel">
    <div class="panel-header">
        <h2>General Partners ({{ $gps->count() }})</h2>
        <a href="/admin/wiif-members/create?type=gp" class="btn btn-sm btn-primary">+ Add GP</a>
    </div>
    <table class="data-table">
        <thead><tr><th></th><th>Name</th><th>Role</th><th>Order</th><th>Actions</th></tr></thead>
        <tbody>
            @forelse ($gps as $m)
                <tr>
                    <td>@if($m->image_url)<img src="{{ $m->image_url }}" style="width:40px;height:40px;border-radius:50%;object-fit:cover;">@endif</td>
                    <td><strong>{{ $m->name_en }}</strong><div style="color:#6b5b50;font-size:.85em;" dir="rtl">{{ $m->name_ar }}</div></td>
                    <td>{{ $m->role_en }}</td>
                    <td>{{ $m->sort_order }}</td>
                    <td class="actions-cell">
                        <a href="/admin/wiif-members/{{ $m->id }}/edit" class="btn btn-xs">Edit</a>
                        <form action="/admin/wiif-members/{{ $m->id }}" method="POST" class="inline" onsubmit="return confirm('Delete?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-xs btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="empty-state">No general partners yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="admin-panel mt-6">
    <div class="panel-header">
        <h2>Investment Committee ({{ $committee->count() }})</h2>
        <a href="/admin/wiif-members/create?type=committee" class="btn btn-sm btn-primary">+ Add Member</a>
    </div>
    <table class="data-table">
        <thead><tr><th></th><th>Name</th><th>Role</th><th>Order</th><th>Actions</th></tr></thead>
        <tbody>
            @forelse ($committee as $m)
                <tr>
                    <td>@if($m->image_url)<img src="{{ $m->image_url }}" style="width:40px;height:40px;border-radius:50%;object-fit:cover;">@endif</td>
                    <td><strong>{{ $m->name_en }}</strong><div style="color:#6b5b50;font-size:.85em;" dir="rtl">{{ $m->name_ar }}</div></td>
                    <td>{{ $m->role_en }}</td>
                    <td>{{ $m->sort_order }}</td>
                    <td class="actions-cell">
                        <a href="/admin/wiif-members/{{ $m->id }}/edit" class="btn btn-xs">Edit</a>
                        <form action="/admin/wiif-members/{{ $m->id }}" method="POST" class="inline" onsubmit="return confirm('Delete?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-xs btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="empty-state">No committee members yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
