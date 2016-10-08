<?php namespace App\Droit\Tribunaux\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tribunaux_donnees extends Model{

    protected $table = 'tribunaux_donnees';

    protected $fillable = ['titre','titre_de','tribunaux_id','contenu','contenu_de'];
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


}