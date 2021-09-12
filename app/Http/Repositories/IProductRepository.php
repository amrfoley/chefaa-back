<?php
namespace App\Http\Repositories;

use Illuminate\Database\Eloquent\Model;

interface IProductRepository extends IRepository
{
    public function search($query);
    public function saveImage($imageFile, $productID);
}