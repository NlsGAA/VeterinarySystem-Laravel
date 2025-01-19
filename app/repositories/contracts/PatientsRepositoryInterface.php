<?php 

namespace App\Repositories\Contracts;

interface PatientsRepositoryInterface extends BaseRepositoryInterface
{
    public function findAllPatients(?string $filterParam);
}