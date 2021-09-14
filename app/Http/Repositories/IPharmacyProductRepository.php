<?php
namespace App\Http\Repositories;

interface IPharmacyProductRepository 
{
    public function find($pharmacyID, $productID);
    public function delete($pharmacyID, $productID);
    public function update($pharmacyID, $productID, $data);
    public function create($data);
}