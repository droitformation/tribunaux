<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\extraRequest;
use App\Http\Controllers\Controller;

use App\Droit\Extra\Repo\ExtraInterface;
use App\Droit\Canton\Repo\CantonInterface;

class ExtraController extends Controller
{
    protected $extra;
    protected $canton;

    public function __construct(ExtraInterface $extra, CantonInterface $canton)
    {
        $this->extra  = $extra;
        $this->canton = $canton;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($canton)
    {
        $canton = $this->canton->find($canton);

        $extras = $canton->extras->groupBy(function ($extra, $key)
        {
            if(!$extra->districts->isEmpty()){
                return $extra->districts->map(function ($item, $key) {
                    return 'districts-'.$item->id;
                })->toArray();
            }

            if(!$extra->autorites->isEmpty()){
                return $extra->autorites->map(function ($item, $key) {
                    return 'autorites-'.$item->id;
                })->toArray();
            }

            return 'cantons-'.$extra->canton_id;
        });

        return view('backend.extras.index')->with(['canton' => $canton, 'extras' => $extras]);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($canton)
    {
        $canton = $this->canton->find($canton);

        return view('backend.extras.create')->with(['canton' => $canton]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function show($id)
    {
        $extra = $this->extra->find($id);

        return view('backend.extras.show')->with(['extra' => $extra]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(extraRequest $request)
    {
        $canton = $this->canton->find($request->input('canton_id'));

        $canton->extras()->create($request->all());

        return redirect('admin/canton/'.$request->input('canton_id'))->with(['status' => 'success', 'message' => 'L\'adresse a été crée']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id,extraRequest $request)
    {
        $this->extra->update($request->all());

        return redirect()->back()->with(['status' => 'success', 'message' => 'L\'adresse a été édité']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->extra->delete($id);

        return redirect()->back()->with(array('status' => 'success', 'message' => 'L\'adresse a été supprimé' ));
    }

    public function sorting(Request $request)
    {
        $data = $request->all();

        $extras = $this->extra->updateSorting($data['rang']);

        print_r($data);
    }
}
