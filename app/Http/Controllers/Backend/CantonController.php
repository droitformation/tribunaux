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
use App\Droit\Canton\Repo\CantonTribunauxInterface;
use App\Droit\Menu\Repo\MenuInterface;

class CantonController extends Controller
{
    protected $canton;
    protected $district;
    protected $autorite;
    protected $commune;
    protected $tribunaux;
    protected $menu;
    protected $canton_tribunaux;

    public function __construct(
        CantonInterface $canton,
        DistrictInterface $district,
        AutoriteInterface $autorite,
        CommuneInterface $commune,
        TribunauxInterface $tribunaux,
        MenuInterface $menu,
        CantonTribunauxInterface $canton_tribunaux
    )
    {
        $this->canton           = $canton;
        $this->district         = $district;
        $this->autorite         = $autorite;
        $this->commune          = $commune;
        $this->tribunaux        = $tribunaux;
        $this->canton_tribunaux = $canton_tribunaux;
        $this->menu             = $menu;
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $canton = $this->canton->find($id);

        return view('backend.cantons.show')->with(['canton' => $canton]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, Request $request)
    {
        $tribunal_deuxieme = $request->input('tribunal_deuxieme');
        $tribunal_premier  = $request->input('tribunal_premier');

        $this->canton_tribunaux->update($request->except('tribunal_premier','tribunal_deuxieme'));
        $this->canton_tribunaux->updateTribunaux($tribunal_deuxieme);
        $this->canton_tribunaux->updateTribunaux($tribunal_premier);

        return redirect()->back()->with(array('status' => 'success', 'message' => 'Les informations du canton ont été mises à jour' ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function map($id)
    {
        echo view('frontend.partials.map')->with(['id' => $id, 'canton' => '']);
        exit;
    }
}
