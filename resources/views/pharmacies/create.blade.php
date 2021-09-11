@extends('layouts.app')

@section('content')
<nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('pharmacies.index') }}">Pharmacies</a></li>
            <li class="breadcrumb-item active" aria-current="page">New Creation</li>
        </ol>
</nav>
<form action="{{ route('pharmacies.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') ?? '' }}" required />
    </div>
    <div class="mb-3">
        <label for="address" class="form-label">Address</label>
        <textarea class="form-control" id="address" name="address" rows="5" required>{{ old('address') ?? '' }}</textarea>
    </div>
    <div class="mb-3">
        <label for="code" class="form-label">Code</label>
        <input type="text" class="form-control" id="code" name="code" value="{{ old('code') ?? '' }}" required />
    </div>

    <button type="submit" class="btn btn-lg btn-success mt-3">Save</button>
</form>
@endsection