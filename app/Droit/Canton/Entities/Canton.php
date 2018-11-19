<?php namespace App\Droit\Canton\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Canton extends Model{

    protected $table = 'cantons';

    protected $fillable = ['titre','titre_de'];

    /**
     * Set timestamps off
     */
    public $timestamps = false;

    public function getMultipleDistrictAttribute()
    {
        $this->load('districts');

        return ($this->districts->count() > 1 ? true : false);
    }

    public function getMultipleAutoriteAttribute()
    {
        $this->load('autorites');

        return ($this->autorites->count() > 1 ? true : false);
    }

    public function getTitreTransAttribute()
    {
        $locale = (\Session::has('locale') ? \Session::get('locale') : '');

        return ($locale == 'de' ? $this->titre_de : $this->titre);
    }

    public function getIsSecondLevelAttribute()
    {
        return ($this->districts->isEmpty() && $this->autorites->count() == 1)
        //|| ($this->districts->count() > 0 && $this->autorites->count() == 1)
        || ($this->districts->isEmpty() && $this->autorites->isEmpty()) ? true : false;
    }

    public function getHasAutoriteAttribute()
    {
         if(isset($this->autorites) && !$this->autorites->isEmpty() && $this->autorites->first()->siege != '' && $this->districts->isEmpty()){
             return $this->autorites->first()->siege_trans;
         }
         elseif(!empty($this->canton_tribunaux->siege)){
             return $this->canton_tribunaux->siege;
         }
         else{
             return null;
         }
    }

    public function getDonneesSidebarAttribute()
    {
         if(!$this->canton_donnees->isEmpty())
         {
             return $this->canton_donnees->reject(function ($value, $key) {
                 return $value->advertise;
             });
         }

         return null;
    }

    public function getDonneesAdvertiseAttribute()
    {
        if(!$this->canton_donnees->isEmpty())
        {
            return $this->canton_donnees->filter(function ($value, $key) {
                return $value->advertise;
            });
        }

        return null;
    }

    public function canton_donnees()
    {
        return $this->belongsToMany('App\Droit\Canton\Entities\Canton_donnees', 'canton_donnees', 'canton_id','donnee_id')->withPivot('rang')->orderBy('rang');
    }

    public function canton_tribunaux()
    {
        return $this->hasOne('App\Droit\Canton\Entities\Canton_tribunaux');
    }

    public function titre_autorite()
    {
        return $this->hasOne('App\Droit\Titre\Entities\Titre');
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
    
    public function district_titles(){

        return $this->hasMany('App\Droit\District\Entities\Title', 'canton_id', 'id');
    }

    public function autorites(){

        return $this->hasMany('App\Droit\Autorite\Entities\Autorite', 'canton_id', 'id');
    }

    public function communes(){

        return $this->hasMany('App\Droit\Commune\Entities\Commune', 'canton_id', 'id');
    }

    public function extras()
    {
        return $this->hasMany('App\Droit\Extra\Entities\Extra','canton_id');
    }

    public function adresses()
    {
        return $this->belongsToMany('App\Droit\Extra\Entities\Extra', 'extra_relations', 'canton_id','extra_id');
    }

    public function title_district()
    {
        return $this->belongsToMany('App\Droit\District\Entities\District', 'titles', 'canton_id','district_id')
            ->with(['title']);
    }

    public function title_autorite()
    {
        return $this->belongsToMany('App\Droit\Autorite\Entities\Autorite', 'titles', 'canton_id','autorite_id')
            ->with(['title']);
    }
}