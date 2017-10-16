<?php namespace App\Droit\District\Repo;

use App\Droit\District\Repo\DistrictTitleInterface;
use App\Droit\District\Entities\District_titles as M;

class DistrictTitleEloquent implements DistrictTitleInterface{

    protected $district_title;

    public function __construct(M $district_title)
    {
        $this->district_title = $district_title;
    }

    public function create(array $data){

        $district_title = $this->district_title->create(array(
            'nom'        => $data['nom'],
            'position'   => $data['position'],
            'canton_id'  => $data['canton_id'],
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ));

        if( ! $district_title ) {
            return false;
        }

        return $district_title;

    }

    public function delete($id){

        $district_title = $this->district_title->find($id);

        return $district_title->delete($id);
    }
}
