<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Droit\Autorite\Repo\AutoriteInterface;
use App\Droit\Canton\Repo\CantonInterface;
use App\Droit\District\Repo\DistrictInterface;
use App\Droit\Commune\Repo\CommuneInterface;

class AutoriteController extends Controller
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
    public function index($canton_id, Request $request)
    {
        $canton = $this->canton->find($canton_id);

        return view('backend.autorites.index')->with(['canton' => $canton]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($canton_id)
    {
        $canton = $this->canton->find($canton_id);

        return view('backend.autorites.create')->with(['canton' => $canton]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->autorite->create($request->all());

        return redirect('admin/autorites/canton/'.$request->input('canton_id'))->with(array('status' => 'success', 'message' => 'L\'autorite a été crée' ));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $autorite = $this->autorite->find($id);

        return view('backend.autorites.show')->with(['autorite' => $autorite]);
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
        $this->autorite->update($request->all());

        return redirect()->back()->with(array('status' => 'success', 'message' => 'L\'autorité a été mis à jour' ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->autorite->delete($id);

        return redirect()->back()->with(array('status' => 'success', 'message' => 'Le autorite a été supprimé' ));
    }

    public function dropdown($type,$id)
    {
        $list = $this->$type->find($id);

        echo view('backend.communes.partials.dropdown')->with(['list' => $list->autorites]);
    }
}
