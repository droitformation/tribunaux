<?php namespace App\Droit\Canton\Repo;

interface DonneeInterface {

    public function getAll();
    public function find($data);
    public function create(array $data);
    public function update(array $data);
    public function updateSorting(array $data);
    public function delete($id);

}