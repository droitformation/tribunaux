<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Droit\Autorite\Repo\AutoriteInterface;
use App\Droit\Canton\Repo\CantonInterface;
use App\Droit\District\Repo\DistrictInterface;
use App\Droit\Commune\Repo\CommuneInterface;

class DistrictController extends Controller
{
    protected $autorite;
    protected $canton;
    protected $commune;
    protected $district;

    public function __construct(AutoriteInterface $autorite, CantonInterface $canton, DistrictInterface $district, CommuneInterface $commune)
    {
        $this->canton    = $canton;
        $this->autorite  = $autorite;
        $this->commune   = $commune;
        $this->district  = $district;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($canton_id,Request $request)
    {
        $canton = $this->canton->find($canton_id);

        return view('backend.districts.index')->with(['canton' => $canton]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($canton_id)
    {
        $canton = $this->canton->find($canton_id);

        return view('backend.districts.create')->with(['canton' => $canton]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->district->create($request->all());

        return redirect('admin/districts/canton/'.$request->input('canton_id'))->with(array('status' => 'success', 'message' => 'Le district a été crée' ));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $district = $this->district->find($id);

        return view('backend.districts.show')->with(['district' => $district]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $this->district->update($request->all());

        return redirect()->back()->with(array('status' => 'success', 'message' => 'Le district a été mis à jour' ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->district->delete($id);

        return redirect()->back()->with(array('status' => 'success', 'message' => 'Le district a été supprimé' ));
    }

}
