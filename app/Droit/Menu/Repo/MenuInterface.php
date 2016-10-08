<?php namespace App\Droit\Menu\Repo;

interface MenuInterface {

    public function getAll();
    public function find($data);
    public function create(array $data);
    public function update(array $data);
    public function delete($id);
    public function updateSorting(array $data);
}