<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\ExtraRequest;
use App\Http\Controllers\Controller;

use App\Droit\Extra\Repo\ExtraInterface;
use App\Droit\Extra\Repo\RelationInterface;
use App\Droit\Canton\Repo\CantonInterface;

class ExtraController extends Controller
{
    protected $extra;
    protected $relation;
    protected $canton;

    public function __construct(ExtraInterface $extra, RelationInterface $relation, CantonInterface $canton)
    {
        $this->extra    = $extra;
        $this->relation = $relation;
        $this->canton   = $canton;
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
            if(!$extra->district->isEmpty()){
                return $extra->district->map(function ($item, $key) {
                    return 'districts-'.$item->id;
                })->toArray();
            }

            if(!$extra->autorite->isEmpty()){
                return $extra->autorite->map(function ($item, $key) {
                    return 'autorites-'.$item->id;
                })->toArray();
            }

            return 'canton-'.$extra->canton_id;
        });

/*        echo '<pre>';
        print_r($extras->toArray());
        echo '</pre>';exit();*/

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
        $extra  = $this->extra->find($id);
        $canton = $this->canton->find($extra->canton_id);

        return view('backend.extras.show')->with(['extra' => $extra, 'canton' => $canton]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(ExtraRequest $request)
    {
        $this->extra->create($request->all());

        return redirect('admin/extra/canton/'.$request->input('canton_id'))->with(['status' => 'success', 'message' => 'L\'adresse a été crée']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id,ExtraRequest $request)
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

        return redirect()->back()->with(['status' => 'success', 'message' => 'L\'adresse a été supprimé']);
    }

    public function addRelation(Request $request)
    {
        $data = array_filter($request->input('relation'));

        if(!empty($data))
        {
            foreach ($data as $model => $relation)
            {
                $this->relation->create(['extra_id' => $request->input('id'), $model => $relation]);
            }
        }

        return redirect()->back()->with(['status' => 'success', 'message' => 'Relation ajouté']);
    }

    public function relation($id)
    {
        $this->relation->delete($id);

        return redirect()->back()->with(['status' => 'success', 'message' => 'La relation a été supprimé']);
    }
}
