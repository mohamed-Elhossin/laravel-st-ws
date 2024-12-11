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
    </div>

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
                        <h5 class="card-title">List Applicants
                            <a class=" float-end btn btn-info" href="{{ route('applicant.create') }}">Create New</a>
                        </h5>
                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th> #N </th>
                                    <th>Name</th>

                                    <th>status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reviews as $item)
                                    <tr>
                                        <th>{{ $item->id }}</th>
                                        <th>{{ $item->applicant->user->name }}</th>
                                        <th>{{ $item->status }}</th>
                                        <th>
                                            <a href="{{ route('cv_review.show', $item->id) }}">Show</a>
                                        </th>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
