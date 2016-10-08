<?php namespace App\Droit\Menu\Repo;

use App\Droit\Menu\Repo\MenuInterface;
use App\Droit\Menu\Entities\Menu as M;

class MenuEloquent implements MenuInterface{

    protected $menu;

    public function __construct(M $menu)
    {
        $this->menu = $menu;
    }

    public function getAll()
    {
        return $this->menu->orderBy('rang', 'desc')->get();
    }

    public function find($id)
    {
        return $this->menu->find($id);
    }

    public function create(array $data){

        $menu = $this->menu->create(array(
            'titre'       => $data['titre'],
            'contenu'     => $data['contenu'],
            'titre_de'    => $data['titre_de'],
            'contenu_de'  => $data['contenu_de'],
            'rang'        => (isset($data['rang']) ? $data['rang'] : 0),
            'link'        => \Str::slug($data['titre']),
        ));

        if( ! $menu )
        {
            return false;
        }

        return $menu;

    }

    public function update(array $data){

        $menu = $this->menu->findOrFail($data['id']);

        if( ! $menu )
        {
            return false;
        }

        $menu->fill($data);
        $menu->save();

        return $menu;
    }

    public function delete($id){

        $menu = $this->menu->find($id);

        return $menu->delete($id);

    }

    public function updateSorting(array $data){

        if(!empty($data))
        {
            foreach($data as $rang => $id)
            {
                $menu = $this->find($id);

                if( ! $menu )
                {
                    return false;
                }

                $menu->rang = $rang;
                $menu->save();
            }

            return true;
        }
    }

}
