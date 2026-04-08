@extends('layouts.admin')
@section('title','Accelerator')
@section('page-title','Accelerator — Cohort Management')
@section('content')
<div class="panel-header mb-6">
    <a href="/admin/accelerator/cohorts/create" class="btn btn-primary">+ New Cohort</a>
</div>
<div class="admin-panel mb-8">
    <h2 class="panel-title">Cohorts</h2>
    <table class="data-table">
        <thead><tr><th>Name</th><th>Status</th><th>Start</th><th>End</th><th>Startups</th><th>Actions</th></tr></thead>
        <tbody>
        @forelse($cohorts as $cohort)
        <tr>
            <td>{{ $cohort->name_en }}</td>
            <td><span class="status-badge status-{{ strtolower($cohort->status) }}">{{ $cohort->status }}</span></td>
            <td>{{ $cohort->start_date->format('d M Y') }}</td>
            <td>{{ $cohort->end_date->format('d M Y') }}</td>
            <td>{{ $cohort->startups_count }}</td>
            <td class="actions-cell">
                <a href="/admin/accelerator/cohorts/{{ $cohort->id }}/edit" class="btn btn-xs">Edit</a>
                <form action="/admin/accelerator/cohorts/{{ $cohort->id }}" method="POST" class="inline" onsubmit="return confirm('Delete?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-xs btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="6" class="empty-state">No cohorts yet.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
