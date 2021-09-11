<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductPharmacy extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['price', 'status', 'quantity', 'product_id', 'pharmacy_id'];

    protected $table = 'product_pharmacy';
}
