@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h3>Company Details: {{ $company->name }}</h3>
        </div>
        <div class="card-body">
            <p><strong>ID:</strong> {{ $company->id }}</p>
            <p><strong>Name:</strong> {{ $company->name }}</p>
            <p><strong>Created At:</strong> {{ $company->created_at->format('Y-m-d H:i:s') }}</p>
        </div>
    </div>

    {{-- Departments List --}}
    <div class="card mt-4">
        <div class="card-header">
            <h4>Departments in this Company</h4>
        </div>
        <div class="card-body">
            @if($company->departments->count() > 0)
                <ul class="list-group">
                    @foreach($company->departments as $department)
                        <li class="list-group-item">{{ $department->name }}</li>
                    @endforeach
                </ul>
            @else
                <p>No departments found for this company.</p>
            @endif
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('companies.index') }}" class="btn btn-secondary">Back to List</a>
        <a href="{{ route('companies.edit', $company) }}" class="btn btn-info">Edit Company</a>
    </div>
</div>
@endsection
