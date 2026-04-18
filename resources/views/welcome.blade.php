@extends('layouts.app')

@section('title', 'Pak SMS Connect')

@section('content')
    <div class="landing-page">
        <header class="container site-header">
            <a href="{{ url('/') }}" class="brand">
                <span class="brand-badge">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-circle icon-20">
                        <path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z"></path>
                    </svg>
                </span>
                <span class="brand-name">Pak SMS Connect</span>
            </a>

            <nav class="nav-actions">
                <button type="button" data-install-app class="btn btn-outline">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-download icon-16">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                        <polyline points="7 10 12 15 17 10"></polyline>
                        <line x1="12" x2="12" y1="15" y2="3"></line>
                    </svg>
                    Install app
                </button>

                <a href="{{ route('login') }}" class="btn btn-ghost">Sign in</a>
                <a href="{{ route('login') }}" class="btn btn-primary">Get started</a>
            </nav>
        </header>

        <main>
            <section class="container hero-section">
                <div>
                    <span class="hero-badge">
                        <span class="hero-badge-dot"></span>
                        Made for Pakistan 🇵🇰
                    </span>

                    <h1 class="hero-title">
                        Send SMS to any
                        <span class="hero-highlight">Pakistani number</span>
                        in one tap.
                    </h1>

                    <p class="hero-subtitle">
                        A clean, installable web app for officials and businesses. Validates +92 numbers and opens your SMS app pre-filled.
                    </p>

                    <div class="hero-actions">
                        <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Open the app</a>
                        <a href="#features" class="btn btn-outline btn-lg">Learn more</a>
                    </div>
                </div>

                <div class="phone-preview-wrap">
                    <div class="phone-glow"></div>
                    <div class="phone-preview">
                        <div class="phone-notch"></div>

                        <div class="phone-bubble phone-bubble-secondary">
                            <p class="phone-bubble-label">To</p>
                            <p class="phone-bubble-text">+92 300 1234567</p>
                        </div>

                        <div class="phone-bubble phone-bubble-primary">
                            <p class="phone-bubble-label" style="color: rgba(245, 255, 248, 0.82);">Message</p>
                            <p class="phone-bubble-text" style="font-weight: 500;">Assalam o Alaikum, your application has been received.</p>
                        </div>

                        <div class="phone-send">Send SMS</div>
                    </div>
                </div>
            </section>

            <section id="features" class="container features-section">
                <div class="section-header">
                    <h2 class="section-title">Built for daily use</h2>
                    <p class="section-copy">Everything an official needs to dispatch SMS quickly.</p>
                </div>

                <div class="feature-grid">
                    <article class="feature-card">
                        <div class="feature-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="icon-20">
                                <rect x="7" y="2" width="10" height="20" rx="2"></rect>
                                <circle cx="12" cy="18" r="1"></circle>
                            </svg>
                        </div>
                        <h3 class="feature-title">PK number validation</h3>
                        <p class="feature-text">Enforces +92 format and 10-digit local part automatically.</p>
                    </article>

                    <article class="feature-card">
                        <div class="feature-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="icon-20">
                                <path d="M13 2 4 14h7l-1 8 9-12h-7z"></path>
                            </svg>
                        </div>
                        <h3 class="feature-title">One-tap send</h3>
                        <p class="feature-text">Opens the native SMS app with the message pre-filled.</p>
                    </article>

                    <article class="feature-card">
                        <div class="feature-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="icon-20">
                                <path d="M12 3 5 6v6c0 5 3.5 8.5 7 10 3.5-1.5 7-5 7-10V6z"></path>
                                <path d="m9 12 2 2 4-4"></path>
                            </svg>
                        </div>
                        <h3 class="feature-title">Private by design</h3>
                        <p class="feature-text">Nothing leaves your device, no servers and no message logs.</p>
                    </article>
                </div>
            </section>
        </main>

        <footer class="container site-footer">
            &copy; {{ now()->year }} Pak SMS Connect. Built for officials in Pakistan.
        </footer>
    </div>
@endsection
