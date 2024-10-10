<?php

namespace App\Repositories;
use App\Repositories\Interfaces\RepositoryInterface;
use Illuminate\Contracts\Container\BindingResolutionException;

abstract class BaseRepository implements RepositoryInterface{
    protected $model;

    /**
     * @throws BindingResolutionException
     */
    public function __construct(){
        $this->setModel();
    }

    /**
     * @throws BindingResolutionException
     */
    public function setModel(): void
    {
        $this->model = app()->make($this->getModel());
    }
    abstract public function getModel();// override, truyền model vào tương ứng

    public function getAll(){
        return $this->model->all();
    }
    public function find($id){
        return $this->model->find($id);
    }
    public function create($attribute = []){
        return $this->model->create($attribute);
    }
    public function update($id,$attribute=[]){
        $updateTarget = $this->model->find($id);
        if($updateTarget){
            $updateTarget->update($attribute);
            return $updateTarget;
        }
        return false;
    }
    public function delete($id): bool
    {
        $deleteTarget = $this->model->find($id);
        if($deleteTarget){
            $deleteTarget->delete();
            return true;
        }
        return false;
    }
}
