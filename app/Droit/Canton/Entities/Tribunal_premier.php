<?php namespace App\Droit\Canton\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tribunal_premier extends Model{

    protected $table = 'tribunal_premier';

    protected $fillable = ['canton_id','titre','titre_de'];

    protected $dates = ['created_at','updated_at'];

    public function getTitreTransAttribute()
    {
        $locale = (\Session::has('locale') ? \Session::get('locale') : '');

        return ($locale == 'de' ? $this->titre_de : $this->titre);
    }
}