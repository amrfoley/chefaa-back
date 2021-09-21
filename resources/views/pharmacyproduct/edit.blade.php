@extends('layouts.app')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('pharmacies.index') }}">Pharmacies</a></li>
        <li class="breadcrumb-item" aria-current="page"><a href="{{ route('pharmacies.show', $pharmacy->id) }}">{{ $pharmacy->name }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.show', $pharmacy->products->id) }}">{{ $pharmacy->products->title }}</a></li>
    </ol>
</nav>
<div class="card mb-5">
    <div class="row g-0">
        <div class="col-md-4">
            <img src="{{ (strpos($pharmacy->products->image, 'http') === false) ? asset('storage/'.$pharmacy->products->image) : $pharmacy->products->image }}" class="card-img-top" alt="product-image" />
        </div>
        <div class="col-md-8">
        <div class="card-body">
            <h1 class="card-title">{{ $pharmacy->products->title }}</h1>
            <p class="card-text">{{ $pharmacy->products->description }}</p>                        
            <p class="card-text"><small class="text-muted">sku: {{ $pharmacy->products->sku }}</small></p>
        </div>
        </div>
    </div>
</div>
<form action="{{ route('pharmacy.product.update', ['pharmacy' => $pharmacy, 'product' => $pharmacy->products]) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="price" class="form-label">Price</label>
        <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ old('price') ?? $pharmacy->products->pivot->price }}" />
    </div>
    <div class="mb-3">
        <label for="quantity" class="form-label">Quantity</label>
        <input type="number" class="form-control" id="quantity" name="quantity" value="{{ old('quantity') ?? $pharmacy->products->pivot->quantity }}" />
    </div>
    <div class="form-check form-switch mb-3">
        <input class="form-check-input" 
            type="checkbox" 
            name="status"
            id="product-status" 
            value="{{ $pharmacy->products->pivot->status }}"
            {{ $pharmacy->products->pivot->status === 1 ? 'checked' : '' }}
        />
        <label class="form-check-label" for="status">Availability</label>
    </div>
    <input type="hidden" name="pharmacy_id" value="{{ $pharmacy->id }}" />
    <input type="hidden" name="product_id" value="{{ $pharmacy->products->id }}" />
    <button type="submit" class="btn btn-lg btn-success mt-3">Save</button>
</form>
@endsection