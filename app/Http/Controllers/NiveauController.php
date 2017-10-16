<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Droit\Canton\Repo\CantonInterface;
use App\Droit\Autorite\Repo\AutoriteInterface;
use App\Droit\District\Repo\DistrictInterface;
use App\Droit\Commune\Repo\CommuneInterface;
use App\Droit\Menu\Repo\MenuInterface;

class NiveauController extends Controller
{
    protected $canton;
    protected $district;
    protected $autorite;
    protected $commune;
    protected $menu;

    public function __construct(CantonInterface $canton,DistrictInterface $district, AutoriteInterface $autorite,CommuneInterface $commune, MenuInterface $menu)
    {
        $this->canton    = $canton;
        $this->district  = $district;
        $this->autorite  = $autorite;
        $this->commune   = $commune;
        $this->menu      = $menu;
    }

    /**
     * @param  int  $id
     * @return Response
     */
    public function canton($id)
    {
        $canton = $this->canton->find($id);
        
        if($canton->districts->count() == 0 && $canton->autorites->count() == 1)
        {
            return redirect('autorite/'.$canton->autorites->first()->id);
        }

        if($canton->districts->count() == 1)
        {
            return redirect('district/'.$canton->districts->first()->id);
        }

        return view('frontend.canton')->with(['canton' => $canton]);
    }

    /**
     * @param  int  $id
     * @return Response
     */
    public function district($id)
    {
        $district = $this->district->find($id);

        if($district->autorites->count() == 1) {
            return redirect('autorite/'.$district->autorites->first()->id);
        }

        $district->canton->load('canton_donnees','tribunal_premier','tribunal_deuxieme','extras');

        return view('frontend.district')->with(['district' => $district, 'canton' => $district->canton]);
    }

    /**
     * @param  int  $id
     * @return Response
     */
    public function autorite($id)
    {
        $autorite = $this->autorite->find($id);
        $autorite->canton->load('canton_donnees','tribunal_premier','tribunal_deuxieme','extras');

        return view('frontend.autorite')->with(['autorite' => $autorite, 'canton' => $autorite->canton]);
    }

    /**
     * @param  int  $id
     * @return Response
     */
    public function commune($id)
    {
        $commune = $this->commune->find($id);
        $commune->canton->load('canton_donnees','tribunal_premier','tribunal_deuxieme');

        return view('frontend.commune')->with(['commune' => $commune, 'canton' => $commune->canton]);
    }

    /**
     * @return Response
     */
    public function search(Request $request)
    {
        $term   = $request->input('search');
        $pieces = explode('-',$term);

        $niveau = $pieces[0];
        $id     = $pieces[1];

        $redirect = $niveau.'/'.$id;

        return redirect($redirect);
    }
}
