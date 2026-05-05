@extends('layouts.admin')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="dashboard-grid">
    <div class="stat-card-admin">
        <div class="stat-icon" style="background:#dbeafe">📰</div>
        <div class="stat-info">
            <div class="stat-value">{{ $counts['news'] }}</div>
            <div class="stat-label">News Articles</div>
        </div>
        <a href="/admin/news" class="stat-link">Manage →</a>
    </div>
    <div class="stat-card-admin">
        <div class="stat-icon" style="background:#ede9fe">✍️</div>
        <div class="stat-info">
            <div class="stat-value">{{ $counts['blog'] }}</div>
            <div class="stat-label">Blog Posts</div>
        </div>
        <a href="/admin/blog" class="stat-link">Manage →</a>
    </div>
    <div class="stat-card-admin">
        <div class="stat-icon" style="background:#fef3c7">📅</div>
        <div class="stat-info">
            <div class="stat-value">{{ $counts['events'] }}</div>
            <div class="stat-label">Events</div>
        </div>
        <a href="/admin/events" class="stat-link">Manage →</a>
    </div>
    <div class="stat-card-admin">
        <div class="stat-icon" style="background:#dcfce7">📁</div>
        <div class="stat-info">
            <div class="stat-value">{{ $counts['library'] }}</div>
            <div class="stat-label">Library Items</div>
        </div>
        <a href="/admin/library" class="stat-link">Manage →</a>
    </div>
    <div class="stat-card-admin">
        <div class="stat-icon" style="background:#fce7f3">✉️</div>
        <div class="stat-info">
            <div class="stat-value">{{ $counts['messages'] }}</div>
            <div class="stat-label">Messages
                @if($counts['unread_messages'] > 0)
                    <span class="badge-count">{{ $counts['unread_messages'] }} new</span>
                @endif
            </div>
        </div>
        <a href="/admin/messages" class="stat-link">Manage →</a>
    </div>
    <div class="stat-card-admin">
        <div class="stat-icon" style="background:#e0f2fe">👥</div>
        <div class="stat-info">
            <div class="stat-value">{{ $counts['investors'] }}</div>
            <div class="stat-label">Investors</div>
        </div>
        <a href="/admin/yain" class="stat-link">Manage →</a>
    </div>
    <div class="stat-card-admin">
        <div class="stat-icon" style="background:#f0fdf4">🚀</div>
        <div class="stat-info">
            <div class="stat-value">{{ $counts['startups'] }}</div>
            <div class="stat-label">Startups</div>
        </div>
        <a href="/admin/yain" class="stat-link">Manage →</a>
    </div>
    <div class="stat-card-admin">
        <div class="stat-icon" style="background:#fff7ed">📊</div>
        <div class="stat-info">
            <div class="stat-value">{{ $counts['cohorts'] }}</div>
            <div class="stat-label">Cohorts
                @if($activeCohort)
                    <span class="badge-active">1 active</span>
                @endif
            </div>
        </div>
        <a href="/admin/accelerator" class="stat-link">Manage →</a>
    </div>
    <div class="stat-card-admin">
        <div class="stat-icon" style="background:#fef2f2">🎞</div>
        <div class="stat-info">
            <div class="stat-value">{{ $counts['hero_slides'] }}</div>
            <div class="stat-label">Hero Slides
                @if(($counts['active_slides'] ?? 0) > 0)
                    <span class="badge-active">{{ $counts['active_slides'] }} active</span>
                @endif
            </div>
        </div>
        <a href="/admin/hero" class="stat-link">Manage →</a>
    </div>
</div>

<div class="dashboard-panels">
    {{-- Recent News --}}
    <div class="admin-panel">
        <div class="panel-header">
            <h2>Recent News</h2>
            <a href="/admin/news/create" class="btn btn-sm btn-primary">+ Add</a>
        </div>
        <table class="data-table">
            <thead><tr><th>Title</th><th>Category</th><th>Date</th><th></th></tr></thead>
            <tbody>
                @foreach($recentNews as $item)
                <tr>
                    <td>{{ $item->title_en }}</td>
                    <td><span class="badge">{{ $item->category }}</span></td>
                    <td>{{ $item->date->format('d M Y') }}</td>
                    <td><a href="/admin/news/{{ $item->id }}/edit" class="btn btn-xs">Edit</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Latest Messages --}}
    <div class="admin-panel">
        <div class="panel-header">
            <h2>Latest Messages</h2>
            <a href="/admin/messages" class="btn btn-sm btn-outline">View All</a>
        </div>
        <div class="messages-list">
            @forelse($latestMessages as $msg)
            <div class="message-row {{ !$msg->is_read ? 'unread' : '' }}">
                <div class="message-sender">{{ $msg->first_name }} {{ $msg->last_name }}</div>
                <div class="message-email">{{ $msg->email }}</div>
                <div class="message-preview">{{ Str::limit($msg->message, 60) }}</div>
                <a href="/admin/messages/{{ $msg->id }}" class="btn btn-xs">View</a>
            </div>
            @empty
            <p class="empty-state">No messages yet.</p>
            @endforelse
        </div>
    </div>

    {{-- Upcoming Events --}}
    <div class="admin-panel">
        <div class="panel-header">
            <h2>Upcoming Events</h2>
            <a href="/admin/events/create" class="btn btn-sm btn-primary">+ Add</a>
        </div>
        <table class="data-table">
            <thead><tr><th>Event</th><th>Date</th><th>Type</th><th></th></tr></thead>
            <tbody>
                @forelse($upcomingEvents as $event)
                <tr>
                    <td>{{ $event->title_en }}</td>
                    <td>{{ $event->event_date->format('d M Y') }}</td>
                    <td><span class="badge">{{ $event->type }}</span></td>
                    <td><a href="/admin/events/{{ $event->id }}/edit" class="btn btn-xs">Edit</a></td>
                </tr>
                @empty
                <tr><td colspan="4" class="empty-state">No upcoming events.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Quick Actions --}}
    <div class="admin-panel">
        <div class="panel-header"><h2>Quick Actions</h2></div>
        <div class="quick-actions">
            <a href="/admin/hero/create"              class="quick-action-btn">🎞 Add Hero Slide</a>
            <a href="/admin/news/create"              class="quick-action-btn">📰 Post News</a>
            <a href="/admin/blog/create"              class="quick-action-btn">✍️ Write Blog Post</a>
            <a href="/admin/events/create"            class="quick-action-btn">📅 Create Event</a>
            <a href="/admin/library/create"           class="quick-action-btn">📁 Upload to Library</a>
            <a href="/admin/yain/investors/create"    class="quick-action-btn">👤 Add Investor</a>
            <a href="/admin/yain/startups/create"     class="quick-action-btn">🚀 Add Startup</a>
            <a href="/admin/accelerator/cohorts/create" class="quick-action-btn">🎓 New Cohort</a>
            <a href="/admin/wiif/create"              class="quick-action-btn">💼 Add Portfolio Co.</a>
            <a href="/admin/stats"                  class="quick-action-btn">📈 Edit Homepage Stats</a>
        </div>
    </div>
</div>
@endsection
