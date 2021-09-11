<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(25);

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

        $newProduct = Product::create($data);

        if($request->hasFile('image'))
        {
            $this->saveImage($newProduct, $request->file('image'));
        }

        return redirect()->route('products.index')->with('success', 'Product Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $pharmacies = $product->pharmacies()->paginate(10);
        return view('products.show', compact(['product', 'pharmacies']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'title'         => 'required|max:160',
            'description'   => 'required|max:260',
            'image'         => 'image|mimes:jpeg,png,jpg,gif,svg|max:200',
            'sku'           => 'required|unique:products,sku,'.$product->id
        ]);

        $product->update($data);

        if($request->hasFile('image'))
        {
            $this->saveImage($product, $request->file('image'));
        }

        return redirect()
            ->route('products.show', ['product' => $product])
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

    protected function saveImage(Product $product, $img)
    {
        // Get filename with the extension
        $filenameWithExt = $img->getClientOriginalName();
        // Get just filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        // Get just ext
        $extension = $img->getClientOriginalExtension();
        // Filename to store
        $fileNameToStore= $filename.'_'.time().'.'.$extension;
        // Upload Image
        $img->storeAs('public/images', $fileNameToStore);

        $product->image = 'images/'.$fileNameToStore;
        $product->save();

        return true;
    }

    public function search(Request $request)
    {
        return Product::select(['id', 'title'])
            ->where('title', 'LIKE', "%$request->q%")
            ->orWhere('sku', 'LIKE', "%$request->q%")
            ->get();
    }
}
