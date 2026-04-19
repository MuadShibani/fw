@php $lang = session('lang', 'en'); @endphp

<footer class="footer">
    <div class="container">
        <div class="footer-grid">

            {{-- Brand --}}
            <div class="footer-brand">
                <div class="footer-logo-wrap">
                    <img src="{{ asset('images/logo-wathba.jpg') }}" alt="Wathba" class="footer-logo-img">
                </div>
                <p class="footer-tagline">
                    {{ $lang === 'en'
                        ? "Strengthening the foundations of Yemen's entrepreneurial ecosystem to drive economic recovery and growth."
                        : 'تعزيز أسس منظومة ريادة الأعمال في اليمن لدفع التعافي الاقتصادي والنمو.' }}
                </p>
                <div class="footer-social">
                    <a href="#" aria-label="Facebook" class="social-icon">f</a>
                    <a href="#" aria-label="Twitter" class="social-icon">t</a>
                    <a href="#" aria-label="LinkedIn" class="social-icon">in</a>
                    <a href="#" aria-label="Instagram" class="social-icon">ig</a>
                </div>
            </div>

            {{-- Quick Links --}}
            <div class="footer-col">
                <h4 class="footer-heading">{{ $lang === 'en' ? 'Quick Links' : 'روابط سريعة' }}</h4>
                <ul class="footer-links">
                    <li><a href="/">{{ $lang === 'en' ? 'Home' : 'الرئيسية' }}</a></li>
                    <li><a href="/about">{{ $lang === 'en' ? 'About' : 'عن وثبة' }}</a></li>
                    <li><a href="/accelerator">{{ $lang === 'en' ? 'Accelerator' : 'المسرعة' }}</a></li>
                    <li><a href="/yain">{{ $lang === 'en' ? 'YAIN' : 'شبكة المستثمرين' }}</a></li>
                    <li><a href="/wiif">{{ $lang === 'en' ? 'WIIF' : 'صندوق الاستثمار' }}</a></li>
                    <li><a href="/sil">{{ $lang === 'en' ? 'Social Innovation Lab' : 'مختبر الابتكار' }}</a></li>
                    <li><a href="/contact">{{ $lang === 'en' ? 'Contact Us' : 'تواصل معنا' }}</a></li>
                </ul>
            </div>

            {{-- Contact --}}
            <div class="footer-col">
                <h4 class="footer-heading">{{ $lang === 'en' ? 'Contact Us' : 'تواصل معنا' }}</h4>
                <ul class="footer-contact-list">
                    <li>
                        <span class="contact-icon">📍</span>
                        <span>{{ $lang === 'en' ? 'Inma - Aden, Yemen' : 'إنما - عدن، اليمن' }}</span>
                    </li>
                    <li>
                        <span class="contact-icon">✉️</span>
                        <a href="mailto:wathba@deeproot.consulting">wathba@deeproot.consulting</a>
                    </li>
                    <li>
                        <span class="contact-icon">🕐</span>
                        <span>{{ $lang === 'en' ? 'Sun – Thu: 9:00 AM – 5:00 PM' : 'الأحد – الخميس: 9:00 صباحاً – 5:00 مساءً' }}</span>
                    </li>
                </ul>
            </div>

            {{-- Partners --}}
            <div class="footer-col">
                <h4 class="footer-heading">{{ $lang === 'en' ? 'Funded & Implemented By' : 'بتمويل وتنفيذ' }}</h4>
                <div class="footer-partners-row">
                    <div class="partner-logo-wrap partner-logo-eu">
                        <img src="{{ asset('images/logo-eu.png') }}" alt="Funded by the European Union" class="partner-logo-eu-img">
                    </div>
                    <div class="partner-logo-wrap partner-logo-light">
                        <img src="{{ asset('images/logo-rowad.jpg') }}" alt="Rowad Foundation" class="partner-logo-sm">
                    </div>
                    <div class="partner-logo-wrap partner-logo-light">
                        <img src="{{ asset('images/logo-deeproot.png') }}" alt="DeepRoot Consulting" class="partner-logo-sm">
                    </div>
                </div>
            </div>

        </div>

        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} Wathba. {{ $lang === 'en' ? 'All Rights Reserved.' : 'جميع الحقوق محفوظة.' }}</p>
            <div class="footer-bottom-links">
                <a href="#">{{ $lang === 'en' ? 'Privacy Policy' : 'سياسة الخصوصية' }}</a>
                <a href="#">{{ $lang === 'en' ? 'Terms of Service' : 'شروط الخدمة' }}</a>
            </div>
        </div>
    </div>
</footer>
