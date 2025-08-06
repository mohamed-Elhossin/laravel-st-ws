@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Create Country</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('countries.store') }}" method="POST" class="mt-4">
        @csrf

        <div class="mb-3">
            <label class="form-label">English Name</label>
            <input type="text" name="name_en" class="form-control" value="{{ old('name_en') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Arabic Name</label>
            <input type="text" name="name_ar" class="form-control" value="{{ old('name_ar') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Country Code</label>
            <input type="text" name="code" class="form-control" value="{{ old('code') }}" required>
        </div>

        <button type="submit" class="btn btn-success">Save Country</button>
        <a href="{{ route('countries.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
