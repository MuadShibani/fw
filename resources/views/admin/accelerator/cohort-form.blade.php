@extends('layouts.admin')
@section('title', $item ? 'Edit Cohort' : 'New Cohort')
@section('page-title', $item ? 'Edit Cohort' : 'New Cohort')
@section('content')
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
        <div class="form-actions">
            <a href="/admin/accelerator" class="btn btn-outline">Cancel</a>
            <button type="submit" class="btn btn-primary">{{ $item ? 'Update' : 'Create' }} Cohort</button>
        </div>
    </form>
</div>
@endsection
