@extends('layouts.app')
@section('title', $lang === 'ar' ? 'تواصل معنا' : 'Contact Us')

@section('content')

<section class="page-hero" style="background-color:#524037;">
    <div class="container">
        <h1 class="page-hero-title">{{ $lang === 'en' ? 'Contact Us' : 'تواصل معنا' }}</h1>
        <p class="page-hero-subtitle">{{ $lang === 'en' ? 'We\'d love to hear from you.' : 'يسعدنا أن نسمع منك.' }}</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="contact-layout">

            {{-- Form --}}
            <div class="contact-form-wrap">
                <h2 class="section-title mb-6">{{ $lang === 'en' ? 'Send a Message' : 'أرسل رسالة' }}</h2>

                @if (session('success'))
                    <div class="alert alert-success mb-6">
                        ✅ {{ $lang === 'en' ? 'Your message has been sent successfully!' : 'تم إرسال رسالتك بنجاح!' }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-error mb-6">
                        <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                    </div>
                @endif

                <form action="/contact" method="POST" class="contact-form">
                    @csrf
                    <div class="form-row">
                        <div class="form-group">
                            <label for="first_name">{{ $lang === 'en' ? 'First Name' : 'الاسم الأول' }} *</label>
                            <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}"
                                   class="form-input @error('first_name') is-invalid @enderror" required>
                            @error('first_name')<span class="form-error">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label for="last_name">{{ $lang === 'en' ? 'Last Name' : 'اسم العائلة' }} *</label>
                            <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}"
                                   class="form-input @error('last_name') is-invalid @enderror" required>
                            @error('last_name')<span class="form-error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">{{ $lang === 'en' ? 'Email Address' : 'البريد الإلكتروني' }} *</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                               class="form-input @error('email') is-invalid @enderror" required>
                        @error('email')<span class="form-error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="message">{{ $lang === 'en' ? 'Message' : 'الرسالة' }} *</label>
                        <textarea id="message" name="message" rows="6"
                                  class="form-input @error('message') is-invalid @enderror" required>{{ old('message') }}</textarea>
                        @error('message')<span class="form-error">{{ $message }}</span>@enderror
                    </div>
                    <button type="submit" class="btn btn-primary btn-full">
                        {{ $lang === 'en' ? 'Send Message' : 'إرسال' }}
                    </button>
                </form>
            </div>

            {{-- Info --}}
            <div class="contact-info-wrap">
                <h2 class="section-title mb-6">{{ $lang === 'en' ? 'Get in Touch' : 'تواصل معنا' }}</h2>
                <div class="contact-info-list">
                    <div class="contact-info-item">
                        <div class="contact-info-icon">📍</div>
                        <div>
                            <h4>{{ $lang === 'en' ? 'Address' : 'العنوان' }}</h4>
                            <p>{{ $lang === 'en' ? 'Hadda Street, Sanaa, Yemen' : 'شارع حدة، صنعاء، اليمن' }}</p>
                        </div>
                    </div>
                    <div class="contact-info-item">
                        <div class="contact-info-icon">📞</div>
                        <div>
                            <h4>{{ $lang === 'en' ? 'Phone' : 'الهاتف' }}</h4>
                            <p><a href="tel:+96712345679">+967 1 234 567</a></p>
                        </div>
                    </div>
                    <div class="contact-info-item">
                        <div class="contact-info-icon">✉️</div>
                        <div>
                            <h4>{{ $lang === 'en' ? 'Email' : 'البريد الإلكتروني' }}</h4>
                            <p><a href="mailto:info@wathba.ye">info@wathba.ye</a></p>
                        </div>
                    </div>
                    <div class="contact-info-item">
                        <div class="contact-info-icon">🕐</div>
                        <div>
                            <h4>{{ $lang === 'en' ? 'Office Hours' : 'ساعات العمل' }}</h4>
                            <p>{{ $lang === 'en' ? 'Sun – Thu: 8:00 AM – 4:00 PM' : 'الأحد – الخميس: 8:00 صباحاً – 4:00 مساءً' }}</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
