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

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'         => 'required|max:160',
            'description'   => 'required|max:260',
            'image'         => 'image|mimes:jpeg,png,jpg,gif,svg|max:200',
            'sku'           => 'required|unique:products,sku'
        ]);

        $product = $this->productRepo->create($data);

        if($request->hasFile('image'))
        {
            $this->productRepo->saveImage($request->file('image'), $product->id);
        }

        return response()->api(['success' => true], 200);
    }

    public function show($productID)
    {
        return response()->json([
            'product' => $this->productRepo->withPaginated($productID, 'pharmacies', 10)
        ]);
    }

    public function edit($productID)
    {
        return response()->json([
            'product' => $this->productRepo->find($productID)
        ]);
    }
    
    public function update(Request $request, $productID)
    {
        $data = $request->validate([
            'title'         => 'required|max:160',
            'description'   => 'required|max:260',
            'image'         => 'image|mimes:jpeg,png,jpg,gif,svg|max:200',
            'sku'           => 'required|unique:products,sku,'.$productID
        ]);

        unset($data['image']);

        $this->productRepo->update($data, $productID);

        if($request->hasFile('image'))
        {
            $this->productRepo->saveImage($request->file('image'), $productID);
        }

        return response()->api(['success' => true], 200);
    }

    public function destroy($productID)
    {
        $this->productRepo->delete($productID);

        return response()->api(['success' => true], 200);
    }

    public function search(Request $request)
    {
        return $this->productRepo->search($request->search);
    }
}
