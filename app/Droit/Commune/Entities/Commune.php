<?php namespace App\Droit\Commune\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Commune extends Model{

    protected $table = 'communes';

    protected $fillable = ['nom','nom_de','canton_id','district_id','autorite_id'];

    protected $dates = ['created_at','updated_at'];

    public function getNomTransAttribute()
    {
        $locale = (\Session::has('locale') ? \Session::get('locale') : '');

        return ($locale == 'de' ? $this->nom_de : $this->nom);
    }

    public function canton(){

        return $this->belongsTo('App\Droit\Canton\Entities\Canton', 'canton_id');
    }

    public function district(){

        return $this->belongsTo('App\Droit\District\Entities\District', 'district_id');
    }

    public function autorite(){

        return $this->belongsTo('App\Droit\Autorite\Entities\Autorite', 'autorite_id');
    }
}