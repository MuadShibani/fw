
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
                    <a href="https://www.facebook.com/deeprootyemen" target="_blank" rel="noopener" aria-label="Facebook" class="social-icon">f</a>
                    <a href="https://x.com/deeprootyemen" target="_blank" rel="noopener" aria-label="X" class="social-icon">𝕏</a>
                    <a href="https://www.linkedin.com/company/deeproot-consulting" target="_blank" rel="noopener" aria-label="LinkedIn" class="social-icon">in</a>
                    <a href="https://whatsapp.com/channel/0029VbBoLaW2kNFoiR4RDv3K" target="_blank" rel="noopener" aria-label="WhatsApp" class="social-icon social-icon-wa">
                        <svg viewBox="0 0 24 24" width="14" height="14" fill="currentColor" aria-hidden="true">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.247-.694.247-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                    </a>
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
