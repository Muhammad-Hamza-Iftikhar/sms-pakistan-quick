@extends('layouts.app')

@section('title', 'Send SMS | FixMate')

@section('content')
    <section class="page-hero-subtle">
        <div class="container page-hero-subtle-inner max-3xl center-text">
            <p class="page-kicker">Dashboard</p>
            <h1 class="page-title-xl">Send transactional SMS with confidence.</h1>
            <p class="page-lead">Pakistani numbers only. Provider responses are logged automatically.</p>
        </div>
    </section>

    <section class="container sms-dashboard-section">
        <div class="sms-dashboard-card">
            @if (session('sms_success'))
                <div class="alert alert-success">{{ session('sms_success') }}</div>
            @endif

            @if ($errors->has('sms'))
                <div class="alert alert-error">{{ $errors->first('sms') }}</div>
            @endif

            <form data-sms-form class="sms-form" method="POST" action="{{ route('sms.send') }}" novalidate>
                @csrf
                <div class="field-wrap">
                    <label for="phone" class="field-label">Phone number</label>

                    <div class="prefix-input">
                        <span class="prefix-badge">+92</span>
                        <input
                            id="phone"
                            name="phone"
                            data-phone-input
                            type="tel"
                            inputmode="numeric"
                            placeholder="300 1234567"
                            class="field-input"
                            maxlength="11"
                            value="{{ old('phone') }}"
                        />
                    </div>

                    <p data-phone-error class="field-error @if ($errors->has('phone')) @else hidden @endif">{{ $errors->first('phone') }}</p>
                    <p data-phone-hint class="field-hint @if ($errors->has('phone')) hidden @endif">Format: 3XX XXXXXXX (e.g. Jazz, Zong, Telenor, Ufone)</p>
                </div>

                <div class="field-wrap">
                    <div class="field-row-between">
                        <label for="message" class="field-label no-margin">Message</label>
                        <span data-char-count class="field-counter">0/500</span>
                    </div>

                    <textarea
                        id="message"
                        name="message"
                        data-message-input
                        rows="5"
                        maxlength="500"
                        placeholder="Type your message here..."
                        class="field-textarea"
                    >{{ old('message') }}</textarea>

                    <p data-message-error class="field-error @if ($errors->has('message')) @else hidden @endif">{{ $errors->first('message') }}</p>
                </div>

                <button type="submit" class="btn btn-hero btn-lg btn-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon-16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="m22 2-7 20-4-9-9-4z"></path>
                        <path d="m22 2-11 11"></path>
                    </svg>
                    Send SMS
                </button>

                <p class="sms-note">This sends a transactional SMS to the entered number.</p>
            </form>
        </div>
    </section>
@endsection

