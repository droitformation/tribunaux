<?php namespace App\Droit\Canton\Repo;

use App\Droit\Canton\Repo\TribunauxInterface;
use App\Droit\Canton\Entities\Canton_tribunaux as M;
use App\Droit\Canton\Entities\Tribunal_deuxieme as Deuxieme;
use App\Droit\Canton\Entities\Tribunal_premier as Premier;

class CantonTribunauxEloquent implements CantonTribunauxInterface{

    protected $tribunal;
    protected $deuxieme;
    protected $premier;

    public function __construct(M $tribunal, Deuxieme $deuxieme, Premier $premier)
    {
        $this->tribunal = $tribunal;
        $this->deuxieme = $deuxieme;
        $this->premier  = $premier;
    }

    public function getAll(){

        return $this->tribunal->all();
    }

    public function find($id){

        return $this->tribunal->with(['canton'])->find($id);
    }

    public function create(array $data){

        $tribunal = $this->tribunal->create(array(
            'title' => $data['title'],
            'code'  => $data['code']
        ));

        if( ! $tribunal )
        {
            return false;
        }

        return $tribunal;

    }

    public function update(array $data)
    {
        $tribunal = $this->tribunal->findOrFail($data['id']);

        if( ! $tribunal )
        {
            return false;
        }

        $tribunal->fill($data);
        $tribunal->save();

        return $tribunal;
    }

    public function updateTribunaux(array $data)
    {
        $tribunal = $this->tribunal->findOrFail($data['id']);

        if( ! $tribunal )
        {
            return false;
        }

        $tribunal->fill($data);
        $tribunal->save();

        return $tribunal;
    }

    public function delete($id){

        $tribunal = $this->tribunal->find($id);

        return $tribunal->delete($id);

    }
}
