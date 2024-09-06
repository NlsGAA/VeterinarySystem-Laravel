<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

interface BaseRepositoryInterface
{
    public function getAll(Request $filter = null);

    public function findOne(string $id): Model;

    // public function create(CreatePatientDTO $createPatientDTO): stdClass;

    // public function update(UpdatePatientDTO $updatePatientDTO): stdClass|null;

    public function delete(string $id): void;
}