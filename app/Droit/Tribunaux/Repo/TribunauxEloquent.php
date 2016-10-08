<?php namespace App\Droit\Tribunaux\Repo;

use App\Droit\Tribunaux\Repo\TribunauxInterface;
use App\Droit\Tribunaux\Entities\Tribunaux as M;

class TribunauxEloquent implements TribunauxInterface{

    protected $tribunaux;

    public function __construct(M $tribunaux)
    {
        $this->tribunaux = $tribunaux;
    }

    public function getAll(){

        return $this->tribunaux->with(['tribunaux_donnees'])->get();
    }

    public function find($id){

        return $this->tribunaux->with(['tribunaux_donnees'])->find($id);
    }

    public function create(array $data){

        $tribunaux = $this->tribunaux->create(array(
            'titre'      => $data['titre'],
            'titre_de'   => $data['titre_de'],
            'info'       => $data['info'],
            'info_de'    => $data['info_de'],
            'canton_id'  => $data['canton_id'],
            'position'   => $data['position']
        ));

        if( ! $tribunaux )
        {
            return false;
        }

        return $tribunaux;

    }

    public function update(array $data){

        $tribunaux = $this->tribunaux->findOrFail($data['id']);

        if( ! $tribunaux )
        {
            return false;
        }

        $tribunaux->fill($data);
        $tribunaux->save();

        return $tribunaux;
    }

    public function delete($id){

        $tribunaux = $this->tribunaux->find($id);

        return $tribunaux->delete($id);

    }
}
