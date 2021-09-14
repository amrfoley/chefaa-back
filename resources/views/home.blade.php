@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-sm-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">All Products</h5>
        <p class="card-text">{{ $products }}</p>
        <a href="{{ route('products.index') }}" class="btn btn-primary">List All</a>
      </div>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">All Pharmacies</h5>
        <p class="card-text">{{ $pharmacies }}</p>
        <a href="{{ route('pharmacies.index') }}" class="btn btn-primary">List All</a>
      </div>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Products Quantity</h5>
        <p class="card-text">{{ $quantity }}</p>
      </div>
    </div>
  </div>
</div>
@endsection
