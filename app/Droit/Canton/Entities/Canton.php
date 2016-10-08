<?php namespace App\Droit\Canton\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Canton extends Model{

    protected $table = 'cantons';

    protected $fillable = array('titre','titre_de');

    /**
     * Set timestamps off
     */
    public $timestamps = false;

    public function getMultipleDistrictAttribute()
    {
        $this->load('districts');

        return ($this->districts->count() > 1 ? true : false);
    }

    public function getTitreTransAttribute()
    {
        $locale = (\Session::has('locale') ? \Session::get('locale') : '');

        return ($locale == 'de' ? $this->titre_de : $this->titre);
    }

    public function canton_donnees()
    {
        return $this->belongsToMany('App\Droit\Canton\Entities\Canton_donnees', 'canton_donnees', 'canton_id','donnee_id')->withPivot('rang')->orderBy('rang');
    }

    public function canton_tribunaux()
    {
        return $this->hasOne('App\Droit\Canton\Entities\Canton_tribunaux');
    }

    public function tribunal_premier()
    {
        return $this->hasOne('App\Droit\Canton\Entities\Tribunal_premier');
    }

    public function tribunal_deuxieme()
    {
        return $this->hasOne('App\Droit\Canton\Entities\Tribunal_deuxieme');
    }

    public function districts(){

        return $this->hasMany('App\Droit\District\Entities\District', 'canton_id', 'id');
    }

    public function autorites(){

        return $this->hasMany('App\Droit\Autorite\Entities\Autorite', 'canton_id', 'id');
    }

    public function communes(){

        return $this->hasMany('App\Droit\Commune\Entities\Commune', 'canton_id', 'id');
    }

    public function extras()
    {
        return $this->belongsToMany('App\Droit\Extra\Entities\Extra', 'extra_relations', 'canton_id','extra_id' );
    }

}