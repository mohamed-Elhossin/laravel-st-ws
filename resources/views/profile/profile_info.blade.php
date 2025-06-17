@extends('admin.layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Profile Information</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Users</li>
                <li class="breadcrumb-item active">Profile</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section profile">
        <div class="row">

            <div class="col-xl-9">

                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">

                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab"
                                    data-bs-target="#profile-overview">Overview</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit
                                    Profile</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#leavs">Leaves</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab"
                                    data-bs-target="#profile-settings">Using Leaves</button>
                            </li>

                        </ul>
                        <div class="tab-content pt-2">

                            <div class="tab-pane fade show active profile-overview" id="profile-overview">


                                <h5 class="card-title">Profile Details</h5>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                                    <div class="col-lg-9 col-md-8">{{ $user->name }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Email</div>
                                    <div class="col-lg-9 col-md-8">{{ $user->email }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Job</div>
                                    <div class="col-lg-9 col-md-8">{{ $employee->position }}</div>
                                </div>



                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Type</div>
                                    <div class="col-lg-9 col-md-8">{{ $user->type }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Salary</div>
                                    <div class="col-lg-9 col-md-8">{{ $employee->salary }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Join Date</div>
                                    <div class="col-lg-9 col-md-8">{{ $employee->join_date }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">End Date</div>
                                    <div class="col-lg-9 col-md-8">{{ $employee->end_date }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Department</div>
                                    <div class="col-lg-9 col-md-8">{{ $employee->department->name }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Status</div>
                                    <div class="col-lg-9 col-md-8">
                                        @if (!$employee->end_date || \Carbon\Carbon::parse($employee->end_date)->isFuture())
                                            <span class="badge text-bg-success">Active</span>
                                        @else
                                            <span class="badge text-bg-danger">Inactive</span>
                                        @endif
                                    </div>
                                </div>

                            </div>

                            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">


                                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                                        <div class="max-w-xl">
                                            @include('profile.partials.update-profile-information-form')
                                        </div>
                                    </div>

                                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                                        <div class="max-w-xl">
                                            @include('profile.partials.update-password-form')
                                        </div>
                                    </div>

                                    <div class="d-none p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                                        <div class="max-w-xl">
                                            @include('profile.partials.delete-user-form')
                                        </div>
                                    </div>
                                </div>


                            </div>


                            <div class="tab-pane fade pt-3" id="leavs">
                                @if ($employee->leaves)
                                    {{-- create Simple Design  --}}
                                    <div class="card-body">
                                        <h4 class="my-2">Leave Details</h4>
                                        <table class="table table-bordered">
                                            <tr>
                                                <th width="40%">Total Leaves</th>
                                                <td>{{ $employee->leaves->total }} OF {{ $allDayData['all']['total'] }} </td>
                                            </tr>
                                            <tr>
                                                <th>Urgent Days</th>
                                                <td>{{ $employee->leaves->urgent_days }} OF {{ $allDayData['all']['urgent'] }} </td>
                                            </tr>
                                            <tr>
                                                <th>Normal Days</th>
                                                <td>{{ $employee->leaves->normal_days }} OF {{ $allDayData['all']['normal'] }} </td>
                                            </tr>
                                                  <tr>
                                                <th>Sick Days</th>
                                                <td>{{ $employee->leaves->sick_days }} OF {{ $allDayData['all']['sick'] }} </td>
                                            </tr>
                                        </table>
                                    </div>
                                @endif
                            </div>

                            <div class="tab-pane fade pt-3" id="profile-settings">

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
                            <td>{{ ucfirst($usage['type']) }}</td>
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

                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
