@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <!-- Create Post Form -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Create Leave Usage For {{ $employee->user->name }}</h3>
                        <div class="card-tools">
                            <a href="{{ route('employees.show', $employee->id) }}" class="btn btn-primary">
                                <i class="fas fa-list"></i> Back to Employee
                            </a>
                        </div>
                    </div>
                    <div class="card-body">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                        @if (session('message'))
                            <div class="alert alert-success alert-dismissible fade show">
                                {{ session('message') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('leave-usages.store', $employee->id) }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="type" class="form-label">Leave Type</label>
                                <select name="type" id="type" class="form-select">
                                    <option value="">Select Leave Type</option>
                                    <option value="casual">Urgent</option>
                                    <option value="regular">Normal</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="start_date" class="form-label">Start date</label>
                                <input type="date" name="start_date" id="start_date" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="end_date" class="form-label">End date</label>
                                <input type="date" name="end_date" id="end_date" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="reason" class="form-label">Reason</label>
                                <textarea name="reason" id="reason" class="form-control" rows="3" required></textarea>
                            </div>

                            <input type="hidden" name="employee_id" id="employee_id" value="{{ $employee->id }}">

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
