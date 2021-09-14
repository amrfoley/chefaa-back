<?php

namespace App\Http\Controllers;

use App\Http\Repositories\IPharmacyProductRepository;
use App\Http\Repositories\IPharmacyRepository;
use Illuminate\Http\Request;

class PharmacyProductController extends Controller
{
    protected $pharmacyRepo, $pharmacyProductRepo;

    public function __construct(
        IPharmacyRepository $pharmacyRepository,
        IPharmacyProductRepository $iPharmacyProductRepository
    ) {
        $this->pharmacyRepo         = $pharmacyRepository;
        $this->pharmacyProductRepo  = $iPharmacyProductRepository;
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($pharmacyID)
    {
        return view('pharmacyproduct.create', [
            'pharmacy' => $this->pharmacyRepo->find($pharmacyID)
        ]);
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
        $data['pharmacy_id']    = $this->pharmacyRepo->find($pharmacyID)->id;

        $this->pharmacyProductRepo->create($data);

        return redirect()->route('pharmacies.show', $pharmacyID)->with('success', 'Product imported');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($pharmacyID, $productID)
    {
        return view('pharmacyproduct.edit', [
            'pharmacy' => $this->pharmacyRepo->with($pharmacyID, 'products', $productID)
        ]);
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
        $data = $request->validate([
            'price'     => 'required|numeric|between:1,9999.99',
            'quantity'  => 'required|integer|between:1,9999999'
        ]);

        $data['status'] = $request->status === 'on' ? 1 : 0;

        $this->pharmacyProductRepo->update($pharmacyID, $productID, $data);

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
        $this->pharmacyProductRepo->delete($pharmacyID, $productID);

        return redirect()->route('pharmacies.show', $pharmacyID)->with('success', 'product detached');
    }
}
