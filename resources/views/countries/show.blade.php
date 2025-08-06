@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h3>Country Details</h3>
        </div>
        <div class="card-body">
            <p><strong>ID:</strong> {{ $country->id }}</p>
            <p><strong>English Name:</strong> {{ $country->name_en }}</p>
            <p><strong>Arabic Name:</strong> {{ $country->name_ar }}</p>
            <p><strong>Code:</strong> {{ $country->code }}</p>
            <p><strong>Created At:</strong> {{ $country->created_at->format('Y-m-d H:i:s') }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('countries.index') }}" class="btn btn-secondary">Back to List</a>
            <a href="{{ route('countries.edit', $country) }}" class="btn btn-info">Edit</a>
        </div>
    </div>
</div>
@endsection
