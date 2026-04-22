@extends('layouts.app')
@section('title', $lang === 'ar' ? 'المكتبة' : 'Library')

@section('content')

<section class="page-hero" style="background-color:#524037;">
    <div class="container">
        <h1 class="page-hero-title">{{ $lang === 'en' ? 'Library' : 'المكتبة' }}</h1>
        <p class="page-hero-subtitle">{{ $lang === 'en' ? 'Documents, images, and videos from Wathba.' : 'وثائق وصور ومقاطع فيديو من وثبة.' }}</p>
    </div>
</section>

<section class="section">
    <div class="container">
        {{-- Filter --}}
        <div class="filter-tabs" id="libFilters">
            <button class="filter-tab active" data-filter="all">{{ $lang === 'en' ? 'All' : 'الكل' }}</button>
            <button class="filter-tab" data-filter="document">📄 {{ $lang === 'en' ? 'Documents' : 'وثائق' }}</button>
            <button class="filter-tab" data-filter="image">🖼 {{ $lang === 'en' ? 'Images' : 'صور' }}</button>
            <button class="filter-tab" data-filter="video">🎬 {{ $lang === 'en' ? 'Videos' : 'فيديو' }}</button>
        </div>

        {{-- Search --}}
        <div class="search-wrap mt-6 mb-8">
            <input type="text" id="libSearch" placeholder="{{ $lang === 'en' ? 'Search...' : 'بحث...' }}" class="search-input">
        </div>

        <div class="library-grid" id="libraryGrid">
            @forelse ($items as $item)
                @php $isYoutube = str_contains($item->url ?? '', 'youtube.com/embed'); @endphp
                <div class="library-card" data-type="{{ $item->type }}" data-title="{{ strtolower($item->{'title_' . $lang}) }}">
                    {{-- YouTube embed --}}
                    @if($isYoutube)
                    <div class="library-video-wrap">
                        <iframe src="{{ $item->url }}" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen class="library-video-iframe"></iframe>
                    </div>
                    @else
                    <div class="library-card-icon">
                        @if ($item->type === 'document') 📄
                        @elseif ($item->type === 'image') 🖼
                        @else 🎬
                        @endif
                    </div>
                    @endif
                    <div class="library-card-body">
                        <h3 class="library-title">{{ $item->{'title_' . $lang} }}</h3>
                        <p class="library-desc line-clamp-3">{{ $item->{'description_' . $lang} }}</p>
                        <div class="library-meta">
                            <span>📅 {{ \Carbon\Carbon::parse($item->file_date)->format('d M Y') }}</span>
                            @if ($item->size) <span>💾 {{ $item->size }}</span> @endif
                        </div>
                    </div>
                    @if(!$isYoutube)
                    <a href="{{ $item->url }}" target="_blank" class="btn btn-outline btn-sm">
                        {{ $item->type === 'document' ? ($lang === 'en' ? '⬇ Download' : '⬇ تنزيل') : ($lang === 'en' ? '👁 View' : '👁 عرض') }}
                    </a>
                    @endif
                </div>
            @empty
                <p class="empty-state col-span-full">{{ $lang === 'en' ? 'No items in the library.' : 'لا توجد عناصر في المكتبة.' }}</p>
            @endforelse
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
// Filter by type
document.querySelectorAll('#libFilters .filter-tab').forEach(btn => {
    btn.addEventListener('click', () => {
        document.querySelectorAll('#libFilters .filter-tab').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        const filter = btn.dataset.filter;
        filterLibrary();
    });
});
// Search
document.getElementById('libSearch').addEventListener('input', filterLibrary);
function filterLibrary() {
    const filter = document.querySelector('#libFilters .filter-tab.active').dataset.filter;
    const search = document.getElementById('libSearch').value.toLowerCase();
    document.querySelectorAll('.library-card').forEach(card => {
        const typeMatch = filter === 'all' || card.dataset.type === filter;
        const searchMatch = card.dataset.title.includes(search);
        card.style.display = (typeMatch && searchMatch) ? '' : 'none';
    });
}
</script>
@endpush
