<?php
namespace App\Repositories;

interface IPharmacyRepository extends IRepository 
{
    public function with($pharmacyID, $relation, $relationID);
    public function withPaginated($pharmacyID, $relation, $perPage);
}