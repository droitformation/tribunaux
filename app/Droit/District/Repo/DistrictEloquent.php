<?php namespace App\Droit\District\Repo;

use App\Droit\District\Repo\DistrictInterface;
use App\Droit\District\Entities\District as M;

class DistrictEloquent implements DistrictInterface{

    protected $district;

    public function __construct(M $district)
    {
        $this->district = $district;
    }

    public function getAll(){

        return $this->district->all();
    }

    public function find($id){

        return $this->district->with(['canton','autorites','communes','extras'])->find($id);
    }

    public function findBy($level,$id)
    {
        $level = $level.'_id';

        return $this->district->with(['canton','autorites','communes','extras'])->where($level,'=',$id)->get();
    }

    public function create(array $data){

        $district = $this->district->create(array(
            'nom'         => $data['nom'],
            'nom_de'      => $data['nom_de'],
            'tribunal'    => $data['tribunal'],
            'tribunal_de' => $data['tribunal_de'],
            'canton_id'   => $data['canton_id'],
            'special_id'  => (isset($data['special_id']) && $data['special_id'] ? $data['special_id'] : 0),
        ));

        if( ! $district )
        {
            return false;
        }

        return $district;

    }

    public function update(array $data){

        $district = $this->district->findOrFail($data['id']);

        if( ! $district )
        {
            return false;
        }

        $district->fill($data);
        $district->save();

        return $district;
    }

    public function delete($id){

        $district = $this->district->find($id);

        return $district->delete($id);

    }
}
