<?php namespace App\Droit\Users\Repo;

use App\Droit\Users\Repo\UserInterface;
use App\Droit\Users\Entities\User as M;

class UserEloquent implements UserInterface{

    protected $user;

    public function __construct(M $user)
    {
        $this->user = $user;
    }

    public function getAll(){

        return $this->user->get();
    }

    public function find($id){

        return $this->user->findOrFail($id);
    }

    public function create(array $data){

        $user = $this->user->create(array(
            'name'           => $data['name'],
            'email'          => $data['email'],
            'password'       => (isset($data['password']) ? bcrypt($data['password']) : ''),
            'created_at'     => date('Y-m-d G:i:s'),
            'updated_at'     => date('Y-m-d G:i:s')
        ));

        if( ! $user ) {
            return false;
        }

        return $user;
    }

    public function update(array $data){

        $user = $this->user->findOrFail($data['id']);

        if( ! $user ) {
            return false;
        }

        $user->name   = $data['name'];
        $user->email  = $data['email'];

        if(!empty($data['password'])) {
            $user->password   = bcrypt($data['password']);
        }

        $user->updated_at = date('Y-m-d G:i:s');

        $user->save();

        return $user;
    }

    public function delete($id){

        $user = $this->user->find($id);

        return $user->delete($id);
    }

}
