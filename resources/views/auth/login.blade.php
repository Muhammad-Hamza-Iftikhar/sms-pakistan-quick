@extends('layouts.app')

@section('title', 'Sign In | Pak SMS Connect')

@section('content')
    <div class="login-shell">
        <aside class="login-brand-panel">
            <a href="{{ url('/') }}" class="brand">
                <span class="brand-badge">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-circle icon-20">
                        <path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z"></path>
                    </svg>
                </span>
                <span class="brand-name">Pak SMS Connect</span>
            </a>

            <div class="login-brand-copy">
                <h2>Officially yours.</h2>
                <p>Sign in to dispatch SMS to Pakistani numbers in seconds.</p>
            </div>

            <p class="login-brand-foot">&copy; {{ now()->year }} Pak SMS Connect</p>
        </aside>

        <main class="login-main">
            <div class="login-card">
                <div class="mobile-brand">
                    <a href="{{ url('/') }}" class="brand">
                        <span class="brand-badge">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-circle icon-20">
                                <path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z"></path>
                            </svg>
                        </span>
                        <span class="brand-name">Pak SMS Connect</span>
                    </a>
                </div>

                <h1 class="page-title">Welcome back</h1>
                <p class="page-subtitle">Sign in to continue to your dashboard.</p>

                <form method="POST" action="{{ route('login') }}" class="form-stack" novalidate>
                    @csrf

                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input
                            id="email"
                            name="email"
                            type="email"
                            autocomplete="email"
                            placeholder="you@example.com"
                            value="{{ old('email') }}"
                            class="form-input"
                            required
                            autofocus
                        />
                        @error('email')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input
                            id="password"
                            name="password"
                            type="password"
                            autocomplete="current-password"
                            placeholder="........"
                            class="form-input"
                            required
                        />
                        @error('password')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-top">
                        <button type="submit" class="btn btn-primary btn-lg" style="width: 100%; box-shadow: var(--shadow-elegant);">
                            Sign in
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>
@endsection
