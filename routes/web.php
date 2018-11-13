<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('new', ['uses' => 'HomeController@carte']);

Route::get('/', ['uses' => 'HomeController@index']);
Route::get('communes', ['uses' => 'HomeController@communes']);
Route::get('tribunal/{id}', ['uses' => 'HomeController@tribunal']);

Route::get('canton/{id}', ['uses' => 'NiveauController@canton']);
Route::get('district/{id}', ['uses' => 'NiveauController@district']);
Route::get('autorite/{id}', ['uses' => 'NiveauController@autorite']);
Route::get('commune/{id}', ['uses' => 'NiveauController@commune']);

Route::post('search', ['uses' => 'NiveauController@search']);

/*
|--------------------------------------------------------------------------
| Backend Routes
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function()
{
    Route::get('/', ['uses' => 'Backend\AdminController@index']);
    Route::get('export', ['uses' => 'Backend\AdminController@export']);

    Route::get('canton/map/{id}', 'Backend\CantonController@map');
    Route::resource('canton', 'Backend\CantonController');

    Route::get('districts/canton/{id}', 'Backend\DistrictController@index');
    Route::get('district/create/{id}', 'Backend\DistrictController@create');
    Route::resource('district', 'Backend\DistrictController');

    Route::resource('title', 'Backend\TitleController');

    Route::get('autorites/canton/{id}', 'Backend\AutoriteController@index');
    Route::get('autorite/create/{id}', 'Backend\AutoriteController@create');
    Route::resource('autorite', 'Backend\AutoriteController');

    Route::get('communes/canton/{id}', 'Backend\CommuneController@index');
    Route::get('commune/create/{id}', 'Backend\CommuneController@create');
    Route::resource('commune', 'Backend\CommuneController');

    Route::get('extra/canton/{canton}', 'Backend\ExtraController@index');
    Route::get('extra/create/{id}', 'Backend\ExtraController@create');
    Route::delete('extra/relation/{id}', 'Backend\ExtraController@relation');
    Route::post('extra/relation', 'Backend\ExtraController@addRelation');
    Route::resource('extra', 'Backend\ExtraController');

    Route::get('donnee/create/{id}', 'Backend\DonneeController@create');
    Route::post('donnee/sorting', 'Backend\DonneeController@sorting');
    Route::resource('donnee', 'Backend\DonneeController');

    Route::get('adresses/{id}', 'Backend\TribunauxDonneeController@index');
    Route::get('adresse/create/{id}', 'Backend\TribunauxDonneeController@create');
    Route::resource('adresse', 'Backend\TribunauxDonneeController');

    Route::resource('tribunaux', 'Backend\TribunauxController');
    Route::resource('menu', 'Backend\MenuController');
    Route::resource('titre', 'Backend\TitreController');

    Route::post('upload', 'Backend\UploadController@upload');
    Route::post('uploadFile', 'Backend\UploadController@uploadFile');
    Route::post('uploadJS', 'Backend\UploadController@uploadJS');
    Route::post('uploadRedactor', 'Backend\UploadController@uploadRedactor');

    Route::get('imageJson/{id?}', ['uses' => 'Backend\UploadController@imageJson']);
    Route::get('fileJson/{id?}', ['uses' => 'Backend\UploadController@fileJson']);

});

// AJAX
Route::group(['prefix' => 'ajax', 'middleware' => 'auth'], function()
{
    Route::get('autorites/{type}/{id}', 'Backend\AutoriteController@dropdown');

});

// Authentication routes...
Auth::routes();

/*
|--------------------------------------------------------------------------
| Languages Routes
|--------------------------------------------------------------------------
*/
Route::get('/setlang/{lang}', function($lang)
{
    \Session::put('locale', $lang);

    return Redirect::back();
});

// Test routes for development
Route::get('testing', function()
{

    function extract_emails($str){
        // This regular expression extracts all emails from a string:
        $regexp = '/([a-z0-9_\.\-])+\@(([a-z0-9\-])+\.)+([a-z0-9]{2,4})+/i';
        preg_match_all($regexp, $str, $m);

        return isset($m[0]) ? $m[0] : array();
    }

    $cantons   = \App::make('App\Droit\Canton\Repo\CantonInterface');
    $autorites = \App::make('App\Droit\Autorite\Repo\AutoriteInterface');
    $districts = \App::make('App\Droit\District\Repo\DistrictInterface');
    $tribunaux  = \App::make('App\Droit\Tribunaux\Repo\TribunauxInterface');

    $all_canton = $cantons->getAll();

    $adresses = $all_canton->pluck('extras')->flatten(1)->map(function ($item, $key) {
       return extract_emails($item->contenu);
    })->flatten()->unique()->implode('<br/>');

/*    $adresses = $all_canton->pluck('districts')->flatten(1)->map(function ($item, $key) {
        return $item;
    })->flatten()->unique()->implode('<br/>');

    return [
        extract_emails($item->deuxieme),
        extract_emails($item->premier),
        extract_emails($item->siege),
    ];*/

    echo '<pre>';
    print_r($adresses);
    echo '</pre>';exit();

});
