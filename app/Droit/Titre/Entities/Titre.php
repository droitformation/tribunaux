<?php namespace App\Droit\Titre\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Titre extends Model{

    protected $table = 'titres_autorites';

    protected $fillable = array('canton_id','titre','titre_de','sous','sous_de');
    /**
     * Set timestamps off
     */
    public $timestamps = false;

    public function getTitreTransAttribute()
    {
        $locale = (\Session::has('locale') ? \Session::get('locale') : '');

        return ($locale == 'de' ? $this->titre_de : $this->titre);
    }
}