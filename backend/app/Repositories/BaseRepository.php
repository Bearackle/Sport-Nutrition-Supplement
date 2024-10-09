<?php

namespace App\Repositories;
use App\Repositories\Interfaces\RepositoryInterface;
abstract class BaseRepository implements RepositoryInterface{
    protected $model;
    public function __construct(){
        $this->setModel();
    }
    public function setModel(){
        $this->model = app()->make($this->getModel());
    }
    abstract public function getModel();// override, truyền model vào tương ứng
    
    public function getAll(){
        return $this->model->all();
    }
    public function find($id){
        return $this->model->find($id); 
    }
    public function create($attribute =[]){
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
    public function delete($id){
        $deleteTarget = $this->model->find($id);
        if($deleteTarget){
            $deleteTarget->delete();
            return true;
        }
        return false;
    }
}