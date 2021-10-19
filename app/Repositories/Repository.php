<?php

namespace App\Reopsitories;

use App\Interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class Reopsitory implements RepositoryInterface
{

    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;

    }

    public function index()
    {
       return $this->model->pagination(PAGINATION_NUMBER);
    }

    public function create(array $data)
    {
       return $this->model->create($data);
    }

    public function update(array $data, $id)
    {
        $record = $this->model->find($id);

        return $record->update($data);
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    // eager load database relationships

    public function with($relations)
    {
        return $this->model->with($relations);
    }
}

