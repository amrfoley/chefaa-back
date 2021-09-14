<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Repositories\IPharmacyProductRepository;
use App\Http\Repositories\IPharmacyRepository;

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
    
    public function create($pharmacyID)
    {
        return response()->json([
            'pharmacy' => $this->pharmacyRepo->find($pharmacyID)
        ]);
    }

    public function store(Request $request, $pharmacyID)
    {
        $data = $request->validate([
            'price'     => 'required|numeric|between:1,9999.99',
            'quantity'  => 'required|integer|between:1,9999999',
            'product_id'   => 'required|exists:products,id',
        ]);

        $data['status']         = $request->status ? 1 : 0;
        $data['pharmacy_id']    = $this->pharmacyRepo->find($pharmacyID);

        $this->pharmacyProductRepo->create($data);

        return response()->json(['success' => true]);
    }

    public function edit($pharmacyID, $productID)
    {
        return response()->json([
            'pharmacy' => $this->pharmacyRepo->with($pharmacyID, 'products', $productID)
        ]);
    }

    public function update(Request $request, $pharmacyID, $productID)
    {
        $data = $request->validate([
            'price'     => 'required|numeric|between:1,9999.99',
            'quantity'  => 'required|integer|between:1,9999999'
        ]);

        $data['status'] = $request->status === 'on' ? 1 : 0;

        $this->pharmacyProductRepo->update($pharmacyID, $productID, $data);

        return response()->json(['success' => true]);
    }

    public function destroy($pharmacyID, $productID)
    {
        $this->pharmacyProductRepo->delete($pharmacyID, $productID);

        return response()->json(['success' => true]);
    }
}
