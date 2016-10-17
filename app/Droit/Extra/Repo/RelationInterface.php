<?php namespace App\Droit\Extra\Repo;

interface RelationInterface {

    public function create(array $data);
    public function delete($id);
    
}