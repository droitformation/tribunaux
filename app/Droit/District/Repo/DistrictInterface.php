<?php namespace App\Droit\District\Repo;

interface DistrictInterface {

    public function getAll();
    public function find($id);
    public function findBy($level,$id);
    public function create(array $data);
    public function update(array $data);
    public function delete($id);

}