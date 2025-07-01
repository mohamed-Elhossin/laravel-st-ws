@extends('admin.layouts.app')
<style>
    body {
        font-family: 'Segoe UI', sans-serif;
        background-color: #f7f9fc;
        padding: 40px 0;
    }


    .card {
        border: none;
        border-radius: 14px;
        background-color: #ffffff;
        box-shadow: 0 4px 18px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s ease, box-shadow 0.3s ease;

    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
    }

    .row.justify-content-around .col-md-6 {
        margin-bottom: 35px;
    }

    .card-body i {
        font-size: 2.8rem;
        margin-bottom: 12px;
        display: inline-block;
        animation: iconBounce 3s ease-in-out infinite;
    }

    @keyframes iconBounce {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-6px);
        }
    }

    .card-body h5 {
        font-size: 1.2rem;
        font-weight: 600;
        color: #2e3e4e;
        margin-bottom: 6px;
    }

    .card-body a {
        font-size: 0.95rem;
        color: #6c757d;
        text-decoration: underline
    }

    /* ألوان بناءً على الأصناف المخصصة */
    .warning-card i {
        color: #f0ad4e;
    }

    .awol-card i {
        color: #a94442;
    }

    .late-card i {
        color: #5bc0de;
    }

    .feedback-card i {
        color: #5cb85c;
    }

    h1 {

        font-size: 2.5rem;
        font-weight: 700;
        color: #2e3e4e;
        text-align: left;
        position: relative;
        display: inline-block;
        margin-bottom: 50px;
        padding-bottom: 10px;
    }
</style>
@section('content')
    {{-- Create Simple Design For This Page  --}}
    <div class="containermt-4">

        <div class="card  mx-auto">
            <div class="card-header">
                <h3 class="card-title"> Feedback Dashboard </h3>

            </div>
            <div class="card-body mt-5 text-center ">
                <div class="row justify-content-around">
                    <div class="col-md-6 feedback-card">
                        <i class="fa-solid fa-comment-dots"></i>
                        <h5> Feedback </h5>
                        <a href="{{ route('ontherFeedback') }}"> View Employee Feedback</a>
                    </div>
                    <div class="col-md-6  warning-card">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        <h5> Warning </h5>
                        <a href="#"> View warning feedbacks here. <span class="badge text-bg-warning">SOON</span>
                        </a>
                    </div>
                    <div class="col-md-6  awol-card">
                        <i class="fa-solid fas fa-user-times"></i>
                        <h5> AWOL </h5>
                        <a href="#"> View Absent Without Leave <span class="badge text-bg-warning">SOON</span></a>
                    </div>
                    <div class="col-md-6  late-card">
                        <i class="fa-solid fa-hourglass-half"></i>
                        <h5> Late Arrival </h5>
                        <a href="#"> View Employee Late arrivals <span class="badge text-bg-warning">SOON</span></a>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
