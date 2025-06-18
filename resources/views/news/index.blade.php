@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="card-title">Company Announcements</h5>
                <a href="{{ route('news.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Add New Announcement
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($news as $item)
                            <tr>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->created_at->format('Y-m-d H:i') }}</td>
                                <td>
                                    <a href="{{ route('news.show', $item) }}" class="btn btn-info btn-sm">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('news.edit', $item) }}" class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('news.destroy', $item) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this announcement?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">No announcements found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
