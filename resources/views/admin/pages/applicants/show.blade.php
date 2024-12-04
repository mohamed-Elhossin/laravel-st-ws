@extends('admin.layouts.app')



@section('content')
    <div class="pagetitle">
        <h1>Data Tables</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Tables</li>
                <li class="breadcrumb-item active">Data</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                @if (Session::has('done'))
                    <div class="alert alert-success">
                        {{ Session::get('done') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Show Applicants {{ $applicant->id }}
                            <a class=" float-end btn btn-info" href="{{ route('applicant.create') }}">Create New</a>
                        </h5>
                        <div class="text-center">
                            <h4 class="card-title">Name : {{ $applicant->user->name }}</h4>
                            <hr>
                            <h4 class="card-title">Email : {{ $applicant->user->email }}</h4>
                            <hr>
                            <h4 class="card-title">exp_years : {{ $applicant->exp_years }}</h4>
                            <hr>
                            <h4 class="card-title">address : {{ $applicant->address }}</h4>
                            <hr>
                            <h4 class="card-title">phone : {{ $applicant->phone }}</h4>
                            <hr>
                            <h4 class="card-title">education : {{ $applicant->education }}</h4>
                            <hr>
                            <h4 class="card-title">linkedIn : <a href="{{ $applicant->linkedIn }}">LinkedIn</a> </h4>
                            <hr>
                            <a href="{{ route('applicant.download', $applicant->id) }}" class="btn btn-success my-3">
                                Download File From Here
                            </a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
