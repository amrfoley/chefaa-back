<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Repositories\IProductRepository;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productRepo;

    public function __construct(IProductRepository $productRepository)
    {
        $this->productRepo = $productRepository;
    }

    public function index()
    {
        return response()->json([
            'products' => $this->productRepo->paginate(25)
        ], 200);
    }

    public function show($productID)
    {
        return response()->json([
            'product' => $this->productRepo
                ->withPaginated($productID, 'pharmacies', [['status', 1]], 10)
        ]);
    }

    public function search(Request $request)
    {
        return $this->productRepo->searchPaginated($request->search, 25);
    }
}
