<?php namespace App\Droit\Extra\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Extra extends Model{

    protected $table = 'extras';

    protected $fillable = ['titre','titre_de','contenu','contenu_de','canton_id','rang'];

    protected $dates = ['created_at','updated_at'];

    public function getTitreTransAttribute()
    {
        $locale = (\Session::has('locale') ? \Session::get('locale') : '');

        return ($locale == 'de' ? $this->titre_de : $this->titre);
    }

    public function getContenuTransAttribute()
    {
        $locale = (\Session::has('locale') ? \Session::get('locale') : '');

        return ($locale == 'de' ? $this->contenu_de : $this->contenu);
    }

    public function canton(){

        return $this->belongsTo('App\Droit\Canton\Entities\Canton', 'canton_id');
    }

    public function districts(){

        return $this->belongsToMany('App\Droit\District\Entities\District', 'extra_relations', 'extra_id', 'district_id')->withPivot('id');
    }

    public function autorites(){

        return $this->belongsToMany('App\Droit\Autorite\Entities\Autorite', 'extra_relations', 'extra_id', 'autorite_id')->withPivot('id');
    }
}