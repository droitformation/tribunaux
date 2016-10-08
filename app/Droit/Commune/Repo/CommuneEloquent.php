<?php namespace App\Droit\Commune\Repo;

use App\Droit\Commune\Repo\CommuneInterface;
use App\Droit\Commune\Entities\Commune as M;

class CommuneEloquent implements CommuneInterface{

    protected $commune;

    public function __construct(M $commune)
    {
        $this->commune = $commune;
    }

    public function getAll(){

        return $this->commune->all();
    }

    public function find($id){

        return $this->commune->with(['canton','district','autorite'])->find($id);
    }

    public function findBy($level,$id)
    {
        $level = $level.'_id';

        return $this->commune->with(['canton','district','autorite'])->where($level,'=',$id)->get();
    }

    public function create(array $data){

        $commune = $this->commune->create(array(
            'nom'         => $data['nom'],
            'nom_de'      => $data['nom_de'],
            'canton_id'   => $data['canton_id'],
            'district_id' => (isset($data['district_id']) ?  $data['district_id'] : null),
            'autorite_id' => (isset($data['autorite_id']) ?  $data['autorite_id'] : null),
        ));

        if( ! $commune )
        {
            return false;
        }

        return $commune;

    }

    public function update(array $data){

        $commune = $this->commune->findOrFail($data['id']);

        if( ! $commune )
        {
            return false;
        }

        $commune->fill($data);
        $commune->save();

        return $commune;
    }

    public function delete($id){

        $commune = $this->commune->find($id);

        return $commune->delete($id);

    }
}
