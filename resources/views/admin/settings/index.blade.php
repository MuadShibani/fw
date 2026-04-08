@extends('layouts.admin')
@section('title','Settings')
@section('page-title','Settings')
@section('content')
<div class="settings-grid">

    {{-- General Settings --}}
    <div class="admin-panel">
        <h2 class="panel-title">General Settings</h2>
        <form action="/admin/settings" method="POST">
            @csrf
            <div class="form-group">
                <label>Site Name (English)</label>
                <input type="text" name="site_name_en" value="{{ old('site_name_en', $siteName) }}" class="form-input" required>
            </div>
            <div class="form-group">
                <label>Contact Email</label>
                <input type="email" name="contact_email" value="{{ old('contact_email', $contactEmail) }}" class="form-input" required>
            </div>
            <h3 class="settings-subheading">Form Links</h3>
            <div class="form-group">
                <label>Accelerator Application Link</label>
                <input type="text" name="app_links[acceleratorApplication]" value="{{ old('app_links.acceleratorApplication', $appLinks['acceleratorApplication'] ?? '') }}" class="form-input" placeholder="https://forms.google.com/...">
            </div>
            <div class="form-group">
                <label>YAIN — Startup Pitch Link</label>
                <input type="text" name="app_links[yainStartupPitch]" value="{{ old('app_links.yainStartupPitch', $appLinks['yainStartupPitch'] ?? '') }}" class="form-input">
            </div>
            <div class="form-group">
                <label>YAIN — Investor Join Link</label>
                <input type="text" name="app_links[yainInvestorJoin]" value="{{ old('app_links.yainInvestorJoin', $appLinks['yainInvestorJoin'] ?? '') }}" class="form-input">
            </div>
            <div class="form-group">
                <label>SIL External Link <span class="label-hint">(Leave blank to show SIL page)</span></label>
                <input type="text" name="app_links[silExternalLink]" value="{{ old('app_links.silExternalLink', $appLinks['silExternalLink'] ?? '') }}" class="form-input">
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Save Settings</button>
            </div>
        </form>
    </div>

    {{-- Change Password --}}
    <div class="admin-panel">
        <h2 class="panel-title">Change Password</h2>
        <form action="/admin/settings/password" method="POST">
            @csrf
            <div class="form-group">
                <label>Current Password</label>
                <input type="password" name="current_password" class="form-input @error('current_password') is-invalid @enderror" required>
                @error('current_password')<span class="form-error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label>New Password</label>
                <input type="password" name="new_password" class="form-input" required minlength="6">
            </div>
            <div class="form-group">
                <label>Confirm New Password</label>
                <input type="password" name="new_password_confirmation" class="form-input" required>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Update Password</button>
            </div>
        </form>
    </div>

</div>
@endsection
