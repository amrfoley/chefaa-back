@extends('layouts.app')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('pharmacies.index') }}">Pharmacies</a></li>
        <li class="breadcrumb-item" aria-current="page"><a href="{{ route('pharmacies.show', $pharmacy->id) }}">{{ $pharmacy->name }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.show', $product->id) }}">{{ $product->title }}</a></li>
    </ol>
</nav>
<div class="card mb-5">
    <div class="row g-0">
        <div class="col-md-4">
            <img src="{{ (strpos($product->image, 'http') === false) ? asset('storage/'.$product->image) : $product->image }}" class="card-img-top" alt="product-image" />
        </div>
        <div class="col-md-8">
        <div class="card-body">
            <h1 class="card-title">{{ $product->title }}</h1>
            <p class="card-text">{{ $product->description }}</p>                        
            <p class="card-text"><small class="text-muted">sku: {{ $product->sku }}</small></p>
        </div>
        </div>
    </div>
</div>
<form action="{{ route('pharmacy.product.update', ['pharmacy' => $pharmacy, 'product' => $product]) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="price" class="form-label">Price</label>
        <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ old('price') ?? $product->pivot->price }}" />
    </div>
    <div class="mb-3">
        <label for="quantity" class="form-label">Quantity</label>
        <input type="number" class="form-control" id="quantity" name="quantity" value="{{ old('quantity') ?? $product->pivot->quantity }}" />
    </div>
    <div class="form-check form-switch mb-3">
        <input class="form-check-input" 
            type="checkbox" 
            id="status" 
            name="status"
            {{ $product->pivot->status === 1 ? 'checked' : '' }}
        />
        <label class="form-check-label" for="status">Availability</label>
    </div>

    <button type="submit" class="btn btn-lg btn-success mt-3">Save</button>
</form>
@endsection