<?php namespace App\Droit\Extra\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Relation extends Model{

    protected $table = 'extra_relations';

    protected $fillable = ['canton_id','district_id','autorite_id','extra_id'];

    /**
     * Set timestamps off
     */
    public $timestamps = false;
  
}