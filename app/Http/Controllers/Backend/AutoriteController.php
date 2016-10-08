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
    public function index($level,$id, Request $request)
    {
        $autorites = $this->autorite->findBy($level,$id);

        if($request->ajax())
        {
            echo view('backend.communes.partials.autorite')->with(['autorites' => $autorites]);
            exit;
        }

        return view('backend.autorites.index')->with(['autorites' => $autorites, 'level' => $level]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($level,$id)
    {
        if($level == 'canton')
        {
            $canton = $this->canton->find($id);
            $data   = [];
        }
        else
        {
            $district = $this->district->find($id);
            $canton   = $this->canton->find($district->canton_id);
            $data['district_id'] = $district->id;
        }

        $districts = $canton->districts;

        return view('backend.autorites.create')->with(['canton' => $canton, 'level' => $level, 'districts' => $districts, 'selected' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $level = $request->input('level',null);
        $level = ($level ? $level : 'canton');

        $this->autorite->create($request->all());

        return redirect('admin/autorites/'.$level.'/'.$request->input('canton_id'))->with(array('status' => 'success', 'message' => 'L\'autorite a été crée' ));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($level,$id)
    {
        $autorite  = $this->autorite->find($id);
        $canton    = $this->canton->find($autorite->canton_id);
        $districts = $canton->districts;

        return view('backend.autorites.show')->with(['autorite' => $autorite, 'districts' => $districts, 'level' => $level]);
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

        return redirect()->back()->with(array('status' => 'success', 'message' => 'Le autorite a été mis à jour' ));
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
}
