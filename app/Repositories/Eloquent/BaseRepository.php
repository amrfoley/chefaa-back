<?php
namespace App\Repositories\Eloquent;

use App\Repositories\IRepository;

abstract class BaseRepository implements IRepository
{
    protected $model;

    public function all()
    {
        return $this->model->all();
    }

    public function paginate($perpage = 25)
    {
        return $this->model->paginate($perpage);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $data, $id)
    {
        return $this->model->where('id', $id)->update($data);
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

}