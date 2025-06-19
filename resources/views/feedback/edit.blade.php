@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Edit Feedback</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('feedback.update', $feedback->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Employee</label>
            <select name="employee_id" class="form-select" required>
                @foreach($employees as $employee)
                    <option value="{{ $employee->id }}" {{ $feedback->employee_id == $employee->id ? 'selected' : '' }}>
                        {{ $employee->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ $feedback->title }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Content</label>
            <textarea name="content" class="form-control" rows="5" required>{{ $feedback->content }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update Feedback</button>
        <a href="{{ route('feedback.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
