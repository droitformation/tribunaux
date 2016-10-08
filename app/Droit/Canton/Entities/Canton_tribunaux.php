<?php namespace App\Droit\Canton\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Canton_tribunaux extends Model{

    protected $table = 'canton_tribunaux';

    protected $fillable = array('canton_id','deuxieme','premier','siege');
    /**
     * Set timestamps off
     */
    public $timestamps = false;

}