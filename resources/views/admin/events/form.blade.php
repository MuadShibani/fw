@extends('layouts.admin')
@section('title', $item ? 'Edit Event' : 'New Event')
@section('page-title', $item ? 'Edit Event' : 'New Event')
@section('content')
<div class="admin-panel">
    <form action="{{ $item ? '/admin/events/'.$item->id : '/admin/events' }}" method="POST">
        @csrf
        @if($item) @method('PUT') @endif
        <div class="form-grid-2">
            <div class="form-group">
                <label>Title (English) *</label>
                <input type="text" name="title_en" value="{{ old('title_en', $item->title_en ?? '') }}" class="form-input" required>
            </div>
            <div class="form-group">
                <label>Title (Arabic) *</label>
                <input type="text" name="title_ar" value="{{ old('title_ar', $item->title_ar ?? '') }}" class="form-input" dir="rtl" required>
            </div>
            <div class="form-group">
                <label>Event Date *</label>
                <input type="date" name="event_date" value="{{ old('event_date', $item ? $item->event_date->format('Y-m-d') : '') }}" class="form-input" required>
            </div>
            <div class="form-group">
                <label>Event Time *</label>
                <input type="text" name="event_time" value="{{ old('event_time', $item->event_time ?? '') }}" class="form-input" placeholder="10:00 AM - 02:00 PM" required>
            </div>
            <div class="form-group">
                <label>Location (English)</label>
                <input type="text" name="location_en" value="{{ old('location_en', $item->location_en ?? '') }}" class="form-input" placeholder="Wathba HQ, Sanaa">
            </div>
            <div class="form-group">
                <label>Location (Arabic)</label>
                <input type="text" name="location_ar" value="{{ old('location_ar', $item->location_ar ?? '') }}" class="form-input" dir="rtl" placeholder="مقر وثبة، صنعاء">
            </div>
            <div class="form-group">
                <label>Type *</label>
                <select name="type" class="form-input" required>
                    @foreach(['Workshop','Webinar','Networking','Pitch Day'] as $type)
                    <option value="{{ $type }}" {{ old('type', $item->type ?? '') === $type ? 'selected' : '' }}>{{ $type }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Registration Link</label>
                <input type="text" name="registration_link" value="{{ old('registration_link', $item->registration_link ?? '') }}" class="form-input" placeholder="https://forms.google.com/...">
            </div>
            <div class="form-group">
                <label>Capacity</label>
                <input type="number" name="capacity" value="{{ old('capacity', $item->capacity ?? '') }}" class="form-input" min="0">
            </div>
            <div class="form-group">
                <label>Registered Count</label>
                <input type="number" name="registered_count" value="{{ old('registered_count', $item->registered_count ?? 0) }}" class="form-input" min="0">
            </div>
        </div>
        <div class="form-group mt-4">
            <label class="flex items-center gap-2">
                <input type="checkbox" name="is_virtual" value="1" {{ old('is_virtual', $item->is_virtual ?? false) ? 'checked' : '' }}>
                Virtual / Online Event
            </label>
        </div>
        <div class="form-group">
            <label>Description (English)</label>
            <textarea name="description_en" rows="3" class="form-input">{{ old('description_en', $item->description_en ?? '') }}</textarea>
        </div>
        <div class="form-group">
            <label>Description (Arabic)</label>
            <textarea name="description_ar" rows="3" class="form-input" dir="rtl">{{ old('description_ar', $item->description_ar ?? '') }}</textarea>
        </div>
        <div class="form-actions">
            <a href="/admin/events" class="btn btn-outline">Cancel</a>
            <button type="submit" class="btn btn-primary">{{ $item ? 'Update' : 'Create' }} Event</button>
        </div>
    </form>
</div>
@endsection
