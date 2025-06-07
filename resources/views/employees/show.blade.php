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
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Personal Information</h4>
                            <table class="table table-bordered">
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
                            <h4>Employment Details</h4>
                            <table class="table table-bordered">
                                <tr>
                                    <th width="30%">Salary</th>
                                    <td>${{ number_format($employee->salary, 2) }}</td>
                                </tr>
                                <tr>
                                    <th>Join Date</th>
                                    <td>{{ $employee->join_date ? date('F d, Y', strtotime($employee->join_date)) : 'Not set' }}</td>
                                </tr>
                                <tr>
                                    <th>End Date</th>
                                    <td>{{ $employee->end_date ? date('F d, Y', strtotime($employee->end_date)) : 'Active' }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        @if(!$employee->end_date)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-danger">Inactive</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
