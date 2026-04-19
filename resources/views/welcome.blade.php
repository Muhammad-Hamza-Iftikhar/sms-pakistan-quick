@extends('layouts.app')

@section('title', 'FixMate | Home Services')

@section('content')
    <section class="home-hero">
        <div class="home-hero-overlay"></div>
        <div class="home-hero-glow"></div>

        <div class="container home-hero-grid">
            <div class="home-hero-copy">
                <span class="home-pill">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon-14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="m12 3-1.9 5.8H4.2L9 12.2 7.1 18 12 14.6 16.9 18 15 12.2 19.8 8.8h-5.9z"></path>
                    </svg>
                    Trusted home services, on demand
                </span>

                <h1 class="home-title">
                    Plumber, AC, electrician.
                    <span class="text-gradient">All in one tap.</span>
                </h1>

                <p class="home-subtitle">
                    Book vetted, certified professionals for every home service - plumbing, AC, electrical,
                    cleaning, carpentry and more. Fixed prices, same-day slots, 90-day guarantee.
                </p>

                <div class="home-hero-actions">
                    <a href="{{ route('contact.show') }}" class="btn btn-hero btn-xl">
                        Book a service
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon-16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                    </a>
                    <a href="{{ route('services.show') }}" class="btn btn-outline btn-xl">Browse all services</a>
                </div>

                <div class="home-reviews-row">
                    <div class="home-avatar-stack">
                        <span></span><span></span><span></span><span></span>
                    </div>
                    <div class="home-stars-wrap">
                        <span class="home-stars" aria-label="5 stars">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon-14" viewBox="0 0 24 24" fill="currentColor"><path d="m12 2.6 2.74 5.54 6.11.9-4.42 4.31 1.04 6.09L12 16.56 6.53 19.44l1.04-6.09-4.42-4.31 6.11-.9z"/></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon-14" viewBox="0 0 24 24" fill="currentColor"><path d="m12 2.6 2.74 5.54 6.11.9-4.42 4.31 1.04 6.09L12 16.56 6.53 19.44l1.04-6.09-4.42-4.31 6.11-.9z"/></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon-14" viewBox="0 0 24 24" fill="currentColor"><path d="m12 2.6 2.74 5.54 6.11.9-4.42 4.31 1.04 6.09L12 16.56 6.53 19.44l1.04-6.09-4.42-4.31 6.11-.9z"/></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon-14" viewBox="0 0 24 24" fill="currentColor"><path d="m12 2.6 2.74 5.54 6.11.9-4.42 4.31 1.04 6.09L12 16.56 6.53 19.44l1.04-6.09-4.42-4.31 6.11-.9z"/></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon-14" viewBox="0 0 24 24" fill="currentColor"><path d="m12 2.6 2.74 5.54 6.11.9-4.42 4.31 1.04 6.09L12 16.56 6.53 19.44l1.04-6.09-4.42-4.31 6.11-.9z"/></svg>
                        </span>
                        <span class="home-rating"><strong>4.9</strong> - 12,400 reviews</span>
                    </div>
                </div>
            </div>

            <div class="home-hero-media">
                <div class="home-hero-media-glow"></div>
                <img
                    src="{{ asset('images/hero-certify.jpg') }}"
                    alt="FixMate certified home service professionals"
                    width="1536"
                    height="1024"
                    class="home-hero-image"
                />

                <div class="home-floating-card">
                    <div class="home-floating-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon-18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 3 5 6v6c0 5 3.5 8.5 7 10 3.5-1.5 7-5 7-10V6z"></path>
                            <path d="m9 12 2 2 4-4"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="home-floating-title">90-day guarantee</p>
                        <p class="home-floating-copy">On every workmanship job</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container home-stats-section">
        <div class="home-stats-grid">
            <article class="home-stat-card">
                <p class="home-stat-value text-gradient">8+</p>
                <p class="home-stat-label">Service categories</p>
            </article>
            <article class="home-stat-card">
                <p class="home-stat-value text-gradient">120k</p>
                <p class="home-stat-label">Jobs completed</p>
            </article>
            <article class="home-stat-card">
                <p class="home-stat-value text-gradient">30 min</p>
                <p class="home-stat-label">Average response</p>
            </article>
            <article class="home-stat-card">
                <p class="home-stat-value text-gradient">4.9</p>
                <p class="home-stat-label">Customer rating</p>
            </article>
        </div>
    </section>

    <section class="container home-steps-section">
        <div class="home-section-head center">
            <p class="home-kicker">How it works</p>
            <h2>Book in minutes. Fixed today.</h2>
            <p>No phone tag, no surprise bills. Just a vetted pro at your door, on time, with a fixed quote.</p>
        </div>

        <div class="home-steps-grid">
            <article class="home-step-card">
                <span class="home-step-num">01</span>
                <h3>Pick a service</h3>
                <p>Plumber, AC, electrician, cleaner, painter - pick what you need today.</p>
            </article>
            <article class="home-step-card">
                <span class="home-step-num">02</span>
                <h3>Book a slot</h3>
                <p>Choose a time that suits you. Same-day slots are usually available.</p>
            </article>
            <article class="home-step-card">
                <span class="home-step-num">03</span>
                <h3>We arrive on time</h3>
                <p>A vetted, uniformed pro shows up with a stocked van and a fixed quote.</p>
            </article>
            <article class="home-step-card">
                <span class="home-step-num">04</span>
                <h3>Job done, guaranteed</h3>
                <p>Pay only when you're happy. Every job is covered by a 90-day workmanship guarantee.</p>
            </article>
        </div>
    </section>

    <section id="services" class="home-services-band">
        <div class="container">
            <div class="home-services-head">
                <div>
                    <p class="home-kicker">Our services</p>
                    <h2>Every home service. One trusted team.</h2>
                </div>
                <a href="{{ route('services.show') }}" class="btn btn-ghost btn-sm">
                    Read all guides
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon-16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                </a>
            </div>

            <div class="home-services-grid">
                <article class="home-service-card">
                    <div class="home-service-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon-18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m14.7 6.3 3 3"></path><path d="M15.5 2.75a2.121 2.121 0 1 1 3 3L7.5 16.75 3 18l1.25-4.5z"></path><path d="m16 7 1.5-1.5"></path><path d="m2 22 5-5"></path></svg>
                    </div>
                    <h3>Plumbing</h3>
                    <p>Leaks, blockages, water heaters and full bathroom fit-outs.</p>
                </article>
                <article class="home-service-card">
                    <div class="home-service-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon-18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v20"></path><path d="M4.93 4.93 19.07 19.07"></path><path d="M2 12h20"></path><path d="M4.93 19.07 19.07 4.93"></path></svg>
                    </div>
                    <h3>AC & Cooling</h3>
                    <p>Service, gas refill, repair and new installations.</p>
                </article>
                <article class="home-service-card">
                    <div class="home-service-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon-18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M13 2 4 14h7l-1 8 9-12h-7z"></path></svg>
                    </div>
                    <h3>Electrical</h3>
                    <p>Sockets, switchboards, fans, lighting and rewiring.</p>
                </article>
                <article class="home-service-card">
                    <div class="home-service-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon-18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m3 22 4-4"></path><path d="M17 2a5 5 0 0 1 5 5c0 4-4 8-9 8s-9 4-9 9"></path><path d="M14 9l1 1"></path></svg>
                    </div>
                    <h3>Home Cleaning</h3>
                    <p>Deep cleans, weekly refreshes and move-out cleans.</p>
                </article>
                <article class="home-service-card">
                    <div class="home-service-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon-18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 5 3 16l2 2L16 7z"></path><path d="M16 7l1.5-1.5a2.121 2.121 0 1 1 3 3L19 10"></path><path d="m2 22 3-3"></path></svg>
                    </div>
                    <h3>Carpentry</h3>
                    <p>Door repairs, custom shelving and furniture assembly.</p>
                </article>
                <article class="home-service-card">
                    <div class="home-service-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon-18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 3v18"></path><path d="M3 12h18"></path><path d="M5 5l14 14"></path></svg>
                    </div>
                    <h3>Painting</h3>
                    <p>Interior, exterior, texture and waterproofing.</p>
                </article>
                <article class="home-service-card">
                    <div class="home-service-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon-18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 3 5 6v6c0 5 3.5 8.5 7 10 3.5-1.5 7-5 7-10V6z"></path><path d="m9 12 2 2 4-4"></path></svg>
                    </div>
                    <h3>Pest Control</h3>
                    <p>Cockroaches, termites, bed bugs and mosquitoes.</p>
                </article>
                <article class="home-service-card">
                    <div class="home-service-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon-18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="16" rx="2"></rect><circle cx="8" cy="12" r="2"></circle><path d="M14 8h4"></path><path d="M14 12h4"></path><path d="M14 16h4"></path></svg>
                    </div>
                    <h3>Appliance Repair</h3>
                    <p>Washing machines, fridges, microwaves and geysers.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="container home-why-section">
        <div class="home-why-copy">
            <p class="home-kicker">Why FixMate</p>
            <h2>The home services brand your neighbours already trust.</h2>
            <p>
                Every FixMate professional is background-verified, trade-certified and insured. Your booking is
                backed by transparent, fixed pricing and a 90-day workmanship guarantee - so you only pay
                once the job is done right.
            </p>

            <ul class="home-why-list">
                <li>
                    <span class="why-check"><svg xmlns="http://www.w3.org/2000/svg" class="icon-14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"></circle><path d="m8.5 12 2.2 2.2 4.8-4.8"></path></svg></span>
                    Background-verified, trade-certified pros
                </li>
                <li>
                    <span class="why-check"><svg xmlns="http://www.w3.org/2000/svg" class="icon-14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"></circle><path d="m8.5 12 2.2 2.2 4.8-4.8"></path></svg></span>
                    Transparent fixed pricing - no surprises
                </li>
                <li>
                    <span class="why-check"><svg xmlns="http://www.w3.org/2000/svg" class="icon-14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"></circle><path d="m8.5 12 2.2 2.2 4.8-4.8"></path></svg></span>
                    Same-day slots, 7 days a week
                </li>
                <li>
                    <span class="why-check"><svg xmlns="http://www.w3.org/2000/svg" class="icon-14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"></circle><path d="m8.5 12 2.2 2.2 4.8-4.8"></path></svg></span>
                    90-day workmanship guarantee on every job
                </li>
            </ul>
        </div>

        <aside class="home-why-card">
            <h3>Backed by our guarantee</h3>
            <p>
                If anything goes wrong within 90 days of a workmanship job, we come back and put it right -
                free of charge. That's the FixMate promise.
            </p>

            <div class="home-why-metrics">
                <div><p>Avg. arrival</p><strong>30 min</strong></div>
                <div><p>Open</p><strong>7 days/wk</strong></div>
                <div><p>Guarantee</p><strong>90 days</strong></div>
            </div>
        </aside>
    </section>

    <section class="container home-cta-section">
        <div class="home-cta-card">
            <div class="home-cta-spotlight"></div>
            <div class="home-cta-content">
                <h2>Need a fix today?</h2>
                <p>Book a vetted pro in under a minute. Most jobs done the same day.</p>
                <div class="home-cta-actions">
                    <a href="{{ route('contact.show') }}" class="btn btn-accent btn-xl">
                        Book a service
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon-16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                    </a>
                    <a href="{{ route('contact.show') }}" class="btn btn-outline btn-xl btn-outline-light">Talk to us</a>
                </div>
            </div>
        </div>
    </section>
@endsection

