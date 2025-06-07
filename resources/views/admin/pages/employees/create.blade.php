@extends('admin.layouts.app')



@section('content')
    <div class="pagetitle">
        <h1> Create Employee</h1>
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
                        <h5 class="card-title"> </h5>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"> </h5>

                                <!-- Vertical Form -->
                                <form action="{{ route('employee.store') }}" class="row g-3" method="post">
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
                                        <label for="inputEmail4" class="form-label">Position</label>
                                        <input type="text" name="position" class="form-control" id="inputEmail4">
                                    </div>
                                    <div class="col-12">
                                        <label for="inputEmail4" class="form-label">Salary</label>
                                        <input type="number" name="salary" class="form-control" id="inputEmail4">
                                    </div>
                                    <div class="col-12">
                                        <label for="inputEmail4" class="form-label">Join date</label>
                                        <input type="date" name="join_date" class="form-control" id="inputEmail4">
                                    </div>
                                    <div class="col-12">
                                        <label for="inputEmail4" class="form-label">End date</label>
                                        <input type="date" name="end_date" class="form-control" id="inputEmail4">
                                    </div>
                                    <div class="col-12">
                                        <label for="inputEmail4" class="form-label">Department </label>
                                        <select name="department_id" class="form-select" id="">
                                            <option disabled selected>Select Department</option>
                                            @foreach ($departments as $department)
                                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                                            @endforeach
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
