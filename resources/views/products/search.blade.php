@extends('layouts.app')

@section('content')
<div class="container pt-2">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <form action="{{ route('products.search') }}" method="GET">
                <div class="mb-3">
                    <input type="text" class="form-control" name="search" value="{{request()->search ?? ''}}" placeholder="Search for products..." />
                </div>
            </form>
            @if($products)
                <div class="searched-products d-flex align-items-start flex-wrap">
                    @foreach($products as $product)
                    <a href="{{route('products.show', $product->id)}}" class="card m-1 p-1 text-decoration-none">
                        <div class="">
                            <img src="{{ $product->image }}?random={{ $product->id }}" style="width: 100%" class="card-img-top" alt="product-image" />
                            <div class="card-body">
                                <h1 class="card-title h4 text-dark">{{ $product->title }}</h1>
                                <p class="card-text h6 text-secondary">{{ $product->description }}</p>                        
                                <p class="card-text"><small class="text-muted">sku: {{ $product->sku }}</small></p>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
                <div class="d-flex justify-content-center mt-3">
                    {!! $products->appends(['search' => request()->search ?? ''])->links("pagination::bootstrap-4") !!}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection