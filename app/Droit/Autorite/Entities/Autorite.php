<?php namespace App\Droit\Autorite\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Autorite extends Model{

    protected $table = 'autorites';
    protected $dates = ['created_at','updated_at'];

    protected $fillable = ['nom','nom_de','siege','siege_de','canton_id','district_id','isMain'];

    public function getNomTransAttribute()
    {
        $locale = (\Session::has('locale') ? \Session::get('locale') : '');

        return ($locale == 'de' ? $this->nom_de : $this->nom);
    }

    public function getSiegeTransAttribute()
    {
        $locale = (\Session::has('locale') ? \Session::get('locale') : '');

        return ($locale == 'de' ? $this->siege_de : $this->siege);
    }

    public function canton(){

        return $this->belongsTo('App\Droit\Canton\Entities\Canton', 'canton_id');
    }

    public function district(){

        return $this->belongsTo('App\Droit\District\Entities\District');
    }

    public function communes(){

        return $this->hasMany('App\Droit\Commune\Entities\Commune', 'autorite_id', 'id');
    }

    public function extras()
    {
        return $this->belongsToMany('App\Droit\Extra\Entities\Extra', 'extra_relations', 'autorite_id', 'extra_id');
    }

}