<?php

namespace App\Repositories\Abstract;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

abstract class BaseRepository
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

  
    public function all(array $columns = ['*']): Collection
    {
        return $this->model->get($columns);
    }

  
    public function find(int $id): ?Model
    {
        return $this->model->find($id);
    }

 
    public function create(array $data): Model
    {
        return $this->model->create($data);
    }


    public function delete(int $id): bool
    {
        return $this->findOrFail($id)->delete();
    }

    public function count(): int
    {
        return $this->model->count();
    }


    public function exists(int $id): bool
    {
        return $this->model->where('id', $id)->exists();
    }

    public function findActive(int $id): ?Model
    {
        return $this->model
            ->where('id', $id)
            ->where('is_active', true)
            ->first();
    }
}
