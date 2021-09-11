<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title', 'description', 'image', 'sku'];

    public function pharmacies()
    {
        return $this->belongsToMany(Pharmacy::class, 'product_pharmacy', 'product_id', 'pharmacy_id')
            ->whereNull('product_pharmacy.deleted_at')
            ->withPivot('price', 'status', 'quantity');
    }
}
