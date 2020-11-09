<?php namespace App\Acme\Users\Repo;

use App\Acme\Users\Repo\RoleInterface;
use App\Acme\Users\Entities\Role as M;

class RoleEloquent implements RoleInterface{

    protected $role;

    public function __construct(M $role)
    {
        $this->role = $role;
    }

    public function getAll(){

        return $this->role->all();
    }

    public function find($id){

        return $this->role->find($id);
    }

    public function create(array $data){

        $role = $this->role->create(array(
            'name' => $data['name']
        ));

        if( ! $role )
        {
            return false;
        }

        return $role;
    }

    public function update(array $data)
    {
        $role = $this->role->findOrFail($data['id']);

        if( ! $role )
        {
            return false;
        }

        $role->fill($data);
        $role->save();

        return $role;
    }

    public function delete($id)
    {
        $role = $this->role->find($id);

        return $role->delete();
    }
}
