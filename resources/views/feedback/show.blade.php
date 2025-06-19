@extends('admin.layouts.app')

@section('content')
    <div class="container mt-4">
        <h1>Edit Feedback</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('feedback.update', $feedback) }}" method="POST" class="mt-4">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Employee</label>
                <input type="text" class="form-control" value="{{ $feedback->employee->user->name }}" readonly>
            </div>
            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $feedback->title) }}"
                    required>
            </div>

            <div class="mb-3">
                <label class="form-label">Content</label>
                <textarea name="content" class="form-control" rows="5" required>{{ old('content', $feedback->content) }}</textarea>
            </div>

            {{-- <button type="submit" class="btn btn-primary">Update Feedback</button> --}}
            <a href="{{ route('feedback.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
@endsection
