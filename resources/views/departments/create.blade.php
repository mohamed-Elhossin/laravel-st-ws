@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Create Department</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('departments.store') }}" method="POST" class="mt-4">
        @csrf

        {{-- Company Selection Dropdown --}}
        <div class="mb-3">
            <label class="form-label">Company</label>
            <select name="company_id" class="form-select" required>
                <option value="">Select a Company</option>
                @foreach($companies as $company)
                    <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}>
                        {{ $company->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Department Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <button type="submit" class="btn btn-success">Save Department</button>
        <a href="{{ route('departments.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
