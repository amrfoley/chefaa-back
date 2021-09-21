<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        return response()->json([
            'products' => $this->productService->paginate()
        ], 200);
    }

    public function show($productID)
    {
        return response()->json([
            'product' => $this->productService->withPharmacies($productID, true)
        ]);
    }

    public function search(Request $request)
    {
        return $this->productService->search($request);
    }
}
