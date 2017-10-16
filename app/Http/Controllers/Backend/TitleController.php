<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Droit\District\Repo\DistrictInterface;
use App\Droit\District\Repo\DistrictTitleInterface;

class TitleController extends Controller
{
    protected $district;
    protected $title;

    public function __construct(DistrictInterface $district, DistrictTitleInterface $title)
    {
        $this->district  = $district;
        $this->title  = $title;
    }

    public function show($id)
    {
        $district = $this->district->find($id);

        return view('backend.districts.titles')->with(['district' => $district]);
    }

    public function store(Request $request)
    {
        $noms      = $request->input('nom');
        $positions = $request->input('position');
        $canton_id = $request->input('canton_id');

        $data = collect($noms)->map(function($nom,$key)  use ($positions,$canton_id){
            return $this->title->create([
                'nom'       => $nom,
                'position'  => $positions[$key],
                'canton_id' => $canton_id,
            ]);
        });

        echo '<pre>';
        print_r($data);
        echo '</pre>';exit();
    }
}
