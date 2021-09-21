<?php
namespace App\Services;

use Illuminate\Http\Request;
use App\Repositories\Eloquent\PharmachyProductRepository;

class PharmacyProductService
{
    protected $pharmacyProductRepo;

    public function __construct(PharmachyProductRepository $pharmacyProductRepository)
    {
        $this->pharmacyProductRepo = $pharmacyProductRepository;
    }

    public function destroy(int $pharmacyID, int $productID)
    {
        return $this->pharmacyProductRepo->delete($pharmacyID, $productID);
    }

    public function cheapest(int $productID, int $limit = 5)
    {
        return $this->pharmacyProductRepo->cheapest($productID, $limit);
    }

    public function create(Request $request)
    {
        return $this->pharmacyProductRepo->create($this->validateReq($request));
    }

    public function update(Request $request, int $pharmacyID, int $productID)
    {
        return $this->pharmacyProductRepo->update($pharmacyID, $productID, $this->validateReq($request));
    }

    protected function validateReq(Request $request)
    {
        $data = $request->validate([
            'price'     => 'required|numeric|between:1,9999.99',
            'quantity'  => 'required|integer|between:1,9999999',
            'status'    => 'required|boolean',
            'product_id'   => 'required|exists:products,id',
            'pharmacy_id'   => 'required|exists:pharmacies,id',
        ]);

        return $data;
    }
}