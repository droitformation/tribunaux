<?php namespace App\Droit\Extra\Repo;

use App\Droit\Extra\Repo\RelationInterface;
use App\Droit\Extra\Entities\Relation as M;

class RelationEloquent implements RelationInterface{

    protected $relation;

    public function __construct(M $relation)
    {
        $this->relation = $relation;
    }

    public function create(array $data)
    {
        $relation = $this->relation->create(array(
            'canton_id'   => isset($data['canton_id']) ? $data['canton_id'] : 0,
            'district_id' => isset($data['district_id']) ? $data['district_id'] : 0,
            'autorite_id' => isset($data['autorite_id']) ? $data['autorite_id'] : 0,
            'extra_id'    => $data['extra_id']
        ));

        if( ! $relation )
        {
            return false;
        }

        return $relation;

    }

    public function delete($id){

        $relation = $this->relation->find($id);

        return $relation->delete($id);
    }
}
