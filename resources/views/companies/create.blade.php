@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Create Company</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('companies.store') }}" method="POST" class="mt-4">
        @csrf

        <div class="mb-3">
            <label class="form-label">Company Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <button type="submit" class="btn btn-success">Save Company</button>
        <a href="{{ route('companies.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
