<?php
namespace App\Http\Repositories\Eloquent;

use App\Models\Pharmacy;
use App\Http\Repositories\IPharmacyRepository;

class PharmachyRepository extends BaseRepository implements IPharmacyRepository
{
    protected $model;

    public function __construct(Pharmacy $pharmacy)
    {
        $this->model = $pharmacy;
    }
}