<?php namespace App\Droit\District\Entities;

use Illuminate\Database\Eloquent\Model;

class District_titles extends Model{

    protected $table = 'district_titles';

    protected $fillable = ['nom','position','canton_id'];

    protected $dates = ['created_at','updated_at'];

    public function canton(){

        return $this->belongsTo('App\Droit\Canton\Entities\Canton', 'canton_id');
    }
}