@extends('layouts.app')

@section('title', 'Log In | FixMate')

@section('content')
    <section class="container login-page-wrap">
        <div class="login-brand-pane">
            <a href="{{ route('home') }}" class="fm-brand">
                <span class="fm-brand-logo">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon-18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 3 5 6v6c0 5 3.5 8.5 7 10 3.5-1.5 7-5 7-10V6z"></path>
                        <path d="m9 12 2 2 4-4"></path>
                    </svg>
                </span>
                <span class="fm-brand-text">SkillCert</span>
            </a>

            <h1>One certificate.<br><span class="text-gradient-light">A world of opportunity.</span></h1>
            <p>
                Sign in to track your evaluation, view your certificates, and share your verifiable
                SkillCert ID with employers worldwide.
            </p>

            <div class="login-promo-card">
                <p class="login-promo-title">Secure & private</p>
                <p class="login-promo-copy">Your certificates are tied to a unique ID - only what you choose to share is public.</p>
            </div>
        </div>

        <div class="login-form-pane">
            <div class="login-form-card">
                <div class="login-switch login-switch-single">
                    <button type="button" class="is-active">Log in</button>
                </div>

                <h2>Welcome back</h2>
                <p>Pick up where you left off.</p>

                <form method="POST" action="{{ route('login') }}" class="login-form" novalidate>
                    @csrf

                    <div class="field-wrap">
                        <label for="email" class="field-label">Email</label>
                        <input
                            id="email"
                            name="email"
                            type="email"
                            autocomplete="email"
                            placeholder="you@example.com"
                            value="{{ old('email') }}"
                            class="field-input"
                            required
                            autofocus
                        />
                        @error('email')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="field-wrap">
                        <div class="field-row-between">
                            <label for="password" class="field-label no-margin">Password</label>
                            <button type="button" class="login-forgot">Forgot?</button>
                        </div>
                        <input
                            id="password"
                            name="password"
                            type="password"
                            autocomplete="current-password"
                            placeholder="........"
                            class="field-input"
                            required
                        />
                        @error('password')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-hero btn-lg btn-full">
                        Log in
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon-16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                    </button>
                </form>

                <p class="login-terms-note">
                    By continuing you agree to our <a href="{{ route('terms.show') }}">Terms & Conditions</a>.
                </p>
            </div>
        </div>
    </section>
@endsection

