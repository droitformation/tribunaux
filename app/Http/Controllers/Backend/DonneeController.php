<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\DonneeRequest;
use App\Http\Controllers\Controller;

use App\Droit\Canton\Repo\DonneeInterface;
use App\Droit\Canton\Repo\CantonInterface;

class DonneeController extends Controller
{
    protected $donnee;
    protected $canton;

    public function __construct(DonneeInterface $donnee,CantonInterface $canton)
    {
        $this->donnee = $donnee;
        $this->canton = $canton;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($id)
    {
        $canton = $this->canton->find($id);

        return view('backend.donnees.create')->with(['canton' => $canton]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function show($id)
    {
        $donnee = $this->donnee->find($id);

        return view('backend.donnees.show')->with(['donnee' => $donnee]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(DonneeRequest $request)
    {
        $canton = $this->canton->find($request->input('canton_id'));

        $canton->canton_donnees()->create($request->all());

        return redirect('admin/canton/'.$request->input('canton_id'))->with(array('status' => 'success', 'message' => 'La remarque a été crée' ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id,DonneeRequest $request)
    {
        $this->donnee->update($request->all());

        return redirect()->back()->with(array('status' => 'success', 'message' => 'La remarque a été édité' ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->donnee->delete($id);

        return redirect()->back()->with(array('status' => 'success', 'message' => 'La remarque a été supprimé' ));
    }


    public function sorting(Request $request)
    {
        $data = $request->all();

        $donnees = $this->donnee->updateSorting($data['rang']);

        print_r($data);
    }
}
