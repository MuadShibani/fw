@extends('layouts.admin')
@section('title', $item ? 'Edit Company' : 'Add Portfolio Company')
@section('page-title', $item ? 'Edit Portfolio Company' : 'Add Portfolio Company')
@section('content')
<div class="admin-panel">
    <form action="{{ $item ? '/admin/wiif/'.$item->id : '/admin/wiif' }}" method="POST" id="wiifForm">
        @csrf
        @if($item) @method('PUT') @endif
        <div class="form-grid-2">
            <div class="form-group">
                <label>Company Name *</label>
                <input type="text" name="name" value="{{ old('name', $item->name ?? '') }}" class="form-input" required>
            </div>
            <div class="form-group">
                <label>Investment Date *</label>
                <input type="date" name="investment_date" value="{{ old('investment_date', $item ? $item->investment_date->format('Y-m-d') : '') }}" class="form-input" required>
            </div>
            <div class="form-group">
                <label>Sector (English) *</label>
                <input type="text" name="sector_en" value="{{ old('sector_en', $item->sector_en ?? '') }}" class="form-input" required>
            </div>
            <div class="form-group">
                <label>Sector (Arabic) *</label>
                <input type="text" name="sector_ar" value="{{ old('sector_ar', $item->sector_ar ?? '') }}" class="form-input" dir="rtl" required>
            </div>
        </div>
        <div class="mt-4">
            <x-image-upload name="logo_url" label="Company Logo *" :value="old('logo_url', $item->logo_url ?? '')" :required="true" />
        </div>

        <div class="mt-4">
            <x-quill-editor name="description_en" label="Description (English)" :value="old('description_en', $item->description_en ?? '')" :required="true" />
            <x-quill-editor name="description_ar" label="Description (Arabic)" :value="old('description_ar', $item->description_ar ?? '')" :required="true" dir="rtl" />
        </div>

        <div class="form-actions">
            <a href="/admin/wiif" class="btn btn-outline">Cancel</a>
            <button type="submit" class="btn btn-primary">{{ $item ? 'Update' : 'Add' }} Company</button>
        </div>
    </form>
</div>
@endsection
