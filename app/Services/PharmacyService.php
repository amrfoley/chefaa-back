<?php
namespace App\Services;

use App\Repositories\IPharmacyRepository;
use Illuminate\Http\Request;

class PharmacyService
{
    protected $pharmacyRepo;

    public function __construct(IPharmacyRepository $pharmacyRepository)
    {
        $this->pharmacyRepo = $pharmacyRepository;
    }

    public function paginate(int $per_page = 25)
    {
        return $this->pharmacyRepo->paginate($per_page);
    }

    public function find(int $pharmacyID)
    {
        return $this->pharmacyRepo->find($pharmacyID);
    }

    public function destroy(int $pharmacyID)
    {
        return $this->pharmacyRepo->delete($pharmacyID);
    }

    public function withProducts(int $pharmacyID, int $productID = null)
    {
        return $productID === null ? $this->pharmacyRepo->withPaginated($pharmacyID, 'products', 25) :
            $this->pharmacyRepo->with($pharmacyID, 'products', $productID);
    }

    public function create(Request $request)
    {
        return $this->pharmacyRepo->create($this->validateReq($request));
    }

    public function update(Request $request, int $pharmacyID)
    {
        return $this->pharmacyRepo->update($this->validateReq($request, $pharmacyID), $pharmacyID);
    }

    protected function validateReq(Request $request, int $pharmacyID = null)
    {
        $request->validate([
            'name'      => 'required|max:120',
            'address'   => 'required|max:120',
            'code'      => 'required|max:120|unique:pharmacies,code'.($pharmacyID !== null ? ",$pharmacyID" : '')
        ]);

        return $request->only(['name', 'address', 'code']);
    }
}