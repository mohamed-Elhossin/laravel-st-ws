@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Employee Details</h3>
                        <div class="card-tools">
                            <a href="{{ route('employees.index') }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-list"></i> Back to List
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="my-2">Personal Information</h4>
                                <table class="table table-bordered ">
                                    <tr>
                                        <th width="30%">Name</th>
                                        <td>{{ $employee->user->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{ $employee->user->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Position</th>
                                        <td>{{ $employee->position }}</td>
                                    </tr>
                                    <tr>
                                        <th>Department</th>
                                        <td>{{ $employee->department->name }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <h4 class="my-2">Employment Details</h4>
                                <table class="table table-bordered">
                                    <tr>
                                        <th width="30%">Salary</th>
                                        <td>${{ number_format($employee->salary, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Join Date</th>
                                        <td>{{ $employee->join_date ? date('F d, Y', strtotime($employee->join_date)) : 'Not set' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>End Date</th>
                                        <td>{{ $employee->end_date ? date('F d, Y', strtotime($employee->end_date)) : 'Active' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>
                                            @if (!$employee->end_date || \Carbon\Carbon::parse($employee->end_date)->isFuture())
                                                <span class="badge text-bg-success">Active</span>
                                            @else
                                                <span class="badge text-bg-danger">Inactive</span>
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>


                    @if ($employee->leaves)
                        {{-- create Simple Design  --}}
                        <div class="card-body">
                            <h4 class="my-2">Leave Details
                                {{-- Button trigger modal --}}
                                <a class=" float-end btn btn-link" href="{{ route('leave-usages.create', $employee->id) }}">
                                    Use Leave
                                </a>

                            </h4>
                            <table class="table table-bordered">
                                <tr>
                                    <th width="40%">Total Leaves</th>
                                    <td>{{ $employee->leaves->total }}</td>
                                </tr>
                                <tr>
                                    <th>casual Days</th>
                                    <td>{{ $employee->leaves->urgent_days }}</td>
                                </tr>
                                <tr>
                                    <th>regular Days</th>
                                    <td>{{ $employee->leaves->normal_days }}</td>
                                </tr>
                            </table>
                        </div>
                    @else
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>

                            </div>
                        @endif
                        <div class="card-body">
                            <h4> Add Leaves </h4>
                            <form method="post" action="{{ route('leave.store') }}">
                                @csrf
                                <div class="form-group">
                                    <label for=""> casual days</label>
                                    <input type="number" name="urgent_days" id="urgent_days" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">regular days</label>
                                    <input type="number" name="normal_days" id="normal_days" class="form-control">
                                </div>
                                <div class="form-group">
                                    <input type="hidden" value="{{ $employee->id }}" name="employee_id" id="user_id"
                                        class="form-control">
                                </div>
                                <button type="submit" class="btn btn-primary">Add Leave</button>
                            </form>
                        </div>
                    @endif
                    <div class="container">
                        <h2 class="mb-4">Employee Leave Usages</h2>

                        @if (isset($leaveUsages) && count($leaveUsages) > 0)
                            <table class="table table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Type</th>
                                        <th>Reason</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Days Count</th>
                                        <th>Days List</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($leaveUsages as $usage)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $usage['type'] }}</td>
                                            <td>{{ $usage['reason'] }}</td>
                                            <td>{{ $usage['start_date'] }}</td>
                                            <td>{{ $usage['end_date'] }}</td>
                                            <td>{{ $usage['days_count'] }}</td>
                                            <td>
                                                @if (!empty($usage['days']))
                                                    <ul class="mb-0">
                                                        @foreach ($usage['days'] as $day)
                                                            <li>{{ $day }}</li>
                                                        @endforeach
                                                    </ul>
                                                @else
                                                    <span class="text-muted">No days listed</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="alert alert-info">
                                No leave usages found for this employee.
                            </div>
                        @endif
                    </div>


                </div>
            </div>
        </div>
    </div>

@endsection
