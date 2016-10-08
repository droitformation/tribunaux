<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Droit\Tribunaux\Repo\TribunauxInterface;
use App\Droit\Canton\Repo\CantonInterface;

class TribunauxController extends Controller
{
    protected $tribunaux;
    protected $canton;

    public function __construct(CantonInterface $canton, TribunauxInterface $tribunaux)
    {
        $this->tribunaux = $tribunaux;
        $this->canton    = $canton;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $tribunaux = $this->tribunaux->getAll();

        return view('backend.tribunaux.index')->with(['tribunaux' => $tribunaux]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $cantons  = $this->canton->getAll();

        return view('backend.tribunaux.create')->with(['cantons' => $cantons]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $tribunal = $this->tribunaux->create($request->all());

        return redirect('admin/tribunaux/'.$tribunal->id)->with(array('status' => 'success', 'message' => 'Le tribunal a été crée' ));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $tribunal = $this->tribunaux->find($id);
        $cantons  = $this->canton->getAll();

        return view('backend.tribunaux.show')->with(['tribunal' => $tribunal, 'cantons' => $cantons]);
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
        $this->tribunaux->update($request->all());

        return redirect()->back()->with(array('status' => 'success', 'message' => 'Le tribunal a été édité' ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->tribunaux->delete($id);

        return redirect()->back()->with(array('status' => 'success', 'message' => 'Le tribunal a été supprimé' ));
    }
}
