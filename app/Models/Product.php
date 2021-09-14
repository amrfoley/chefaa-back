<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title', 'description', 'image', 'sku'];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function pharmacies()
    {
        return $this->belongsToMany(Pharmacy::class, 'pharmacy_product', 'product_id', 'pharmacy_id')
            ->whereNull('pharmacy_product.deleted_at')
            ->withPivot('price', 'status', 'quantity');
    }
}
