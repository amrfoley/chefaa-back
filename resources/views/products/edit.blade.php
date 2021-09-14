@extends('layouts.app')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $product->title }}</li>
    </ol>
</nav>
<form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="product-title" class="form-label">Title</label>
        <input type="text" class="form-control" id="product-title" name="title" value="{{ old('title') ?? $product->title }}" required />
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" rows="5" required>{{ old('description') ?? $product->description }}</textarea>
    </div>
    <div class="mb-3">
        <label for="product-sku" class="form-label">Sku</label>
        <input type="text" class="form-control" id="product-sku" name="sku" value="{{ old('sku') ?? $product->sku }}" required />
    </div>
    <div class="mb-3">
        <div class="input-group mb-3">
            <input type="file" 
                id="upload-image"
                class="form-control" 
                name="image"
                accept="image/png, image/jpeg, image/jpg, image/gif"  style="height: 100%" />
        </div>
        <div class="my-4" id='img-upload'>
            <img src="{{ (old('image') ?? $product->image) }}" alt="product-image" width="200px" />
        </div>
    </div>
    <button type="submit" class="btn btn-lg btn-success mt-3">Save</button>
</form>
@endsection