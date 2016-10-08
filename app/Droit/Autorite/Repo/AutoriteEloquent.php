<?php namespace App\Droit\Autorite\Repo;

use App\Droit\Autorite\Repo\AutoriteInterface;
use App\Droit\Autorite\Entities\Autorite as M;

class AutoriteEloquent implements AutoriteInterface{

    protected $autorite;

    public function __construct(M $autorite)
    {
        $this->autorite = $autorite;
    }

    public function getAll(){

        return $this->autorite->all();
    }

    public function find($id){

        return $this->autorite->with(['canton','district','communes','extras'])->find($id);
    }

    public function findBy($level,$id)
    {
        $level = $level.'_id';

        return $this->autorite->with(['canton','district','communes','extras'])->where($level,'=',$id)->get();
    }

    public function findByDistrictAndCanton($canton_id,$district_id)
    {
        return $this->autorite->where('canton_id','=',$canton_id)->where('district_id','=',$district_id)->get();
    }

    public function create(array $data){

        $autorite = $this->autorite->create(array(
            'nom'         => $data['nom'],
            'nom_de'      => $data['nom_de'],
            'siege'       => $data['siege'],
            'siege_de'    => $data['siege_de'],
            'canton_id'   => $data['canton_id'],
            'district_id' => (isset($data['district_id']) ? $data['district_id'] : null),
            'isMain'      => (isset($data['isMain']) && $data['isMain'] ? $data['isMain'] : 0),
        ));

        if( ! $autorite )
        {
            return false;
        }

        return $autorite;

    }

    public function update(array $data){

        $autorite = $this->autorite->findOrFail($data['id']);

        if( ! $autorite )
        {
            return false;
        }

        $autorite->fill($data);
        $autorite->save();

        return $autorite;
    }

    public function delete($id){

        $autorite = $this->autorite->find($id);

        return $autorite->delete($id);

    }
}
