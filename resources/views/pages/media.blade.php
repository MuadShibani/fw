@extends('layouts.app')
@section('title', $lang === 'ar' ? 'الأخبار والوسائط' : 'News & Media')

@section('content')

@include('partials.page-hero', ['fallbackBg' => '#524037'])

<section class="section">
    <div class="container">
        {{-- Category filter --}}
        <div class="filter-tabs" id="newsFilters">
            <button class="filter-tab active" data-filter="all">{{ $lang === 'en' ? 'All' : 'الكل' }}</button>
            @foreach ($categories as $cat)
                <button class="filter-tab" data-filter="{{ $cat }}">{{ $cat }}</button>
            @endforeach
        </div>

        <div class="news-grid mt-8" id="newsGrid">
            @forelse ($news as $item)
                <div class="news-card" data-category="{{ $item->category }}" style="cursor:pointer" onclick="window.location='/media'">
                    <div class="news-img-wrap">
                        <img src="{{ $item->{'image_' . $lang} ?? 'https://picsum.photos/400/250?random=' . $item->id }}"
                             alt="{{ $item->{'title_' . $lang} }}" class="news-img" loading="lazy">
                        <span class="news-badge">{{ $item->category }}</span>
                    </div>
                    <div class="news-body">
                        <p class="news-date">{{ \Carbon\Carbon::parse($item->date)->format('d M Y') }}</p>
                        <h3 class="news-title">{{ $item->{'title_' . $lang} }}</h3>
                        <p class="news-summary">{{ $item->{'summary_' . $lang} }}</p>
                    </div>
                </div>
            @empty
                <p class="empty-state col-span-full">{{ $lang === 'en' ? 'No news items.' : 'لا توجد أخبار.' }}</p>
            @endforelse
        </div>
        {{ $news->links('layouts.pagination') }}
    </div>
</section>
@endsection

@push('scripts')
<script>
document.querySelectorAll('#newsFilters .filter-tab').forEach(btn => {
    btn.addEventListener('click', () => {
        document.querySelectorAll('#newsFilters .filter-tab').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        const filter = btn.dataset.filter;
        document.querySelectorAll('.news-card').forEach(card => {
            card.style.display = (filter === 'all' || card.dataset.category === filter) ? '' : 'none';
        });
    });
});
</script>
@endpush
