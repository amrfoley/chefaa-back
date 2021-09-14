<?php

namespace App\Http\Controllers;

use App\Models\Pharmacy;
use App\Models\PharmacyProduct;
use App\Models\Product;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {}

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::count();
        $pharmacies = Pharmacy::count();
        $quantity = PharmacyProduct::sum('quantity');
        return view('home', compact(['products', 'pharmacies', 'quantity']));
    }
}
