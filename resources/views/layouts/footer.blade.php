
<footer class="footer">
    <div class="container">
        <div class="footer-grid">

            {{-- Brand --}}
            <div class="footer-brand">
                <div class="footer-logo">
                    <span class="logo-arabic">وثبة</span>
                    <span class="logo-english">wathba</span>
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
                    <li><a href="/contact">{{ $lang === 'en' ? 'Contact Us' : 'تواصل معنا' }}</a></li>
                </ul>
            </div>

            {{-- Programs --}}
            <div class="footer-col">
                <h4 class="footer-heading">{{ $lang === 'en' ? 'Our Programs' : 'برامجنا' }}</h4>
                <ul class="footer-links">
                    <li><a href="/accelerator">{{ $lang === 'en' ? 'Wathba Accelerator' : 'مسرعة وثبة' }}</a></li>
                    <li><a href="/yain">{{ $lang === 'en' ? 'Angel Network (YAIN)' : 'شبكة الملائكيين' }}</a></li>
                    <li><a href="/wiif">{{ $lang === 'en' ? 'Impact Fund (WIIF)' : 'صندوق الاستثمار' }}</a></li>
                    <li><a href="/sil">{{ $lang === 'en' ? 'Social Innovation Lab' : 'مختبر الابتكار' }}</a></li>
                    <li><a href="/events">{{ $lang === 'en' ? 'Events' : 'الفعاليات' }}</a></li>
                </ul>
            </div>

            {{-- Contact --}}
            <div class="footer-col">
                <h4 class="footer-heading">{{ $lang === 'en' ? 'Contact Us' : 'تواصل معنا' }}</h4>
                <ul class="footer-contact-list">
                    <li>
                        <span class="contact-icon">📍</span>
                        <span>{{ $lang === 'en' ? 'Hadda Street, Sanaa, Yemen' : 'شارع حدة، صنعاء، اليمن' }}</span>
                    </li>
                    <li>
                        <span class="contact-icon">📞</span>
                        <a href="tel:+96712345679">+967 1 234 567</a>
                    </li>
                    <li>
                        <span class="contact-icon">✉️</span>
                        <a href="mailto:info@wathba.ye">info@wathba.ye</a>
                    </li>
                </ul>

                <div class="eu-badge">
                    <p class="eu-label">{{ $lang === 'en' ? 'Funded by the European Union' : 'بتمويل من الاتحاد الأوروبي' }}</p>
                    <div class="eu-flag">★ ★ ★</div>
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
