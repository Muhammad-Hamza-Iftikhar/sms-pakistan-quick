@extends('layouts.app')

@section('title', '404 | FixMate')

@section('content')
    <section class="not-found-wrap">
        <div class="not-found-card">
            <p class="page-kicker">Error</p>
            <h1>404</h1>
            <p>The page you are trying to reach does not exist.</p>
            <div class="not-found-actions">
                <a href="{{ route('home') }}" class="btn btn-hero">Back to home</a>
                <a href="{{ route('contact.show') }}" class="btn btn-outline">Contact support</a>
            </div>
        </div>
    </section>
@endsection

