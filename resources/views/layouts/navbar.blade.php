@php
    $lang = session('lang', 'en');
    $isRTL = $lang === 'ar';
    $currentRoute = request()->path();

    $navLinks = [
        ['en' => 'Home',    'ar' => 'الرئيسية',  'path' => '/'],
        ['en' => 'About',   'ar' => 'عن وثبة',   'path' => '/about'],
        [
            'en' => 'Wathba Components', 'ar' => 'مكونات وثبة', 'path' => '#',
            'children' => [
                ['en' => 'Accelerator',          'ar' => 'المسرعة',                    'path' => '/accelerator'],
                ['en' => 'Angel Network (YAIN)', 'ar' => 'شبكة المستثمرين',            'path' => '/yain'],
                ['en' => 'Impact Fund (WIIF)',   'ar' => 'صندوق الاستثمار',            'path' => '/wiif'],
                ['en' => 'Social Innovation Lab','ar' => 'مختبر الابتكار الاجتماعي',  'path' => '/sil'],
            ]
        ],
        [
            'en' => 'Info Center', 'ar' => 'مركز المعلومات', 'path' => '#',
            'children' => [
                ['en' => 'Library',      'ar' => 'المكتبة',           'path' => '/library'],
                ['en' => 'Blog',         'ar' => 'المدونة',           'path' => '/blog'],
                ['en' => 'Events',       'ar' => 'الفعاليات',         'path' => '/events'],
                ['en' => 'News & Media', 'ar' => 'الأخبار والوسائط', 'path' => '/media'],
            ]
        ],
        ['en' => 'Contact Us', 'ar' => 'تواصل معنا', 'path' => '/contact'],
    ];
@endphp

<nav class="navbar" id="mainNav">
    <div class="container">
        <div class="navbar-inner">

            {{-- Logo --}}
            <a href="/" class="navbar-brand">
                <img style="height: 110px" src="{{ asset('images/wathba.png') }}" alt="Wathba | وثبة" class="navbar-logo-img-lg">
            </a>

            {{-- Desktop Nav — horizontal --}}
            <ul class="nav-links">
                @foreach ($navLinks as $link)
                    @if (isset($link['children']))
                        <li class="nav-item has-dropdown">
                            <button class="nav-link dropdown-toggle">
                                {{ $link[$lang] }}
                                <svg class="chevron" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            <ul class="dropdown-menu">
                                @foreach ($link['children'] as $child)
                                    <li>
                                        <a href="{{ $child['path'] }}"
                                           class="dropdown-item {{ '/' . $currentRoute === $child['path'] ? 'active' : '' }}">
                                            {{ $child[$lang] }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a href="{{ $link['path'] }}"
                               class="nav-link {{ ('/' . $currentRoute === $link['path'] || ($link['path'] === '/' && $currentRoute === '')) ? 'active' : '' }}">
                                {{ $link[$lang] }}
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>

            {{-- Actions --}}
            <div class="navbar-actions">
                <form action="/lang" method="POST" class="inline">
                    @csrf
                    <input type="hidden" name="lang" value="{{ $lang === 'en' ? 'ar' : 'en' }}">
                    <button type="submit" class="btn-lang">
                        🌐 {{ $lang === 'en' ? 'العربية' : 'English' }}
                    </button>
                </form>
                <button class="hamburger" id="mobileMenuToggle" aria-label="Toggle menu">
                    <span></span><span></span><span></span>
                </button>
            </div>
        </div>

        {{-- Mobile Menu --}}
        <div class="mobile-menu hidden" id="mobileMenu">
            @foreach ($navLinks as $link)
                @if (isset($link['children']))
                    <div class="mobile-group">
                        <div class="mobile-group-label">{{ $link[$lang] }}</div>
                        @foreach ($link['children'] as $child)
                            <a href="{{ $child['path'] }}" class="mobile-link">{{ $child[$lang] }}</a>
                        @endforeach
                    </div>
                @else
                    <a href="{{ $link['path'] }}" class="mobile-link {{ ('/' . $currentRoute === $link['path']) ? 'active' : '' }}">
                        {{ $link[$lang] }}
                    </a>
                @endif
            @endforeach
        </div>
    </div>
</nav>
