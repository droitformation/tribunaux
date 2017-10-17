<?php namespace App\Droit\Canton\Repo;

use App\Droit\Canton\Repo\CantonInterface;
use App\Droit\Canton\Entities\Canton as M;

class CantonEloquent implements CantonInterface{

    protected $canton;

    public function __construct(M $canton)
    {
        $this->canton = $canton;
    }

    public function getAll(){

        return $this->canton->all();
    }

    public function find($id){

        return $this->canton->with(['districts','autorites','communes','canton_donnees','canton_tribunaux','tribunal_premier','tribunal_deuxieme','extras'])->find($id);
    }

    public function create(array $data){

        $canton = $this->canton->create(array(
            'title' => $data['title'],
            'code'  => $data['code']
        ));

        if( ! $canton )
        {
            return false;
        }

        return $canton;

    }

    public function update(array $data){

        $canton = $this->canton->findOrFail($data['id']);

        if( ! $canton )
        {
            return false;
        }

        $canton->title = $data['title'];
        $canton->code  = $data['code'];

        $canton->save();

        return $canton;
    }

    public function delete($id){

        $canton = $this->canton->find($id);

        return $canton->delete($id);

    }
}
