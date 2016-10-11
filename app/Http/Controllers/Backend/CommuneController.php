<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Droit\Autorite\Repo\AutoriteInterface;
use App\Droit\Canton\Repo\CantonInterface;
use App\Droit\District\Repo\DistrictInterface;
use App\Droit\Commune\Repo\CommuneInterface;

class CommuneController extends Controller
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
    public function index($level,$id)
    {
        $communes = $this->commune->findBy($level,$id);
        $where    = $this->$level->find($id);

        return view('backend.communes.index')->with(['communes' => $communes, 'level' => $level, 'id' => $id, 'where' => $where]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($level,$id)
    {
        $where = $this->$level->find($id);

        if($level == 'canton')
        {
            $canton    = $this->canton->find($id);
            $cantons   = $this->canton->getAll();
            $districts = $canton->districts;
            $autorites = $canton->autorites;

            $data['canton_id'] = $id;
        }

        if($level == 'district')
        {
            $cantons   = $this->canton->getAll();
            $district  = $this->district->find($id);
            $canton    = $this->canton->find($district->canton_id);
            $districts = $canton->districts;
            $autorites = $district->autorites;

            $data['canton_id']   = $district->canton_id;
            $data['district_id'] = $district->id;
        }

        if($level == 'autorite')
        {
            $cantons   = $this->canton->getAll();
            $autorite  = $this->autorite->find($id);
            $canton    = $this->canton->find($autorite->canton_id);
            $districts = $canton->districts;
            $autorites = $canton->autorites;

            $data['canton_id']   = $canton->id;
            $data['district_id'] = $autorite->district_id;
            $data['autorite_id'] = $autorite->id;
        }

        return view('backend.communes.create')->with(
            ['where' => $where, 'level' => $level, 'canton' => $canton, 'districts' => $districts, 'autorites' => $autorites, 'cantons' => $cantons, 'selected' => $data]
        );
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

        $id    = $request->input($level.'_id');

        $this->commune->create($request->all());

        return redirect('admin/communes/'.$level.'/'.$id)->with(array('status' => 'success', 'message' => 'La commune a été crée' ));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($level,$id)
    {
        $commune   = $this->commune->find($id);
        $canton    = $this->canton->find($commune->canton_id);
        $cantons   = $this->canton->getAll();
        $district  = $this->district->find($commune->district_id);
        $districts = $canton->districts;

        if($district)
        {
            $data['district_id'] = $commune->district_id;
            $autorites           = $district->autorites;
        }
        else
        {
            $autorites = $canton->autorites;
        }

        $data['canton_id']   = $commune->canton_id;
        $data['autorite_id'] = $commune->autorite_id;

        return view('backend.communes.show')->with(['commune' => $commune, 'level' => $level,'canton' => $canton, 'cantons' => $cantons,'districts' => $districts, 'autorites' => $autorites, 'selected' => $data]);
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
        $this->commune->update($request->all());

        return redirect()->back()->with(array('status' => 'success', 'message' => 'La commune a été mis à jour' ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->commune->delete($id);

        return redirect()->back()->with(array('status' => 'success', 'message' => 'Le commune a été supprimé' ));
    }
}
