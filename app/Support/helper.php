<?php
/**
 * Created by PhpStorm.
 * User: cindyleschaud
 * Date: 18.10.17
 * Time: 09:29
 */

function the_titles($canton){

    $titles = isset($canton->districts) && !$canton->districts->isEmpty() ? $canton->districts : collect([]);
    $titles = $titles->isEmpty() && isset($canton->autorites) && !$canton->autorites->isEmpty() ? $canton->autorites : $titles;
    $titles = $titles->count() > 1 ? $titles : collect([]);

    return $titles->map(function ($item, $key) {

        $link = $item instanceof \App\Droit\District\Entities\District ? 'district' : 'autorite';

        $position = isset($item->title) ? explode(',',$item->title->position) : [10,10];
        $position = ['x' => $position[0], 'y' => $position[1]];

        return ['nom' => $item->nom, 'position' => $position, 'link' => url($link.'/'.$item->id)];
    });

}

function group_communes($communes)
{
    // Sort first
    $sorted = $communes->sortAccent('nom_trans','fr_FR');

    return $sorted->groupBy(function ($item, $key) {
        return isset($item->district) ? $item->district->nom : 0;
    })->map(function ($item, $key) {
        return $item->groupBy(function ($item, $key) {
            return isset($item->autorite) ? $item->autorite->nom : 0;
        });
    });
}

function slugify_string($string){
    $string   = preg_replace( "/\r|\n/", "", trim(strip_tags($string)) );
    $string   = preg_replace('/\s+/', '', $string);
    $string = preg_replace('~\x{00a0}~siu',' ',$string);
    $string = str_replace(' ', '', $string);
    return $string;
}