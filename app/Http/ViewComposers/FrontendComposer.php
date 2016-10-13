<?php

namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;

use App\Droit\Canton\Repo\CantonInterface;
use App\Droit\Autorite\Repo\AutoriteInterface;
use App\Droit\District\Repo\DistrictInterface;
use App\Droit\Commune\Repo\CommuneInterface;
use App\Droit\Tribunaux\Repo\TribunauxInterface;
use App\Droit\Menu\Repo\MenuInterface;

class FrontendComposer
{
    protected $canton;
    protected $district;
    protected $autorite;
    protected $commune;
    protected $tribunaux;
    protected $menu;

    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct(CantonInterface $canton,DistrictInterface $district, AutoriteInterface $autorite,CommuneInterface $commune, TribunauxInterface $tribunaux, MenuInterface $menu)
    {
        $this->canton    = $canton;
        $this->district  = $district;
        $this->autorite  = $autorite;
        $this->commune   = $commune;
        $this->tribunaux = $tribunaux;
        $this->menu      = $menu;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $cantons   = $this->canton->getAll();
        $districts = $this->district->getAll();
        $autorites = $this->autorite->getAll();
        $communes  = $this->commune->getAll();
        $menus     = $this->menu->getAll();

        $view->with('cantons',$cantons);
        $view->with('districts',$districts);
        $view->with('autorites',$autorites);
        $view->with('communes',$communes);
        $view->with('menus',$menus);
    }
}