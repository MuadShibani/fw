@extends('layouts.admin')
@section('title', $item ? 'Edit Cohort' : 'New Cohort')
@section('page-title', $item ? 'Edit Cohort' : 'New Cohort')
@section('content')
@php
    $startupRows = old('startups_list', $item->startups_list ?? []);
    $startupRows = array_pad(array_slice($startupRows, 0, 10), 10, ['name' => '', 'logo_url' => '']);
@endphp
<div class="admin-panel">
    <form action="{{ $item ? '/admin/accelerator/cohorts/'.$item->id : '/admin/accelerator/cohorts' }}" method="POST">
        @csrf
        @if($item) @method('PUT') @endif
        <div class="form-grid-2">
            <div class="form-group">
                <label>Name (English) *</label>
                <input type="text" name="name_en" value="{{ old('name_en', $item->name_en ?? '') }}" class="form-input" required>
            </div>
            <div class="form-group">
                <label>Name (Arabic) *</label>
                <input type="text" name="name_ar" value="{{ old('name_ar', $item->name_ar ?? '') }}" class="form-input" dir="rtl" required>
            </div>
            <div class="form-group">
                <label>Status *</label>
                <select name="status" class="form-input" required>
                    @foreach(['Active','Completed','Upcoming'] as $s)
                    <option value="{{ $s }}" {{ old('status', $item->status ?? '') === $s ? 'selected' : '' }}>{{ $s }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Startups Count</label>
                <input type="number" name="startups_count" value="{{ old('startups_count', $item->startups_count ?? 0) }}" class="form-input" min="0">
            </div>
            <div class="form-group">
                <label>Start Date *</label>
                <input type="date" name="start_date" value="{{ old('start_date', $item ? $item->start_date->format('Y-m-d') : '') }}" class="form-input" required>
            </div>
            <div class="form-group">
                <label>End Date *</label>
                <input type="date" name="end_date" value="{{ old('end_date', $item ? $item->end_date->format('Y-m-d') : '') }}" class="form-input" required>
            </div>
        </div>

        <div class="mt-8">
            <h2 class="panel-title">Startup Roster</h2>
            <p class="text-sm text-gray-500 mb-4">Add up to 10 startups. Only the startup name and square logo are shown on the public accelerator page.</p>

            <div class="cohort-startups-editor">
                @foreach ($startupRows as $i => $startup)
                    <div class="cohort-startup-editor-card">
                        <h3>Startup {{ $i + 1 }}</h3>
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="startups_list[{{ $i }}][name]" value="{{ $startup['name'] ?? '' }}" class="form-input" maxlength="255">
                        </div>
                        <x-image-upload
                            name="startups_list[{{ $i }}][logo_url]"
                            label="Square Logo"
                            :value="$startup['logo_url'] ?? ''"
                        />
                    </div>
                @endforeach
            </div>
        </div>

        <div class="form-actions">
            <a href="/admin/accelerator" class="btn btn-outline">Cancel</a>
            <button type="submit" class="btn btn-primary">{{ $item ? 'Update' : 'Create' }} Cohort</button>
        </div>
    </form>
</div>
@endsection

@push('styles')
<style>
.cohort-startups-editor {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
    gap: 1rem;
}
.cohort-startup-editor-card {
    border: 1px solid #e5e7eb;
    border-radius: 10px;
    padding: 1rem;
    background: #fff;
}
.cohort-startup-editor-card h3 {
    margin: 0 0 1rem;
    color: var(--brown);
    font-size: .95rem;
    font-weight: 700;
}
</style>
@endpush
