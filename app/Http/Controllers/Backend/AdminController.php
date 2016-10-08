<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Droit\Canton\Repo\CantonInterface;
use App\Droit\Autorite\Repo\AutoriteInterface;
use App\Droit\District\Repo\DistrictInterface;
use App\Droit\Commune\Repo\CommuneInterface;
use App\Droit\Tribunaux\Repo\TribunauxInterface;
use App\Droit\Menu\Repo\MenuInterface;

class AdminController extends Controller
{
    protected $canton;
    protected $district;
    protected $autorite;
    protected $commune;
    protected $tribunaux;
    protected $menu;

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
     *
     * @return Response
     */
    public function index()
    {
        $cantons = $this->canton->getAll();

        return view('backend.index')->with(['cantons' => $cantons]);
    }

}
