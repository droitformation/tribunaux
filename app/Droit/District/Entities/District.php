<?php namespace App\Droit\District\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class District extends Model{

    protected $table = 'districts';

    protected $fillable = ['nom','nom_de','tribunal','tribunal_de','canton_id','special_id'];

    protected $dates = ['created_at','updated_at'];

    public function getMultipleAutoriteAttribute()
    {
        $this->load('autorites');

        return ($this->autorites->count() > 1 ? true : false);
    }

    public function getNomTransAttribute()
    {
        $locale = (\Session::has('locale') ? \Session::get('locale') : '');

        return ($locale == 'de' ? $this->nom_de : $this->nom);
    }

    public function getTribunalTransAttribute()
    {
        $locale = (\Session::has('locale') ? \Session::get('locale') : '');

        return ($locale == 'de' ? $this->tribunal_de : $this->tribunal);
    }

    public function canton(){

        return $this->belongsTo('App\Droit\Canton\Entities\Canton', 'canton_id');
    }

    public function autorites(){

        return $this->hasMany('App\Droit\Autorite\Entities\Autorite', 'district_id', 'id');
    }

    public function communes(){

        return $this->hasMany('App\Droit\Commune\Entities\Commune', 'district_id', 'id');
    }

    public function extras()
    {
        return $this->belongsToMany('App\Droit\Extra\Entities\Extra', 'extra_relations', 'district_id', 'extra_id');
    }
}