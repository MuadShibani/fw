@extends('layouts.admin')
@section('title', $item ? 'Edit Investor' : 'Add Investor')
@section('page-title', $item ? 'Edit Investor' : 'Add Investor')
@section('content')
<div class="admin-panel">
    <form action="{{ $item ? '/admin/yain/investors/'.$item->id : '/admin/yain/investors' }}" method="POST">
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
                <label>Role (English) *</label>
                <input type="text" name="role_en" value="{{ old('role_en', $item->role_en ?? '') }}" class="form-input" required>
            </div>
            <div class="form-group">
                <label>Role (Arabic) *</label>
                <input type="text" name="role_ar" value="{{ old('role_ar', $item->role_ar ?? '') }}" class="form-input" dir="rtl" required>
            </div>
            <div class="form-group">
                <label>LinkedIn URL</label>
                <input type="text" name="linkedin_url" value="{{ old('linkedin_url', $item->linkedin_url ?? '') }}" class="form-input" placeholder="https://linkedin.com/in/...">
            </div>
            <div class="form-group">
                <label>Twitter URL</label>
                <input type="text" name="twitter_url" value="{{ old('twitter_url', $item->twitter_url ?? '') }}" class="form-input" placeholder="https://twitter.com/...">
            </div>
        </div>
        <div class="mt-4">
            <x-image-upload name="image_url" label="Profile Photo *" :value="old('image_url', $item->image_url ?? '')" :required="true" />
        </div>
        <div class="form-group mt-4">
            <label>Bio (English) *</label>
            <textarea name="bio_en" rows="4" class="form-input" required>{{ old('bio_en', $item->bio_en ?? '') }}</textarea>
        </div>
        <div class="form-group">
            <label>Bio (Arabic) *</label>
            <textarea name="bio_ar" rows="4" class="form-input" dir="rtl" required>{{ old('bio_ar', $item->bio_ar ?? '') }}</textarea>
        </div>
        <div class="form-actions">
            <a href="/admin/yain" class="btn btn-outline">Cancel</a>
            <button type="submit" class="btn btn-primary">{{ $item ? 'Update' : 'Add' }} Investor</button>
        </div>
    </form>
</div>
@endsection
