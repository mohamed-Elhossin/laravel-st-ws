@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h3>Company Details</h3>
        </div>
        <div class="card-body">
            <p><strong>ID:</strong> {{ $company->id }}</p>
            <p><strong>Name:</strong> {{ $company->name }}</p>
            <p><strong>Created At:</strong> {{ $company->created_at->format('Y-m-d H:i:s') }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('companies.index') }}" class="btn btn-secondary">Back to List</a>
            <a href="{{ route('companies.edit', $company) }}" class="btn btn-info">Edit</a>
        </div>
    </div>
</div>
@endsection
