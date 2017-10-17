<?php namespace App\Droit\District\Entities;

use Illuminate\Database\Eloquent\Model;

class Title extends Model{

    protected $table = 'titles';

    protected $fillable = ['district_id','canton_id','position'];

    protected $dates = ['created_at','updated_at'];

    public function canton(){

        return $this->belongsTo('App\Droit\Canton\Entities\Canton', 'canton_id');
    }

    public function district(){

        return $this->belongsTo('App\Droit\District\Entities\District','district_id');
    }
}