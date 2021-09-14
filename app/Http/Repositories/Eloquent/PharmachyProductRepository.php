<?php
namespace App\Http\Repositories\Eloquent;

use App\Http\Repositories\IPharmacyProductRepository;
use App\Models\PharmacyProduct;

class PharmachyProductRepository implements IPharmacyProductRepository
{
    protected $model;

    public function __construct(PharmacyProduct $pharmacyProduct)
    {
        $this->model = $pharmacyProduct;
    }

    public function find($pharmacyID, $productID)
    {
        return $this->model->where('pharmacy_id', $pharmacyID)->where('product_id', $productID)->first();
    }

    public function delete($pharmacyID, $productID)
    {
        return $this->model->where('pharmacy_id', $pharmacyID)->where('product_id', $productID)->destroy();
    }

    public function update($pharmacyID, $productID, $data)
    {
        return $this->model->where('pharmacy_id', $pharmacyID)->where('product_id', $productID)->update($data);
    }

    public function create($data)
    {
        return $this->model->create($data);
    }
}