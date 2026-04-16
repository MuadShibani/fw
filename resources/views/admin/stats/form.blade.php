@extends('layouts.admin')
@section('title', $stat ? 'Edit Stat' : 'New Stat')
@section('page-title', $stat ? 'Edit Homepage Stat' : 'New Homepage Stat')
@section('content')
<div class="admin-panel" style="max-width:600px">
    <p class="text-gray-500 mb-6">This value displays in the stats bar on the homepage (e.g. "50+", "$1.5M", "200+").</p>
    <form action="{{ $stat ? '/admin/stats/'.$stat->id : '/admin/stats' }}" method="POST">
        @csrf
        @if($stat) @method('PUT') @endif
        <div class="form-group">
            <label>Value * <span class="label-hint">e.g. 50+ or $1.5M or 200+</span></label>
            <input type="text" name="value" value="{{ old('value', $stat->value ?? '') }}" class="form-input" placeholder="50+" required>
        </div>
        <div class="form-group">
            <label>Label (English) *</label>
            <input type="text" name="label_en" value="{{ old('label_en', $stat->label_en ?? '') }}" class="form-input" placeholder="Startups Supported" required>
        </div>
        <div class="form-group">
            <label>Label (Arabic) *</label>
            <input type="text" name="label_ar" value="{{ old('label_ar', $stat->label_ar ?? '') }}" class="form-input" dir="rtl" placeholder="شركة ناشئة مدعومة" required>
        </div>
        <div class="form-group">
            <label>Icon <span class="label-hint">e.g. rocket, users, trending-up</span></label>
            <input type="text" name="icon" value="{{ old('icon', $stat->icon ?? 'star') }}" class="form-input" placeholder="rocket">
        </div>
        <div class="form-actions">
            <a href="/admin/stats" class="btn btn-outline">Cancel</a>
            <button type="submit" class="btn btn-primary">{{ $stat ? 'Update' : 'Create' }} Stat</button>
        </div>
    </form>
</div>
@endsection
