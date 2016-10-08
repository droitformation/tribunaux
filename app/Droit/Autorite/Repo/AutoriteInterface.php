<?php namespace App\Droit\Autorite\Repo;

interface AutoriteInterface {

    public function getAll();
    public function find($id);
    public function findByDistrictAndCanton($canton_id,$autorite_id);
    public function findBy($level,$id);
    public function create(array $data);
    public function update(array $data);
    public function delete($id);

}