<?php namespace App\Droit\Tribunaux\Repo;

use App\Droit\Tribunaux\Repo\TribunauxDonneeInterface;
use App\Droit\Tribunaux\Entities\Tribunaux_donnees as M;

class TribunauxDonneeEloquent implements TribunauxDonneeInterface{

    protected $tribunaux;

    public function __construct(M $tribunaux)
    {
        $this->tribunaux = $tribunaux;
    }

    public function getAll(){

        return $this->tribunaux->all();
    }

    public function find($id){

        return $this->tribunaux->find($id);
    }

    public function create(array $data){

        $tribunaux = $this->tribunaux->create(array(
            'titre'        => $data['titre'],
            'titre_de'     => $data['titre_de'],
            'contenu'      => $data['contenu'],
            'contenu_de'   => $data['contenu_de'],
            'tribunaux_id' => $data['tribunaux_id']
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
