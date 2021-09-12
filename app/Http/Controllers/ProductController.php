<?php

namespace App\Http\Controllers;

use App\Http\Repositories\IProductRepository;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productRepo;

    public function __construct(IProductRepository $productRepository)
    {
        $this->productRepo = $productRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->productRepo->paginate(25);

        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

        return redirect()->route('products.index')->with('success', 'Product Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($productID)
    {
        $product = $this->productRepo->find($productID);
        $pharmacies = $product->pharmacies()->paginate(10);

        return view('products.show', compact(['product', 'pharmacies']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($productID)
    {
        $product = $this->productRepo->find($productID);
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

        return redirect()
            ->route('products.show', ['product' => $productID])
            ->with('success', 'Product updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->back();
    }

    public function search(Request $request)
    {
        return $this->productRepo->search($request->search);
    }
}
