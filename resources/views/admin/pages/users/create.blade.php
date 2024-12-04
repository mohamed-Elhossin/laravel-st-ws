@extends('admin.layouts.app')



@section('content')
    <div class="pagetitle">
        <h1> Create Admin</h1>
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
                                <form action="{{ route('user.store') }}" class="row g-3" method="post">
                                    @csrf
                                    <div class="col-12">
                                        <label for="inputNanme4" class="form-label">Admin Name</label>
                                        <input type="text" name="name" class="form-control" id="inputNanme4">
                                    </div>
                                    <div class="col-12">
                                        <label for="inputEmail4" class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control" id="inputEmail4">
                                    </div>

                                    <div class="col-12">
                                        <label for="inputAddress" class="form-label">User Type</label>
                                        <select class="form-control" name="type" id="">
                                            <option value="HR">HR</option>
                                            <option value="admin">admin</option>
                                        </select>
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
