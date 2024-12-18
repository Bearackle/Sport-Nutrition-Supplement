<?php

namespace App\Repositories\Interfaces;


interface RepositoryInterface{
    public function getAll();
    public function find($id);
    public function create($attribute=[]);
    public function update($id,$attribute=[]);
    public function delete($id);
}