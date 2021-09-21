@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('pharmacies.index') }}">Pharmacies</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('pharmacies.show', $pharmacy->id) }}">{{ $pharmacy->name }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Importing</li>
                </ol>
            </nav>
            <form action="{{ route('pharmacy.product.store', $pharmacy->id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="product-select">Select Product</label>
                    <select id="searching" class="form-control w-100" name="product_id" id="product-select"></select>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ old('price') ?? '' }}" />
                </div>
                <div class="mb-3">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" value="{{ old('quantity') ?? '' }}" />
                </div>
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" 
                        type="checkbox" 
                        id="status" 
                        name="status"
                        value="0"
                    />
                    <label class="form-check-label" for="status">Availability</label>
                </div>
                <input type="hidden" name="pharmacy_id" value="{{ $pharmacy->id }}">
                <button type="submit" class="btn btn-lg btn-success mt-3">Save</button>
            </form>
        </div>
    </div>
</div>
@endsection