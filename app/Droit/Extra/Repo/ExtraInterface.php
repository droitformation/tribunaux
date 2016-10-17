<?php namespace App\Droit\Extra\Repo;

interface ExtraInterface {

    public function getAll();
    public function find($data);
    public function create(array $data);
    public function update(array $data);
    public function updateSorting(array $data);
    public function delete($id);

}