<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>@yield('title', config('app.name', 'Laravel'))</title>
        <meta name="description" content="FixMate-style UI shell for Pak SMS Connect." />
        <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}" />
        <link rel="apple-touch-icon" sizes="192x192" href="{{ asset('images/icon-192.png') }}" />
        <link rel="manifest" href="{{ asset('manifest.webmanifest') }}" />

        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Sora:wght@500;600;700;800&display=swap" rel="stylesheet" />

        <link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ filemtime(public_path('css/app.css')) }}" />
        @stack('head')
        <script src="{{ asset('js/app.js') }}?v={{ filemtime(public_path('js/app.js')) }}" defer></script>
    </head>
    <body>
        <div class="fm-shell">
            <header class="fm-header" data-site-header>
                <div class="container fm-header-inner">
                    <a href="{{ route('home') }}" class="fm-brand">
                        <span class="fm-brand-logo">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon-18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m14.7 6.3 3 3"></path>
                                <path d="M15.5 2.75a2.121 2.121 0 1 1 3 3L7.5 16.75 3 18l1.25-4.5z"></path>
                                <path d="m16 7 1.5-1.5"></path>
                                <path d="m2 22 5-5"></path>
                            </svg>
                        </span>
                        <span class="fm-brand-text">FixMate</span>
                    </a>

                    <nav class="fm-nav" aria-label="Primary navigation">
                        <a href="{{ route('home') }}" class="fm-nav-link {{ request()->routeIs('home') ? 'is-active' : '' }}">Home</a>
                        <a href="{{ route('services.show') }}" class="fm-nav-link {{ request()->routeIs('services.*') ? 'is-active' : '' }}">Services</a>
                        <a href="{{ route('contact.show') }}" class="fm-nav-link {{ request()->routeIs('contact.*') ? 'is-active' : '' }}">Contact</a>
                        <a href="{{ route('terms.show') }}" class="fm-nav-link {{ request()->routeIs('terms.*') ? 'is-active' : '' }}">Terms</a>
                    </nav>

                    <div class="fm-actions">
                        @guest
                            <a href="{{ route('login') }}" class="btn btn-ghost btn-sm">Log in</a>
                            <a href="{{ route('contact.show') }}" class="btn btn-hero btn-sm">Book now</a>
                        @else
                            <a href="{{ route('dashboard') }}" class="btn btn-ghost btn-sm">Open app</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-hero btn-sm">Sign out</button>
                            </form>
                        @endguest
                    </div>

                    <button type="button" class="fm-mobile-toggle" data-nav-toggle aria-expanded="false" aria-controls="fm-mobile-menu">
                        <span class="sr-only">Toggle menu</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon-20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                            <line x1="4" y1="7" x2="20" y2="7"></line>
                            <line x1="4" y1="12" x2="20" y2="12"></line>
                            <line x1="4" y1="17" x2="20" y2="17"></line>
                        </svg>
                    </button>
                </div>

                <div class="fm-mobile-menu" data-mobile-menu id="fm-mobile-menu" hidden>
                    <div class="container fm-mobile-menu-inner">
                        <a href="{{ route('home') }}" class="fm-mobile-link {{ request()->routeIs('home') ? 'is-active' : '' }}">Home</a>
                        <a href="{{ route('services.show') }}" class="fm-mobile-link {{ request()->routeIs('services.*') ? 'is-active' : '' }}">Services</a>
                        <a href="{{ route('contact.show') }}" class="fm-mobile-link {{ request()->routeIs('contact.*') ? 'is-active' : '' }}">Contact</a>
                        <a href="{{ route('terms.show') }}" class="fm-mobile-link {{ request()->routeIs('terms.*') ? 'is-active' : '' }}">Terms</a>

                        <div class="fm-mobile-actions">
                            @guest
                                <a href="{{ route('login') }}" class="btn btn-ghost">Log in</a>
                                <a href="{{ route('contact.show') }}" class="btn btn-hero">Book now</a>
                            @else
                                <a href="{{ route('dashboard') }}" class="btn btn-ghost">Open app</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-hero">Sign out</button>
                                </form>
                            @endguest
                        </div>
                    </div>
                </div>
            </header>

            <main class="fm-main">
                @yield('content')
            </main>

            <footer class="fm-footer">
                <div class="container fm-footer-grid">
                    <div class="fm-footer-brand-block">
                        <a href="{{ route('home') }}" class="fm-brand">
                            <span class="fm-brand-logo">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon-18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m14.7 6.3 3 3"></path>
                                    <path d="M15.5 2.75a2.121 2.121 0 1 1 3 3L7.5 16.75 3 18l1.25-4.5z"></path>
                                    <path d="m16 7 1.5-1.5"></path>
                                    <path d="m2 22 5-5"></path>
                                </svg>
                            </span>
                            <span class="fm-brand-text">FixMate</span>
                        </a>
                        <p class="fm-footer-copy">
                            Vetted, certified home service professionals - plumbing, AC, electrical, cleaning and more. Backed by a 90-day guarantee.
                        </p>
                    </div>

                    <div>
                        <h4 class="fm-footer-title">Services</h4>
                        <a href="{{ route('services.show') }}" class="fm-footer-link">Plumbing</a>
                        <a href="{{ route('services.show') }}" class="fm-footer-link">AC & Cooling</a>
                        <a href="{{ route('services.show') }}" class="fm-footer-link">Electrical</a>
                        <a href="{{ route('services.show') }}" class="fm-footer-link">Home Cleaning</a>
                        <a href="{{ route('services.show') }}" class="fm-footer-link">All services</a>
                    </div>

                    <div>
                        <h4 class="fm-footer-title">Company</h4>
                        <a href="{{ route('contact.show') }}" class="fm-footer-link">Contact</a>
                        <a href="{{ route('login') }}" class="fm-footer-link">Log in</a>
                        <a href="{{ route('terms.show') }}" class="fm-footer-link">Terms & Conditions</a>
                        <a href="{{ route('terms.show') }}#privacy" class="fm-footer-link">Privacy</a>
                    </div>

                    <div>
                        <h4 class="fm-footer-title">Follow</h4>
                        <div class="fm-social-row">
                            <a href="#" aria-label="Facebook" class="fm-social-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon-18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
                            </a>
                            <a href="#" aria-label="Instagram" class="fm-social-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon-18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="m16 11.37a4 4 0 1 1-7.75 1.26 4 4 0 0 1 7.75-1.26z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                            </a>
                            <a href="#" aria-label="Twitter" class="fm-social-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon-18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53A4.48 4.48 0 0 0 12 7.86v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="fm-footer-bottom">
                    <div class="container fm-footer-bottom-inner">
                        <p>&copy; {{ now()->year }} FixMate. All rights reserved.</p>
                        <p>Trusted home services, on demand.</p>
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>

