@extends('admin.layouts.app')



@section('content')
    <div class="pagetitle">
        <h1> Create Applicant</h1>
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
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Datatables</h5>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Vertical Form</h5>

                                <!-- Vertical Form -->
                                <form enctype="multipart/form-data" action="{{ route('applicant.store') }}" class="row g-3" method="post">
                                    @csrf
                                    <div class="col-12">
                                        <label for="inputNanme4" class="form-label"> Name</label>
                                        <input type="text" name="name" class="form-control" id="inputNanme4">
                                    </div>
                                    <div class="col-12">
                                        <label for="inputEmail4" class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control" id="inputEmail4">
                                    </div>
                                    <div class="col-12">
                                        <label for="inputNanme4" class="form-label"> position</label>
                                        <input type="text" name="position" class="form-control" id="inputNanme4">
                                    </div>
                                    <div class="col-12">
                                        <label for="inputNanme4" class="form-label"> exp_years</label>
                                        <input type="text" name="exp_years" class="form-control" id="inputNanme4">
                                    </div>
                                    <div class="col-12">
                                        <label for="inputNanme4" class="form-label"> cv</label>
                                        <input type="file" name="cv" class="form-control" id="inputNanme4">
                                    </div>
                                    <div class="col-12">
                                        <label for="inputNanme4" class="form-label"> address</label>
                                        <input type="text" name="address" class="form-control" id="inputNanme4">
                                    </div>
                                    <div class="col-12">
                                        <label for="inputNanme4" class="form-label"> phone</label>
                                        <input type="text" name="phone" class="form-control" id="inputNanme4">
                                    </div>
                                    <div class="col-12">
                                        <label for="inputNanme4" class="form-label"> education</label>
                                        <input type="text" name="education" class="form-control" id="inputNanme4">
                                    </div>
                                    <div class="col-12">
                                        <label for="inputNanme4" class="form-label"> linkedIn</label>
                                        <input type="url" name="linkedIn" class="form-control" id="inputNanme4">
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <button type="reset" class="btn btn-secondary">Reset</button>
                                    </div>
                                </form><!-- Vertical Form -->

                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
