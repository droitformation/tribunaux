<?php namespace App\Droit\District\Repo;

interface DistrictTitleInterface {

    public function create(array $data);
    public function delete($id);

}