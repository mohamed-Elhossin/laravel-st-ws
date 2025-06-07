@extends('admin.layouts.app')



@section('content')
    <div class="pagetitle">
        <h1>Employees </h1>
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
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ Session::get('done') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Datatables
                            <a class=" float-end btn btn-info" href="{{ route('employee.create') }}">Create New</a>
                        </h5>

                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th> #N </th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Department</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @foreach ($employee as $item)
                                        <td> {{ $loop->iteration }} </td>
                                        <td> {{ $item->user->name }} </td>
                                        <td> {{ $item->user->email }} </td>
                                        <td> {{ $item->department->name }} </td>
                                        <td><a class="text-danger" href="{{ route('employee.destroy', $item->user_id) }}"> Delete
                                            </a>
                                        </td>
                                </tr>
                                @endforeach
                                </tr>
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
