<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Repositories\IPharmacyRepository;
use Illuminate\Http\Request;

class PharmacyController extends Controller
{
    protected $pharmacyRepo;

    public function __construct(IPharmacyRepository $pharmacyRepository)
    {
        $this->pharmacyRepo = $pharmacyRepository;
    }
    
    public function index()
    {
        return response()->json([
            'pharmacies' => $this->pharmacyRepo->paginate(25)
        ]);
    }

    public function show($pharmacyID)
    {
        return view('pharmacies.show', [
            'pharmacy' => $this->pharmacyRepo->withPaginated($pharmacyID, 'products', 10)
        ]);
    }
}
