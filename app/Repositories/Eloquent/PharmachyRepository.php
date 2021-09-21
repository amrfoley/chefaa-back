<?php
namespace App\Repositories\Eloquent;

use App\Models\Pharmacy;
use App\Repositories\IPharmacyRepository;

class PharmachyRepository extends BaseRepository implements IPharmacyRepository
{
    protected $model;

    public function __construct(Pharmacy $pharmacy)
    {
        $this->model = $pharmacy;
    }

    public function with($pharmacyID, $relation, $relationID)
    {
        $pharmacy = $this->model->find($pharmacyID);

        return $pharmacy->$relation ? 
            $pharmacy->setRelation($relation, $pharmacy->$relation()->find($relationID)) : $pharmacy;
    }

    public function withPaginated($pharmacyID, $relation, $perPage)
    {
        $pharmacy = $this->model->find($pharmacyID);

        return $pharmacy->$relation ? 
            $pharmacy->setRelation($relation, $pharmacy->$relation()->paginate($perPage)) : $pharmacy;
    }
}