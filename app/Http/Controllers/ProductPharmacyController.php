<?php

namespace App\Http\Controllers;

use App\Models\Pharmacy;
use App\Models\ProductPharmacy;
use Illuminate\Http\Request;

class ProductPharmacyController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Pharmacy $pharmacy)
    {
        return view('pharmacyproduct.create', compact('pharmacy'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $pharmacyID)
    {
        $data = $request->validate([
            'price'     => 'required|numeric|between:1,9999.99',
            'quantity'  => 'required|integer|between:1,9999999',
            'product_id'   => 'required|exists:products,id',
        ]);

        $data['status']         = $request->status ? 1 : 0;
        $data['pharmacy_id']    = $pharmacyID;

        ProductPharmacy::create($data);

        return redirect()->route('pharmacies.show', $pharmacyID)->with('success', 'Product imported');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Pharmacy $pharmacy, $productID)
    {
        $product = $pharmacy->products()->where('product_id', '=', $productID)->first();
        return view('pharmacyproduct.edit', compact(['product', 'pharmacy']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $pharmacyID, $productID)
    {
        $request->validate([
            'price'     => 'required|numeric|between:1,9999.99',
            'quantity'  => 'required|integer|between:1,9999999',
            'status'    => 'nullable'
        ]);

        $pharmacyProduct = ProductPharmacy::where([
            ['product_id', '=', $productID],
            ['pharmacy_id', '=', $pharmacyID]
        ])->first();

        $pharmacyProduct->price     = $request->price;
        $pharmacyProduct->quantity  = $request->quantity;
        $pharmacyProduct->status    = $request->status === 'on' ? 1 : 0;
        $pharmacyProduct->save();

        return redirect()->back()->with('success', "Product updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($pharmacyID, $productID)
    {
        ProductPharmacy::where([
            ['pharmacy_id', '=', $pharmacyID],
            ['product_id', '=', $productID]
        ])->delete();

        return redirect()->route('pharmacies.show', $pharmacyID)->with('success', 'product detached');
    }
}
