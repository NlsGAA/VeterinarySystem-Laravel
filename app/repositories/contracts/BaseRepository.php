<?php

namespace App\Repositories\Contracts;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use stdClass;

abstract class BaseRepository
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getAll(Request $filter = null)
    {
        if(!empty($filter->statusCode))
        {
            return $this->model
                        ->where('motivoCadastro', 'like', $filter->statusCode)
                        ->get()
                        ->toArray();
        }

        return $this->model->all();
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

    public function findBy(string $column, string $value): Model|null
    {
        return $this->model->where($column, $value)->first();
    }

    public function delete(string $id): void
    {
        $this->findOne($id)->delete();
    }

}