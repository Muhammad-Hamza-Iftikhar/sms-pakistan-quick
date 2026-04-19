@extends('layouts.app')

@section('title', 'Contact | FixMate')

@section('content')
    <section class="page-hero-subtle">
        <div class="container page-hero-subtle-inner max-3xl center-text">
            <p class="page-kicker">Contact</p>
            <h1 class="page-title-xl">Need help? <span class="text-gradient">We're here.</span></h1>
            <p class="page-lead">
                Booking a service, asking about pricing, or following up on a job - send us a message and our team will reply within one business day.
            </p>
        </div>
    </section>

    <section class="container contact-page-grid">
        <div class="contact-info-stack">
            <article class="contact-info-card">
                <div class="contact-info-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon-16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16v16H4z"></path><path d="m22 6-10 7L2 6"></path></svg>
                </div>
                <div>
                    <p class="contact-info-label">Email</p>
                    <p class="contact-info-value">{{ config('contact.admin_email', config('mail.from.address')) }}</p>
                    <p class="contact-info-copy">For general questions</p>
                </div>
            </article>

            <article class="contact-info-card">
                <div class="contact-info-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon-16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                </div>
                <div>
                    <p class="contact-info-label">Support</p>
                    <p class="contact-info-value">support@fixmate.app</p>
                    <p class="contact-info-copy">For active bookings</p>
                </div>
            </article>

            <article class="contact-info-card">
                <div class="contact-info-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon-16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92V21a1 1 0 0 1-1.09 1 19.8 19.8 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 3 3.09 1 1 0 0 1 4 2h4.09a1 1 0 0 1 1 .75 12.8 12.8 0 0 0 .7 2.81 1 1 0 0 1-.23 1L8.09 8a16 16 0 0 0 6 6l1.44-1.47a1 1 0 0 1 1-.23 12.8 12.8 0 0 0 2.81.7 1 1 0 0 1 .75 1v2.92z"></path></svg>
                </div>
                <div>
                    <p class="contact-info-label">Phone</p>
                    <p class="contact-info-value">+1 (555) 014-2200</p>
                    <p class="contact-info-copy">7 days/week, 8am-10pm</p>
                </div>
            </article>

            <article class="contact-info-card">
                <div class="contact-info-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon-16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 10c0 5-8 12-8 12s-8-7-8-12a8 8 0 0 1 16 0Z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                </div>
                <div>
                    <p class="contact-info-label">Office</p>
                    <p class="contact-info-value">Serving 40+ cities</p>
                    <p class="contact-info-copy">Local crews near you</p>
                </div>
            </article>
        </div>

        <div class="contact-form-card">
            <h2>Send us a message</h2>
            <p class="contact-form-note">All fields are required.</p>

            @if (session('contact_success'))
                <div class="alert alert-success">{{ session('contact_success') }}</div>
            @endif

            @if ($errors->has('contact'))
                <div class="alert alert-error">{{ $errors->first('contact') }}</div>
            @endif

            <form method="POST" action="{{ route('contact.submit') }}" class="contact-form" data-contact-form novalidate>
                @csrf

                <div class="contact-two-col">
                    <div class="field-wrap">
                        <label for="name" class="field-label">Name</label>
                        <input id="name" name="name" type="text" maxlength="100" class="field-input" value="{{ old('name') }}" required />
                        @error('name')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="field-wrap">
                        <label for="email" class="field-label">Email</label>
                        <input id="email" name="email" type="email" maxlength="255" class="field-input" value="{{ old('email') }}" required />
                        @error('email')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="field-wrap">
                    <label for="subject" class="field-label">Subject</label>
                    <input id="subject" name="subject" type="text" maxlength="150" class="field-input" value="{{ old('subject') }}" required />
                    @error('subject')
                        <p class="field-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="field-wrap">
                    <div class="field-row-between">
                        <label for="message" class="field-label no-margin">Message</label>
                        <span class="field-counter" data-contact-char>0/2000</span>
                    </div>
                    <textarea id="message" name="message" rows="6" maxlength="2000" class="field-textarea" data-contact-message required>{{ old('message') }}</textarea>
                    @error('message')
                        <p class="field-error">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="btn btn-hero btn-lg">
                    Send message
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon-16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                </button>
            </form>
        </div>
    </section>
@endsection

