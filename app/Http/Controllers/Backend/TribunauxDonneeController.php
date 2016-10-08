<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Droit\Tribunaux\Repo\TribunauxInterface;
use App\Droit\Tribunaux\Repo\TribunauxDonneeInterface;

class TribunauxDonneeController extends Controller
{
    protected $tribunaux;
    protected $adresse;

    public function __construct(TribunauxDonneeInterface $adresse, TribunauxInterface $tribunaux)
    {
        $this->tribunaux = $tribunaux;
        $this->adresse   = $adresse;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function index($id)
    {
        $tribunal = $this->tribunaux->find($id);

        return view('backend.adresses.index')->with(['tribunal' => $tribunal]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($id)
    {
        $tribunal = $this->tribunaux->find($id);

        return view('backend.adresses.create')->with(['tribunal' => $tribunal]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $adresse = $this->adresse->create($request->all());

        return redirect('admin/adresse/'.$adresse->id)->with(array('status' => 'success', 'message' => 'Les données du tribunal ont été crées' ));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $adresse = $this->adresse->find($id);

        return view('backend.adresses.show')->with(['adresse' => $adresse]);
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
        $this->adresse->update($request->all());

        return redirect()->back()->with(array('status' => 'success', 'message' => 'Les données du tribunal ont été édité' ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->adresse->delete($id);

        return redirect()->back()->with(array('status' => 'success', 'message' => 'Les données du tribunal ont été supprimé' ));
    }
}
