<?php

namespace App\Http\Controllers;

use App\Services\PharmacyProductService;
use App\Services\PharmacyService;
use Illuminate\Http\Request;

class PharmacyProductController extends Controller
{
    protected $pharmacyService, $pharmacyProductService;

    public function __construct(
        PharmacyService $pharmacyService,
        PharmacyProductService $iPharmacyProductService
    ) {
        $this->pharmacyService         = $pharmacyService;
        $this->pharmacyProductService  = $iPharmacyProductService;
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($pharmacyID)
    {
        return view('pharmacyproduct.create', [
            'pharmacy' => $this->pharmacyService->find($pharmacyID)
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
        $this->pharmacyProductService->create($request);

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
            'pharmacy' => $this->pharmacyService->withProducts($pharmacyID, $productID)
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
        $this->pharmacyProductService->update($request, $pharmacyID, $productID);

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
        $this->pharmacyProductService->destroy($pharmacyID, $productID);

        return redirect()->route('pharmacies.show', $pharmacyID)->with('success', 'product detached');
    }
}
