<?php


namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    protected $model;

    public function __construct() {
        $this->model = app($this->getModelClass());
    }

    abstract protected function getModelClass();

    protected function startQuery() {
        return clone $this->model;
    }

    public function getAll()
    {
        return $this->startQuery()->all();
    }

    public function getOne($id)
    {
        return $this->startQuery()->find($id);
    }

    public function getCount()
    {
        return $this->startQuery()->count();
    }

}
