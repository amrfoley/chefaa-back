<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\File;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title', 'description', 'image', 'sku'];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    protected static function booted()
    {
        static::deleted(function ($product) {
            if (!empty($product->image) && 
                File::exists(public_path(substr($product->image, strpos($product->image, 'storage/'))))
            ) {
                File::delete(public_path(substr($product->image, strpos($product->image, 'storage/'))));
            }
        });
    }

    public function pharmacies()
    {
        return $this->belongsToMany(Pharmacy::class, 'pharmacy_product', 'product_id', 'pharmacy_id')
            ->whereNull('pharmacy_product.deleted_at')
            ->withPivot('price', 'status', 'quantity');
    }

    public function getImageAttribute($image)
    {
        return !empty($image) ? ((strpos($image, 'http') === false) ? asset('storage/'.$image) : $image) : '';
    }
}
