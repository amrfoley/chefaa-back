<?php
namespace App\Repositories\Eloquent;

use App\Repositories\IPharmacyProductRepository;
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
        return $this->model->where('pharmacy_id', $pharmacyID)->where('product_id', $productID)->delete();
    }

    public function update($pharmacyID, $productID, $data)
    {
        return $this->model->where('pharmacy_id', $pharmacyID)->where('product_id', $productID)->update($data);
    }

    public function create($data)
    {
        return $this->model->create($data);
    }

    public function cheapest(int $productID, int $limit)
    {
        $products = $this->model->where('product_id', $productID)->orderby('price', 'asc')->limit($limit)->get();

        return $products->map(function($pharmacyProduct) {
            return [
                'id'        => $pharmacyProduct->product->id,
                'title'     => $pharmacyProduct->product->title,
                'prices'    => $pharmacyProduct->price
            ];
        });
    }
}