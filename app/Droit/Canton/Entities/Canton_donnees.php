<?php namespace App\Droit\Canton\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Canton_donnees extends Model{

    protected $table = 'donnees';

    protected $fillable = ['titre','titre_de','contenu','contenu_de','rang','advertise'];
    /**
     * Set timestamps off
     */
    public $timestamps = false;

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

    public function canton()
    {
        return $this->belongsToMany('App\Droit\Canton\Entities\Canton', 'canton_donnees', 'donnee_id','canton_id');
    }
}