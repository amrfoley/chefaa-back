@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('pharmacies.index') }}">Pharmacies</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $pharmacy->name }}</li>
                </ol>
            </nav>
            <div class="card mb-3">
                <div class="card-body">
                    <h1 class="card-title">{{ $pharmacy->name }}</h1>
                    <p class="card-text">{{ $pharmacy->address }}</p>                        
                    <p class="card-text"><small class="text-muted">Code: {{ $pharmacy->code }}</small></p>
                </div>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="py-3">
                    @if($products->count() > 0)
                        Has ({{ $products->total() }}) @choice('product|products', $products->total())
                    @else
                        No products available in this pharmacy
                    @endif
                </h3>
                <a href="{{ route('pharmacy.product.create', $pharmacy->id) }}" class="btn btn-lg btn-success">Import Product</a>
            </div>
            @if($products->count() > 0)
                <table class="table table-hover w-100">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Product</th>
                            <th scope="col">Image</th>
                            <th scope="col">Sku</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Status</th>
                            <th scope="col">Price</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>       
                    @foreach($products as $product)         
                        <tr>
                            <th scope="row">{{ $loop->index + 1 }}</th>
                            <td>{{ $product->title }}</td>
                            <td>
                                <img src="{{ (strpos($product->image, 'http') === false) ? asset('storage/'.$product->image) : $product->image.'?random='.$product->id }}" height="80px" alt="product-image" />
                            </td>
                            <td>{{ $product->sku }}</td>
                            <td>{{ $product->pivot->quantity }}</td>
                            <td>
                                @if($product->pivot->status)
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-toggle-on" viewBox="0 0 16 16">
                                    <path d="M5 3a5 5 0 0 0 0 10h6a5 5 0 0 0 0-10H5zm6 9a4 4 0 1 1 0-8 4 4 0 0 1 0 8z"/>
                                </svg>
                                @else
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-toggle-off" viewBox="0 0 16 16">
                                    <path d="M11 4a4 4 0 0 1 0 8H8a4.992 4.992 0 0 0 2-4 4.992 4.992 0 0 0-2-4h3zm-6 8a4 4 0 1 1 0-8 4 4 0 0 1 0 8zM0 8a5 5 0 0 0 5 5h6a5 5 0 0 0 0-10H5a5 5 0 0 0-5 5z"/>
                                </svg>
                                @endif
                            </td>
                            <td>{{ $product->pivot->price }}</td>
                            <td>
                                <div class="actions d-flex">
                                    <a href="{{ route('pharmacy.product.edit', ['product' => $product, 'pharmacy' => $pharmacy]) }}" class="btn btn-sm btn-outline-success mr-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                        </svg>
                                    </a>
                                    <form action="{{ route('pharmacy.product.destroy', ['product' => $product, 'pharmacy' => $pharmacy]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>   
                    @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-3">
                    {!! $products->links("pagination::bootstrap-4") !!}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection