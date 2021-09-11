<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pharmacy extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'code', 'address'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_pharmacy', 'pharmacy_id', 'product_id')
            ->whereNull('product_pharmacy.deleted_at')
            ->withPivot('price', 'status', 'quantity');
    }
}
