<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Droit\District\Repo\DistrictInterface;
use App\Droit\District\Repo\DistrictTitleInterface;
use App\Droit\Canton\Repo\CantonInterface;

class TitleController extends Controller
{
    protected $district;
    protected $title;
    protected $canton;

    public function __construct(DistrictInterface $district, DistrictTitleInterface $title, CantonInterface $canton)
    {
        $this->district = $district;
        $this->title    = $title;
        $this->canton   = $canton;
    }

    public function show($id)
    {
        $canton = $this->canton->find($id);

        $titles = isset($canton->districts) && !$canton->districts->isEmpty() ? $canton->districts : collect([]);
        $titles = $titles->isEmpty() && isset($canton->autorites) && !$canton->autorites->isEmpty() ? $canton->autorites : $titles;

        $titles = $titles->map(function ($item, $key) {
            $position = isset($item->title) ? explode(',',$item->title->position) : [10,10];
            $position = ['x' => $position[0], 'y' => $position[1]];

            return [
                'id'       => $item->id,
                'nom'      => $item->nom,
                'type'     => $item instanceof \App\Droit\District\Entities\District ? 'title_district' : 'title_autorite',
                'position' => $position,
            ];
        });

        return view('backend.districts.titles')->with(['canton' => $canton, 'titles' => $titles]);
    }

    public function store(Request $request)
    {
        $canton = $this->canton->find($request->input('canton_id'));

        $ids       = $request->input('id');
        $positions = $request->input('position');
        $type      = $request->input('type');

        $data = collect($ids)->mapWithKeys(function($id,$key)  use ($positions){
            return [ $id => ['position'  => $positions[$key]]];
        });

        $canton->$type()->sync($data);

        return redirect()->back();
    }
}
