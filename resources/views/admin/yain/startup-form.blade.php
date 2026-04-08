@extends('layouts.admin')
@section('title', $item ? 'Edit Startup' : 'Add Startup')
@section('page-title', $item ? 'Edit Startup' : 'Add Startup')
@section('content')
<div class="admin-panel">
    <form action="{{ $item ? '/admin/yain/startups/'.$item->id : '/admin/yain/startups' }}" method="POST">
        @csrf
        @if($item) @method('PUT') @endif
        <div class="form-grid-2">
            <div class="form-group">
                <label>Name *</label>
                <input type="text" name="name" value="{{ old('name', $item->name ?? '') }}" class="form-input" required>
            </div>
            <div class="form-group">
                <label>Sector *</label>
                <input type="text" name="sector" value="{{ old('sector', $item->sector ?? '') }}" class="form-input" placeholder="Fintech, AgriTech..." required>
            </div>
            <div class="form-group">
                <label>Stage *</label>
                <select name="stage" class="form-input" required>
                    @foreach(['Pre-Seed','Seed','Series A','Bootstrapped'] as $stage)
                    <option value="{{ $stage }}" {{ old('stage', $item->stage ?? '') === $stage ? 'selected' : '' }}>{{ $stage }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Founder Name</label>
                <input type="text" name="founder_name" value="{{ old('founder_name', $item->founder_name ?? '') }}" class="form-input">
            </div>
        </div>
        <div class="mt-4">
            <x-image-upload name="logo_url" label="Company Logo *" :value="old('logo_url', $item->logo_url ?? '')" :required="true" />
        </div>
        <div class="form-group mt-4">
            <label>Description (English) *</label>
            <textarea name="description_en" rows="3" class="form-input" required>{{ old('description_en', $item->description_en ?? '') }}</textarea>
        </div>
        <div class="form-group">
            <label>Description (Arabic) *</label>
            <textarea name="description_ar" rows="3" class="form-input" dir="rtl" required>{{ old('description_ar', $item->description_ar ?? '') }}</textarea>
        </div>
        <div class="form-actions">
            <a href="/admin/yain" class="btn btn-outline">Cancel</a>
            <button type="submit" class="btn btn-primary">{{ $item ? 'Update' : 'Add' }} Startup</button>
        </div>
    </form>
</div>
@endsection
