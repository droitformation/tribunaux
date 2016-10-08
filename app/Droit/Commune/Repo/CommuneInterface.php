<?php namespace App\Droit\Commune\Repo;

interface CommuneInterface {

    public function getAll();
    public function find($data);
    public function findBy($level,$id);
    public function create(array $data);
    public function update(array $data);
    public function delete($id);

}