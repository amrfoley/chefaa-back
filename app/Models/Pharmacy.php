<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pharmacy extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'code', 'address'];
    
    protected $hidden = ['created_at', 'deleted_at', 'updated_at'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'pharmacy_product', 'pharmacy_id', 'product_id')
            ->whereNull('pharmacy_product.deleted_at')
            ->withPivot('price', 'status', 'quantity');
    }
}
