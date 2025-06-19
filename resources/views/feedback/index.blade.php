@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">All Feedback</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('feedback.create') }}" class="btn btn-primary mb-3">Create New Feedback</a>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Employee</th>
                <th>Title</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($feedbacks as $fb)
                <tr>
                    <td>{{ $fb->id }}</td>
                    <td>{{ $fb->employee->user->name }}</td>
                    <td>{{ $fb->title }}</td>
                    <td>{{ $fb->created_at->format('Y-m-d') }}</td>
                    <td>
                        <a href="{{ route('feedback.show', $fb) }}" class="btn btn-sm btn-info">View</a>
                        {{-- <a href="{{ route('feedback.edit', $fb->id) }}" class="btn btn-sm btn-warning">Edit</a> --}}
                        <form action="{{ route('feedback.destroy', $fb) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No feedback found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
