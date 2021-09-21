<?php
namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

interface IProductRepository extends IRepository
{
    public function ajaxSearch($query);
    public function search($query, $perPage);
    public function saveImage($imageFile, $productID);
    public function withPaginated($pharmacyID, $relation, $options, $perPage);
}