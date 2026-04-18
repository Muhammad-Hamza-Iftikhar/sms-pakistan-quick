@extends('layouts.app')

@section('title', '404 | Pak SMS Connect')

@section('content')
    <div class="not-found">
        <div class="not-found-card">
            <h1 class="not-found-title">404</h1>
            <p class="not-found-copy">Oops! Page not found</p>
            <a href="{{ url('/') }}" class="not-found-link">Return to Home</a>
        </div>
    </div>
@endsection
