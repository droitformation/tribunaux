<?php namespace App\Droit\Titre\Repo;

use App\Droit\Titre\Repo\TitreInterface;
use App\Droit\Titre\Entities\Titre as M;

class TitreEloquent implements TitreInterface{

    protected $titre;

    public function __construct(M $titre)
    {
        $this->titre = $titre;
    }

    public function getAll()
    {
        return $this->titre->all();
    }

    public function find($id)
    {
        return $this->titre->find($id);
    }

    public function create(array $data){

        $titre = $this->titre->create(array(
            'canton_id'    => $data['canton_id'],
            'titre'    => $data['titre'],
            'titre_de' => $data['titre_de'],
            'sous_de'  => isset($data['sous_de']) ? $data['sous_de']: '',
            'sous'     => isset($data['sous']) ? $data['sous']: '',
        ));

        if( ! $titre )
        {
            return false;
        }

        return $titre;
    }

    public function update(array $data){

        $titre = $this->titre->findOrFail($data['id']);

        if( ! $titre ) {
            return false;
        }

        $titre->fill($data);
        $titre->save();

        return $titre;
    }

    public function delete($id){

        $titre = $this->titre->find($id);

        return $titre->delete($id);
    }
}
