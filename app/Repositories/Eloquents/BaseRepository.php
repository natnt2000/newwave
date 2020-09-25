<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Contracts\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements EloquentRepositoryInterface
{
    protected $model;

    public function __construct()
    {
        $this->setModel();
    }

    abstract public function getModel();

    public function setModel()
    {
        $this->model = app()->make(
            $this->getModel()
        );
    }

    public function all($relations=[])
    {
        return $this->model->with($relations)->paginate(20);
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function create($data=[])
    {
        return $this->model->create($data);
    }

    public function update($data=[], $id)
    {
        $model = $this->model->find($id);
        if ($model) {
            $model->update($data);
        }
    }

    public function delete($id)
    {
        $model = $this->model->find($id);
        if ($model) {
            $model->delete();
        }
    }
}
