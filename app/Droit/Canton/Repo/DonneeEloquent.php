<?php namespace App\Droit\Canton\Repo;

use App\Droit\Canton\Repo\DonneeInterface;
use App\Droit\Canton\Entities\Canton_donnees as M;

class DonneeEloquent implements DonneeInterface{

    protected $donnee;

    public function __construct(M $donnee)
    {
        $this->donnee = $donnee;
    }

    public function getAll(){

        return $this->donnee->orderBy('rang','ASC')->get();
    }

    public function updateSorting(array $data){

        if(!empty($data))
        {
            foreach($data as $rang => $id)
            {
                $donnee = $this->find($id);

                if( ! $donnee )
                {
                    return false;
                }

                $donnee->rang = $rang;
                $donnee->save();
            }

            return true;
        }
    }

    public function find($id){

        return $this->donnee->with(['canton'])->find($id);
    }

    public function create(array $data){

        $donnee = $this->donnee->create(array(
            'titre'      => $data['titre'],
            'titre_de'   => $data['titre_de'],
            'contenu'    => $data['contenu'],
            'contenu_de' => $data['contenu_de'],
            'rang'       => $data['rang']
        ));

        if( ! $donnee )
        {
            return false;
        }

        return $donnee;

    }

    public function update(array $data){

        $donnee = $this->donnee->findOrFail($data['id']);

        if( ! $donnee )
        {
            return false;
        }

        $donnee->fill($data);

        $donnee->save();

        return $donnee;
    }

    public function delete($id){

        $donnee = $this->donnee->find($id);

        return $donnee->delete($id);

    }
}
