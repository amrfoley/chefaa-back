<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\PharmacyService;

class PharmacyController extends Controller
{
    protected $pharmacyService;

    public function __construct(PharmacyService $pharmacyService)
    {
        $this->pharmacyService = $pharmacyService;
    }
    
    public function index()
    {
        return response()->json([
            'pharmacies' => $this->pharmacyService->paginate()
        ]);
    }

    public function show($pharmacyID)
    {
        return view('pharmacies.show', [
            'pharmacy' => $this->pharmacyService->withProducts($pharmacyID)
        ]);
    }
}
