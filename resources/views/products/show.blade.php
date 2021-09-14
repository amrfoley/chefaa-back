@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $product->title }}</li>
                </ol>
            </nav>
            <div class="card mb-5">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="{{ $product->image }}" class="card-img-top" alt="product-image" />
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
            @if($product->pharmacies->count() > 0)
                <h3 class="py-3">Available on ({{ $product->pharmacies->total() }}) @choice('pharmacy|pharmacies', $product->pharmacies->total())</h3>
                <table class="table table-hover w-100">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Pharmacy</th>
                            <th scope="col">Code</th>
                            <th scope="col">Address</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Status</th>
                            <th scope="col">Price</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>       
                    @foreach($product->pharmacies as $pharmacy)         
                        <tr>
                            <th scope="row">{{ $loop->index + 1 }}</th>
                            <td>{{ $pharmacy->name }}</td>
                            <td>{{ $pharmacy->code }}</td>
                            <td>{{ $pharmacy->address }}</td>
                            <td>{{ $pharmacy->pivot->quantity }}</td>
                            <td>
                                @if($pharmacy->pivot->status)
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-toggle-on" viewBox="0 0 16 16">
                                    <path d="M5 3a5 5 0 0 0 0 10h6a5 5 0 0 0 0-10H5zm6 9a4 4 0 1 1 0-8 4 4 0 0 1 0 8z"/>
                                </svg>
                                @else
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-toggle-off" viewBox="0 0 16 16">
                                    <path d="M11 4a4 4 0 0 1 0 8H8a4.992 4.992 0 0 0 2-4 4.992 4.992 0 0 0-2-4h3zm-6 8a4 4 0 1 1 0-8 4 4 0 0 1 0 8zM0 8a5 5 0 0 0 5 5h6a5 5 0 0 0 0-10H5a5 5 0 0 0-5 5z"/>
                                </svg>
                                @endif
                            </td>
                            <td>{{ $pharmacy->pivot->price }}</td>
                            <td>
                                <div class="actions d-flex">
                                    <a href="{{ route('pharmacy.product.edit', ['pharmacy' => $pharmacy, 'product' => $product]) }}" class="btn btn-sm btn-outline-success mr-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                        </svg>
                                    </a>
                                </div>
                            </td>
                        </tr>   
                    @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-3">
                    {!! $product->pharmacies->links("pagination::bootstrap-4") !!}
                </div>
            @else
                <h3 class="mt-5">No pharmacies has this product</h3>
            @endif
        </div>
    </div>
</div>
@endsection