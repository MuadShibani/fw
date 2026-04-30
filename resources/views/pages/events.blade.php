@extends('layouts.app')
@section('title', $lang === 'ar' ? 'الفعاليات' : 'Events')

@section('content')

@include('partials.page-hero', ['fallbackBg' => '#524037'])

{{-- Filter tabs --}}
<section class="section">
    <div class="container">
        <div class="filter-tabs" id="eventFilters">
            <button class="filter-tab active" data-filter="all">{{ $lang === 'en' ? 'All' : 'الكل' }}</button>
            <button class="filter-tab" data-filter="Workshop">{{ $lang === 'en' ? 'Workshops' : 'ورش عمل' }}</button>
            <button class="filter-tab" data-filter="Webinar">{{ $lang === 'en' ? 'Webinars' : 'ندوات' }}</button>
            <button class="filter-tab" data-filter="Networking">{{ $lang === 'en' ? 'Networking' : 'تواصل' }}</button>
            <button class="filter-tab" data-filter="Pitch Day">{{ $lang === 'en' ? 'Pitch Days' : 'أيام العرض' }}</button>
        </div>

        <div class="events-cards-grid" id="eventsGrid">
            @forelse ($events as $event)
                <div class="event-card" data-type="{{ $event->type }}">
                    <div class="event-card-top">
                        <div class="event-card-date">
                            <span class="event-day">{{ \Carbon\Carbon::parse($event->event_date)->format('d') }}</span>
                            <span class="event-month">{{ \Carbon\Carbon::parse($event->event_date)->format('M Y') }}</span>
                        </div>
                        <span class="event-type-badge event-type-{{ strtolower(str_replace(' ', '-', $event->type)) }}">
                            {{ $event->type }}
                        </span>
                    </div>
                    <h3 class="event-card-title">{{ $event->{'title_' . $lang} }}</h3>
                    <div class="event-card-desc prose-content">{!! \App\Support\Content::format($event->{'description_' . $lang}) !!}</div>
                    <div class="event-card-meta">
                        <span>🕐 {{ $event->event_time }}</span>
                        <span>{{ $event->is_virtual ? '🌐' : '📍' }} {{ $event->{'location_' . $lang} }}</span>
                        @if ($event->capacity)
                            <span>👥 {{ $event->registered_count }}/{{ $event->capacity }}</span>
                        @endif
                    </div>
                    @if ($event->registration_link)
                        <a href="{{ $event->registration_link }}" target="_blank" class="btn btn-primary btn-full mt-4" onclick="event.stopPropagation()">
                            {{ $lang === 'en' ? 'Register Now' : 'سجّل الآن' }}
                        </a>
                    @endif
                </div>
            @empty
                <p class="empty-state col-span-full">{{ $lang === 'en' ? 'No events scheduled.' : 'لا توجد فعاليات مجدولة.' }}</p>
            @endforelse
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
document.querySelectorAll('.filter-tab').forEach(btn => {
    btn.addEventListener('click', () => {
        document.querySelectorAll('.filter-tab').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        const filter = btn.dataset.filter;
        document.querySelectorAll('.event-card').forEach(card => {
            card.style.display = (filter === 'all' || card.dataset.type === filter) ? '' : 'none';
        });
    });
});
</script>
@endpush
