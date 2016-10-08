<?php namespace App\Droit\Extra\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Extra extends Model{

    protected $table = 'extras';

    protected $fillable = array('titre','titre_de','contenu','contenu_de','canton_id');

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