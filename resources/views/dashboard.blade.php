@extends('layouts.app')

@section('title', 'Send SMS | Pak SMS Connect')

@section('content')
    <div class="sms-page">
        <header class="container site-header">
            <a href="{{ url('/') }}" class="brand">
                <span class="brand-badge">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-circle icon-20">
                        <path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z"></path>
                    </svg>
                </span>
                <span class="brand-name">Pak SMS Connect</span>
            </a>

            <div class="row-actions">
                <button type="button" data-install-app class="btn btn-outline">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-download icon-16">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                        <polyline points="7 10 12 15 17 10"></polyline>
                        <line x1="12" x2="12" y1="15" y2="3"></line>
                    </svg>
                    Install app
                </button>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-ghost">Sign out</button>
                </form>
            </div>
        </header>

        <main class="container sms-main">
            <div class="sms-card-wrap">
                <div class="sms-header">
                    <h1 class="page-title">Send an SMS</h1>
                    <p class="page-subtitle">Pakistani numbers only. Messages are sent using your configured SMS provider.</p>
                </div>

                @if (session('sms_success'))
                    <div class="sms-feedback sms-feedback-success">{{ session('sms_success') }}</div>
                @endif

                @if ($errors->has('sms'))
                    <div class="sms-feedback sms-feedback-error">{{ $errors->first('sms') }}</div>
                @endif

                <form data-sms-form class="sms-form" method="POST" action="{{ route('sms.send') }}" novalidate>
                    @csrf
                    <div class="form-group">
                        <label for="phone" class="form-label">Phone number</label>

                        <div class="prefix-input">
                            <span class="prefix-badge">+92</span>
                            <input
                                id="phone"
                                name="phone"
                                data-phone-input
                                type="tel"
                                inputmode="numeric"
                                placeholder="300 1234567"
                                class="form-input"
                                maxlength="11"
                                value="{{ old('phone') }}"
                            />
                        </div>

                        <p data-phone-error class="field-error @if ($errors->has('phone')) @else hidden @endif">{{ $errors->first('phone') }}</p>
                        <p data-phone-hint class="input-hint @if ($errors->has('phone')) hidden @endif">Format: 3XX XXXXXXX (e.g. Jazz, Zong, Telenor, Ufone)</p>
                    </div>

                    <div class="form-group">
                        <div class="input-counter-row">
                            <label for="message" class="form-label" style="margin-bottom: 0;">Message</label>
                            <span data-char-count class="input-counter">0/500</span>
                        </div>

                        <textarea
                            id="message"
                            name="message"
                            data-message-input
                            rows="5"
                            maxlength="500"
                            placeholder="Type your message here..."
                            class="form-textarea"
                        >{{ old('message') }}</textarea>

                        <p data-message-error class="field-error @if ($errors->has('message')) @else hidden @endif">{{ $errors->first('message') }}</p>
                    </div>

                    <div class="space-top">
                        <button type="submit" class="btn btn-primary btn-lg" style="width: 100%; box-shadow: var(--shadow-elegant);">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="icon-16">
                                <path d="m22 2-7 20-4-9-9-4z"></path>
                                <path d="m22 2-11 11"></path>
                            </svg>
                            Send SMS
                        </button>
                    </div>

                    <p class="note-copy">This sends a transactional SMS to the entered number.</p>
                </form>
            </div>
        </main>
    </div>
@endsection
