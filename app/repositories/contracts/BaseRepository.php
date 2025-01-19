<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use stdClass;

abstract class BaseRepository
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getAll(): array|Collection
    {
        return $this->model->get();
    }

    public function create($modelDto): Model
    {
        return $this->model->create(
            (array) $modelDto
        );
    }
 
    public function update($modelDto): stdClass|null|bool
    {
        return $this->findOne($modelDto->id)->update((array) $modelDto);
    }

    public function findOne(string $id): Model
    {
        return $this->model->findOrFail($id);
    }

    public function findBy(string $column, string $operator = '=', string $value): Model|null
    {
        return $this->model->where(
            $column,
            $operator,
            $value
        )->first();
    }

    public function delete(string $id): void
    {
        $this->findOne($id)->delete();
    }

}