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

    Route::get('districts/{level}/{id}', 'Backend\DistrictController@index');
    Route::get('district/create/{level}/{id}', 'Backend\DistrictController@create');
    Route::get('district/{level}/{id}', 'Backend\DistrictController@show');
    Route::resource('district', 'Backend\DistrictController');

    Route::resource('title', 'Backend\TitleController');

    Route::get('autorites/{level}/{id}', 'Backend\AutoriteController@index');
    Route::get('autorite/create/{level}/{id}', 'Backend\AutoriteController@create');
    Route::get('autorite/{level}/{id}', 'Backend\AutoriteController@show');
    Route::resource('autorite', 'Backend\AutoriteController');

    Route::get('communes/{level}/{id}', 'Backend\CommuneController@index');
    Route::get('commune/create/{level}/{id}', 'Backend\CommuneController@create');
    Route::get('commune/{level}/{id}', 'Backend\CommuneController@show');
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

    Route::post('upload', 'Backend\UploadController@upload');
    Route::post('uploadFile', 'Backend\UploadController@uploadFile');
    Route::post('uploadJS', 'Backend\UploadController@uploadJS');
    Route::post('uploadRedactor', 'Backend\UploadController@uploadRedactor');

    Route::get('imageJson/{id?}', ['uses' => 'Backend\UploadController@imageJson']);
    Route::get('fileJson/{id?}', ['uses' => 'Backend\UploadController@fileJson']);

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

    $cantons = \App::make('App\Droit\Canton\Repo\CantonInterface');

    $canton = $cantons->find(1);

    echo '<pre>';
    print_r($canton);
    echo '</pre>';exit;
});
