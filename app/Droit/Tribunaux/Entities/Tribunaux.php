<?php namespace App\Droit\Tribunaux\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tribunaux extends Model{

    protected $table = 'tribunaux';

    protected $fillable = ['titre','titre_de','canton_id','info','info_de','position'];
    /**
     * Set timestamps off
     */
    public $timestamps = false;

    public function getTitreTransAttribute()
    {
        $locale = (\Session::has('locale') ? \Session::get('locale') : '');

        return ($locale == 'de' ? $this->titre_de : $this->titre);
    }

    public function getAdresseTransAttribute()
    {
        $locale = (\Session::has('locale') ? \Session::get('locale') : '');

        return ($locale == 'de' ? $this->adresse_de : $this->adresse);
    }

    public function getInfoTransAttribute()
    {
        $locale = (\Session::has('locale') ? \Session::get('locale') : '');

        return ($locale == 'de' ? $this->info_de : $this->info);
    }

    public function tribunaux_donnees()
    {
        return $this->hasMany('App\Droit\Tribunaux\Entities\Tribunaux_donnees', 'tribunaux_id');
    }

}