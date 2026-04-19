@extends('layouts.app')

@section('title', 'Service Guides | FixMate')

@section('content')
    <section class="page-hero-subtle">
        <div class="container page-hero-subtle-inner max-3xl services-hero-inner">
            <p class="page-kicker">Service Guides</p>
            <h1 class="page-title-xl services-title">
                Know what we do.
                <span class="text-gradient">Book with confidence.</span>
            </h1>
            <p class="page-lead services-lead">
                Each guide explains exactly what's covered in a service - plumbing, AC, electrical,
                cleaning and more - what we check on the visit, and the guarantee that comes with
                every job.
            </p>

            <div class="services-search-wrap">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon-16 services-search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8"></circle>
                    <path d="m21 21-4.3-4.3"></path>
                </svg>
                <input
                    type="text"
                    class="field-input services-search-input"
                    data-service-search
                    placeholder="Search services, e.g. plumber, AC, painter..."
                    aria-label="Search services"
                />
            </div>

            <div class="services-chip-row">
                <button type="button" class="services-chip is-active" data-service-chip data-category="All">All</button>
                <button type="button" class="services-chip" data-service-chip data-category="Plumbing">Plumbing</button>
                <button type="button" class="services-chip" data-service-chip data-category="AC &amp; Cooling">AC &amp; Cooling</button>
                <button type="button" class="services-chip" data-service-chip data-category="Electrical">Electrical</button>
                <button type="button" class="services-chip" data-service-chip data-category="Cleaning">Cleaning</button>
                <button type="button" class="services-chip" data-service-chip data-category="Carpentry">Carpentry</button>
                <button type="button" class="services-chip" data-service-chip data-category="Painting">Painting</button>
                <button type="button" class="services-chip" data-service-chip data-category="Pest Control">Pest Control</button>
                <button type="button" class="services-chip" data-service-chip data-category="Appliance Repair">Appliance Repair</button>
            </div>
        </div>
    </section>

    <section class="container services-featured-section">
        <article
            class="services-featured-card"
            data-service-card
            data-service-featured="1"
            data-category="Plumbing"
            data-title="Plumbing Services: From Leaky Taps to Full Bathroom Fit-Outs"
            data-excerpt="What our certified plumbers handle every day - leaks, blockages, water heaters, fixtures - and the common signs that mean you should book a visit today."
            data-author="Ravi Sharma"
            data-date="April 12, 2026"
            data-read-time="6 min read"
        >
            <div>
                <div class="services-badge-row">
                    <span class="services-badge services-badge-solid">Featured</span>
                    <span class="services-badge">Plumbing</span>
                </div>
                <h2 class="services-featured-title">Plumbing Services: From Leaky Taps to Full Bathroom Fit-Outs</h2>
                <p class="services-featured-excerpt">
                    What our certified plumbers handle every day - leaks, blockages, water heaters, fixtures -
                    and the common signs that mean you should book a visit today.
                </p>
                <div class="services-meta-row">
                    <span>Ravi Sharma</span>
                    <span>&middot;</span>
                    <span>April 12, 2026</span>
                    <span>&middot;</span>
                    <span>6 min read</span>
                </div>
            </div>
            <a href="{{ route('services.show') }}" class="services-read-link">
                Read guide
                <svg xmlns="http://www.w3.org/2000/svg" class="icon-16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
            </a>
        </article>
    </section>

    <section class="container services-grid-section">
        <p class="services-empty hidden" data-services-empty>No services match your filters.</p>
        <div class="services-grid">
            <article
                class="services-guide-card"
                data-service-card
                data-category="AC &amp; Cooling"
                data-title="AC Service & Repair: Cool Rooms, Lower Bills, Longer Life"
                data-excerpt="Split, window, cassette and central units - how regular servicing keeps your AC efficient and what we check during every visit."
                data-author="Nadia Hassan"
                data-read-time="7 min read"
            >
                <span class="services-badge">AC &amp; Cooling</span>
                <h3>AC Service & Repair: Cool Rooms, Lower Bills, Longer Life</h3>
                <p>Split, window, cassette and central units - how regular servicing keeps your AC efficient and what we check during every visit.</p>
                <div class="services-meta-row">
                    <span>Nadia Hassan</span>
                    <span>7 min read</span>
                </div>
            </article>

            <article
                class="services-guide-card"
                data-service-card
                data-category="Electrical"
                data-title="Electrical Work: Safe Wiring, Smart Homes, Zero Compromises"
                data-excerpt="Sockets, switches, MCB upgrades, fan installation and full home rewiring - handled by licensed electricians who follow code, not shortcuts."
                data-author="Marcus Jensen"
                data-read-time="7 min read"
            >
                <span class="services-badge">Electrical</span>
                <h3>Electrical Work: Safe Wiring, Smart Homes, Zero Compromises</h3>
                <p>Sockets, switches, MCB upgrades, fan installation and full home rewiring - handled by licensed electricians who follow code, not shortcuts.</p>
                <div class="services-meta-row">
                    <span>Marcus Jensen</span>
                    <span>7 min read</span>
                </div>
            </article>

            <article
                class="services-guide-card"
                data-service-card
                data-category="Cleaning"
                data-title="Home Cleaning: Deep Cleans, Move-Outs and Weekly Refreshes"
                data-excerpt="Trained, vetted cleaners with their own equipment and eco-safe products. Here's exactly what's covered in each of our cleaning packages."
                data-author="Aisha Patel"
                data-read-time="6 min read"
            >
                <span class="services-badge">Cleaning</span>
                <h3>Home Cleaning: Deep Cleans, Move-Outs and Weekly Refreshes</h3>
                <p>Trained, vetted cleaners with their own equipment and eco-safe products. Here's exactly what's covered in each of our cleaning packages.</p>
                <div class="services-meta-row">
                    <span>Aisha Patel</span>
                    <span>6 min read</span>
                </div>
            </article>

            <article
                class="services-guide-card"
                data-service-card
                data-category="Carpentry"
                data-title="Carpentry &amp; Furniture Assembly: From Flat-Pack to Custom Joinery"
                data-excerpt="Door repairs, custom shelving, flat-pack assembly, kitchen cabinets and wood polishing - handled by carpenters who measure twice."
                data-author="Daniel Okafor"
                data-read-time="6 min read"
            >
                <span class="services-badge">Carpentry</span>
                <h3>Carpentry &amp; Furniture Assembly: From Flat-Pack to Custom Joinery</h3>
                <p>Door repairs, custom shelving, flat-pack assembly, kitchen cabinets and wood polishing - handled by carpenters who measure twice.</p>
                <div class="services-meta-row">
                    <span>Daniel Okafor</span>
                    <span>6 min read</span>
                </div>
            </article>

            <article
                class="services-guide-card"
                data-service-card
                data-category="Painting"
                data-title="Painting Services: Walls That Stay Beautiful for Years"
                data-excerpt="Interior, exterior, texture and waterproofing. The preparation matters more than the paint - here is how we do it properly."
                data-author="Sofia Mendes"
                data-read-time="6 min read"
            >
                <span class="services-badge">Painting</span>
                <h3>Painting Services: Walls That Stay Beautiful for Years</h3>
                <p>Interior, exterior, texture and waterproofing. The preparation matters more than the paint - here is how we do it properly.</p>
                <div class="services-meta-row">
                    <span>Sofia Mendes</span>
                    <span>6 min read</span>
                </div>
            </article>

            <article
                class="services-guide-card"
                data-service-card
                data-category="Pest Control"
                data-title="Pest Control: Cockroaches, Termites, Bed Bugs and Mosquitoes"
                data-excerpt="Targeted treatments that actually work, applied by certified technicians using products that are safe around children and pets."
                data-author="Lin Wei"
                data-read-time="6 min read"
            >
                <span class="services-badge">Pest Control</span>
                <h3>Pest Control: Cockroaches, Termites, Bed Bugs and Mosquitoes</h3>
                <p>Targeted treatments that actually work, applied by certified technicians using products that are safe around children and pets.</p>
                <div class="services-meta-row">
                    <span>Lin Wei</span>
                    <span>6 min read</span>
                </div>
            </article>

            <article
                class="services-guide-card"
                data-service-card
                data-category="Appliance Repair"
                data-title="Appliance Repair: Washing Machines, Fridges, Microwaves and More"
                data-excerpt="Genuine spares, qualified technicians, and a same-week response for the appliances your home cannot do without."
                data-author="Jonas Albrecht"
                data-read-time="6 min read"
            >
                <span class="services-badge">Appliance Repair</span>
                <h3>Appliance Repair: Washing Machines, Fridges, Microwaves and More</h3>
                <p>Genuine spares, qualified technicians, and a same-week response for the appliances your home cannot do without.</p>
                <div class="services-meta-row">
                    <span>Jonas Albrecht</span>
                    <span>6 min read</span>
                </div>
            </article>
        </div>
    </section>
@endsection

