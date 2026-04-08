@extends('layouts.admin')
@section('title','WIIF')
@section('page-title','WIIF Portfolio Companies')
@section('content')
<div class="panel-header mb-6">
    <a href="/admin/wiif/create" class="btn btn-primary">+ Add Portfolio Company</a>
</div>
<div class="admin-panel">
    <table class="data-table">
        <thead><tr><th>Name</th><th>Sector</th><th>Investment Date</th><th>Actions</th></tr></thead>
        <tbody>
        @forelse($portfolio as $item)
        <tr>
            <td>{{ $item->name }}</td>
            <td>{{ $item->sector_en }}</td>
            <td>{{ $item->investment_date->format('d M Y') }}</td>
            <td class="actions-cell">
                <a href="/admin/wiif/{{ $item->id }}/edit" class="btn btn-xs">Edit</a>
                <form action="/admin/wiif/{{ $item->id }}" method="POST" class="inline" onsubmit="return confirm('Delete?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-xs btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="4" class="empty-state">No portfolio companies yet.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
