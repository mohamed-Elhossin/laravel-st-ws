@extends('admin.layouts.app')

@section('content')
    <div class="container">

        <section class="section error-404 min-vh-100 d-flex flex-column align-items-center justify-content-center">
            <h1>403</h1>
            <h2>Access Denied</h2>
            <a class="btn" href="/dashboard">Back to home</a>
            <img src="{{ asset('assets/img/not-found.svg') }}" class="img-fluid py-5" alt="Page Not Found">
            <div class="credits">

            </div>
        </section>

    </div>
@endsection
