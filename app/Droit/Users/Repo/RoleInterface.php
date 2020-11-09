<?php

namespace App\Acme\Users\Repo;

interface RoleInterface {
    public function getAll();
    public function find($data);
    public function create(array $data);
    public function update(array $data);
    public function delete($id);
}