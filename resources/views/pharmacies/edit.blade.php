@extends('layouts.app')

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('pharmacies.index') }}">Pharmacies</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $pharmacy->title }}</li>
        </ol>
    </nav>
    <form action="{{ route('pharmacies.update', $pharmacy->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') ?? $pharmacy->name }}" />
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <textarea class="form-control" id="address" name="address" rows="5">{{ old('address') ?? $pharmacy->address }}</textarea>
        </div>
        <div class="mb-3">
            <label for="code" class="form-label">Code</label>
            <input type="text" class="form-control" id="code" name="code" value="{{ old('code') ?? $pharmacy->code }}" />
        </div>

        <button type="submit" class="btn btn-lg btn-success mt-3">Save</button>
    </form>
</div>
@endsection