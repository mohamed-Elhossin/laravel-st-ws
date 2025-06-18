@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="card-title">Announcement Details</h5>
                <div>
                    <a href="{{ route('news.edit', $news) }}" class="btn btn-warning">
                        <i class="bi bi-pencil"></i> Edit
                    </a>
                    <a href="{{ route('news.index') }}" class="btn btn-secondary ms-2">
                        <i class="bi bi-arrow-left"></i> Back to List
                    </a>
                </div>
            </div>

            <div class="mb-4">
                <h6 class="text-muted mb-2">Title</h6>
                <p class="h4">{{ $news->title }}</p>
            </div>

            <div class="mb-4">
                <h6 class="text-muted mb-2">Description</h6>
                <div class="p-3 bg-light rounded">
                    {!! nl2br(e($news->description)) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <h6 class="text-muted mb-2">Created At</h6>
                    <p>{{ $news->created_at->format('Y-m-d H:i') }}</p>
                </div>
                <div class="col-md-6">
                    <h6 class="text-muted mb-2">Last Updated</h6>
                    <p>{{ $news->updated_at->format('Y-m-d H:i') }}</p>
                </div>
            </div>

            <div class="mt-4 text-end">
                <form action="{{ route('news.destroy', $news) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this announcement?')">
                        <i class="bi bi-trash"></i> Delete Announcement
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
