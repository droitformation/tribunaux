<?php namespace App\Droit\Extra\Repo;

use App\Droit\Extra\Repo\ExtraInterface;
use App\Droit\Extra\Entities\Extra as M;

class ExtraEloquent implements ExtraInterface{

    protected $extra;

    public function __construct(M $extra)
    {
        $this->extra = $extra;
    }

    public function getAll(){

        return $this->extra->with(['canton'])->orderBy('rang','ASC')->get();
    }

    public function updateSorting(array $data){

        if(!empty($data))
        {
            foreach($data as $rang => $id)
            {
                $extra = $this->find($id);

                if( ! $extra )
                {
                    return false;
                }

                $extra->rang = $rang;
                $extra->save();
            }

            return true;
        }
    }

    public function find($id){

        return $this->extra->with(['canton'])->find($id);
    }

    public function create(array $data){

        $extra = $this->extra->create(array(
            'titre'      => $data['titre'],
            'titre_de'   => $data['titre_de'],
            'contenu'    => $data['contenu'],
            'contenu_de' => $data['contenu_de'],
            'rang'       => isset($data['rang']) ? $data['rang'] : 0,
        ));

        if( ! $extra )
        {
            return false;
        }

        return $extra;

    }

    public function update(array $data){

        $extra = $this->extra->findOrFail($data['id']);

        if( ! $extra )
        {
            return false;
        }

        $extra->fill($data);

        $extra->save();

        return $extra;
    }

    public function delete($id)
    {
        $extra = $this->extra->find($id);

        return $extra->delete($id);
    }
}
