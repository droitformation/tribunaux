<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Droit\Canton\Repo\CantonInterface;
use App\Droit\Autorite\Repo\AutoriteInterface;
use App\Droit\District\Repo\DistrictInterface;
use App\Droit\Commune\Repo\CommuneInterface;
use App\Droit\Tribunaux\Repo\TribunauxInterface;
use App\Droit\Menu\Repo\MenuInterface;

class HomeController extends Controller
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
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $communes  = $this->commune->getAll();
        $tribunaux = $this->tribunaux->getAll();

        return view('frontend.index')->with(['communes' => $communes, 'tribunaux' => $tribunaux]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function carte()
    {
        $communes  = $this->commune->getAll();
        $tribunaux = $this->tribunaux->getAll();

        return view('welcome')->with(['communes' => $communes, 'tribunaux' => $tribunaux]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function tribunal($id)
    {
        $tribunal = $this->tribunaux->find($id);

        return view('frontend.tribunal')->with(['tribunal' => $tribunal]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function communes()
    {
        $communes = $this->commune->getAll();

        return view('frontend.partials.communes')->with(['communes' => $communes]);
    }

}
