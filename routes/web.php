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

    Route::resource('user', 'Backend\UserController');

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


Route::get('migrate', function() {

    // Communes
/*  */
    $communes = App\Droit\Commune\Entities\Commune::all();
    $communes = $communes->mapWithKeys(function ($item) {return [$item->id => $item];});
    $old_communes = DB::connection('old')->select('select IDCommune,NomCommune,NomCommuneDe,refCanton,refDistrict,refAutorite from tbl_Communes');
    $old_communes = collect($old_communes)->map(function ($item) {
        return [
            'IDCommune'     => $item->IDCommune,
            'NomCommune'    => $item->NomCommune,
            'NomCommuneDe'  => $item->NomCommuneDe,
            'refCanton'     => $item->refCanton,
            'refDistrict'   => $item->refDistrict,
            'refAutorite'   => $item->refAutorite,
        ];
    });

    foreach ($old_communes as $old_commune){
        $found = $communes->get($old_commune['IDCommune']);

        if($found){

            $found_arr = [
                'id'          => $found->id,
                'nom'         => $found->nom,
                'nom_de'      => $found->nom_de,
                'canton_id'   => $found->canton_id,
                'district_id' => $found->district_id,
                'autorite_id' => $found->autorite_id,
            ];

            if(array_values($found_arr) != array_values($old_commune)){

                $update = [
                    'nom'         => $old_commune['NomCommune'],
                    'nom_de'      => $old_commune['NomCommuneDe'],
                    'canton_id'   => $old_commune['refCanton'],
                    'district_id' => $old_commune['refDistrict'],
                    'autorite_id' => $old_commune['refAutorite'],
                ];

                echo '<pre>';
                print_r($update);
                echo '</pre>';
                //exit();

                //$found->fill($update);
                //$found->save();
            }
        }
    }

    echo '<pre>';
    print_r('end');
    echo '</pre>';
    exit();

    // Districts
    $districts = App\Droit\District\Entities\District::all();
    $districts = $districts->mapWithKeys(function ($item) {
        return [$item->id => $item];
    });

    $old_districts = DB::connection('old')->select('select IDDistrict,NomDistrict,NomDistrictDe,refCanton,refSpecial,TribunalDistrict,TribunalDistrictDe from tbl_Districts');
    $old_districts = collect($old_districts)->map(function ($item) {
        return [
            'IDDistrict'         => $item->IDDistrict,
            'NomDistrict'        => $item->NomDistrict,
            'NomDistrictDe'      => $item->NomDistrictDe,
            'refCanton'          => $item->refCanton,
            'refSpecial'         => $item->refSpecial,
            'TribunalDistrict'   => $item->TribunalDistrict,
            'TribunalDistrictDe' => $item->TribunalDistrictDe,
            'TribunalDistrictTrim'   => slugify_string($item->TribunalDistrict),
            'TribunalDistrictTrimDe' => slugify_string($item->TribunalDistrictDe),
        ];
    });
    
    foreach (collect($old_districts) as $old_district){
        $found        = $districts->find($old_district['IDDistrict']);
        $old_district = (array)$old_district;

        $found_arr = [
            'nom'         => $found->nom,
            'nom_de'      => $found->nom_de,
            'canton_id'   => $found->canton_id,
            'special_id'  => $found->special_id,
            'tribunal'    => slugify_string($found->tribunal),
            'tribunal_de' => slugify_string($found->tribunal_de),
        ];

        $old = [
            'NomDistrict'            => $old_district['NomDistrict'],
            'NomDistrictDe'          => $old_district['NomDistrictDe'],
            'refCanton'              => $old_district['refCanton'],
            'refSpecial'             => $old_district['refSpecial'],
            'TribunalDistrictTrim'   => $old_district['TribunalDistrictTrim'],
            'TribunalDistrictTrimDe' => $old_district['TribunalDistrictTrimDe'],
        ];

        if($found){
            if(array_values($found_arr) != array_values($old)){

                echo '<pre>';
                print_r(array_values($found_arr));
                print_r(array_values($old));
                print_r($found->id);
                echo '</pre>';

                $update = [
                    'nom'         => $old_district['NomDistrict'],
                    'nom_de'      => $old_district['NomDistrictDe'],
                    'canton_id'   => $old_district['refCanton'],
                    'special_id'  => $old_district['refSpecial'],
                    'tribunal'    => $old_district['TribunalDistrict'],
                    'tribunal_de' => $old_district['TribunalDistrictDe'],
                ];

                //$found->fill($update);
                //$found->save();
            }
        }
    }

    echo '<pre>';
    print_r('end');
    echo '</pre>';
    exit();
});

Route::get('migrate_2', function() {
    // Autorites
    $autorites = App\Droit\Autorite\Entities\Autorite::all();
    $autorites = $autorites->mapWithKeys(function ($item) {
        return [$item->id => $item];
    });

    $old_autorites = DB::connection('old')->select('select  IDAutorite ,NomAutorite,NomAutoriteDe,refCanton,refDistrict,SiegeAutorite,DistrictAutorite,SiegeAutoriteDe from tbl_Autorite');
    $old_autorites = collect($old_autorites)->map(function ($item) {

        return [
            'IDAutorite'             => $item->IDAutorite,
            'NomAutorite'            => $item->NomAutorite,
            'NomAutoriteDe'          => $item->NomAutoriteDe,
            'refCanton'              => $item->refCanton,
            'refDistrict'            => $item->refDistrict,
            'SiegeAutorite'          => $item->SiegeAutorite,
            'SiegeAutoriteDe'        => $item->SiegeAutoriteDe,
            'SiegeAutoriteTrim'      => slugify_string($item->SiegeAutorite),
            'SiegeAutoriteTrimDe'    => slugify_string($item->SiegeAutoriteDe),
        ];
    });

    foreach ($old_autorites as $old_autorite) {
        $found = null;
        $found = $autorites->find($old_autorite['IDAutorite']);
        $old_autorite = (array)$old_autorite;

        if($found){

            $found_arr = [
                'nom' => $found->nom,
                'nom_de' => $found->nom_de,
                'canton_id' => $found->canton_id,
                'district_id' => $found->district_id,
                'siege'    => slugify_string($found->siege),
                'siege_de' => slugify_string($found->siege_de),
            ];

            $old = [
                'NomAutorite' => $old_autorite['NomAutorite'],
                'NomAutoriteDe' => $old_autorite['NomAutoriteDe'],
                'refCanton' => $old_autorite['refCanton'],
                'refDistrict' => $old_autorite['refDistrict'],
                'SiegeAutoriteTrim' => $old_autorite['SiegeAutoriteTrim'],
                'SiegeAutoriteTrimDe' => $old_autorite['SiegeAutoriteTrimDe'],
            ];

            /*        echo '<pre>';
                    print_r(array_merge(array_values($found_arr) , array_values($old)));
                    echo '</pre>';*/

            if (array_values($found_arr) != array_values($old)) {

                echo '<pre>';
                print_r(array_values($found_arr));
                print_r(array_values($old));
                print_r($found->id);
                //print_r(array_diff(array_values($found_arr) , array_values($old)));
                echo '</pre>';

                $update = [
                    'nom'         => $old_autorite['NomAutorite'],
                    'nom_de'      => $old_autorite['NomAutoriteDe'],
                    'canton_id'   => $old_autorite['refCanton'],
                    'district_id' => $old_autorite['refDistrict'],
                    'siege'       => $old_autorite['SiegeAutorite'],
                    'siege_de'    => $old_autorite['SiegeAutoriteDe'],
                ];

                 $found->fill($update);
                 $found->save();
            }
        }
    }

    echo '<pre>';
    print_r('end');
    echo '</pre>';
    exit();
});

Route::get('migrate_3', function() {

    $extras = App\Droit\Extra\Entities\Extra::all();
    $extras = $extras->mapWithKeys(function ($item) {
        return [$item->id => $item];
    });

    $old_extras = DB::connection('old')->select('select IDExtraAdresse,TitreExtraAdresse,TitreExtraAdresseDe,ContenuExtraAdresse,ContenuExtraAdresseDe,refCanton from tbl_ExtraAdresse');
    $old_extras = collect($old_extras)->map(function ($item) {
        return [
            'IDExtraAdresse'         => $item->IDExtraAdresse,
            'TitreExtraAdresse'      => $item->TitreExtraAdresse,
            'TitreExtraAdresseDe'    => $item->TitreExtraAdresseDe,
            'ContenuExtraAdresse'    => $item->ContenuExtraAdresse,
            'ContenuExtraAdresseDe'  => $item->ContenuExtraAdresseDe,
            'ContenuExtraAdresseTrim'    => slugify_string($item->ContenuExtraAdresse),
            'ContenuExtraAdresseDeTrim'  => slugify_string($item->ContenuExtraAdresseDe),
            'refCanton'              => $item->refCanton,
        ];
    });

    foreach ($old_extras as $old_extra){
        $found = $extras->get($old_extra['IDExtraAdresse']);

        if($found){
            $found_arr = [
                'id'          => $found->id,
                'titre'       => $found->titre,
                'titre_de'    => $found->titre_de,
                'contenu'     => slugify_string($found->contenu),
                'contenu_de'  => slugify_string($found->contenu_de),
                'canton_id'   => $found->canton_id,
            ];

            $old = [
                'IDExtraAdresse'        => $old_extra['IDExtraAdresse'],
                'TitreExtraAdresse'     => $old_extra['TitreExtraAdresse'],
                'TitreExtraAdresseDe'   => $old_extra['TitreExtraAdresseDe'],
                'ContenuExtraAdresse'   => $old_extra['ContenuExtraAdresseTrim'],
                'ContenuExtraAdresseDe' => $old_extra['ContenuExtraAdresseDeTrim'],
                'refCanton'             => $old_extra['refCanton'],
            ];

            if(array_values($found_arr) != array_values($old)){

                $update = [
                    'titre'       => $old_extra['TitreExtraAdresse'],
                    'titre_de'    => $old_extra['TitreExtraAdresseDe'],
                    'contenu'     => $old_extra['ContenuExtraAdresse'],
                    'contenu_de'  => $old_extra['ContenuExtraAdresseDe'],
                    'canton_id'   => $old_extra['refCanton'],
                ];

                echo '<pre>';
                print_r($update);
                print_r($found->id);
                echo '</pre>';
                //exit();

                //$found->fill($update);
                //$found->save();
            }
        }
    }

    echo '<pre>';
    print_r('end');
    echo '</pre>';
    exit();


});

Route::get('migrate_4', function() {

    $extras = App\Droit\Extra\Entities\Relation::all();
    $extras = $extras->mapWithKeys(function ($item) {
        return [$item->id => $item];
    });

    $old_extras = DB::connection('old')->select('select IDRelationExtra,refCanton,refDistrict,refAutorite,refExtra from tbl_RelationExtra');
    $old_extras = collect($old_extras)->map(function ($item) {
        return [
            'IDRelationExtra'  => $item->IDRelationExtra,
            'refCanton'        => $item->refCanton,
            'refDistrict'      => $item->refDistrict,
            'refAutorite'      => $item->refAutorite,
            'refExtra'         => $item->refExtra,
        ];
    });

    foreach ($old_extras as $old_extra){
        $found = $extras->get($old_extra['IDRelationExtra']);

        if($found){
            $found_arr = [
                'id'          => $found->id,
                'canton_id'   => $found->canton_id,
                'district_id' => $found->district_id,
                'autorite_id' => $found->autorite_id,
                'extra_id'    => $found->extra_id,
            ];

            if(array_values($found_arr) != array_values($old_extra)){

                $update = [
                    'canton_id'    => $old_extra['refCanton'],
                    'district_id'  => $old_extra['refDistrict'],
                    'autorite_id'  => $old_extra['refAutorite'],
                    'extra_id'     => $old_extra['refExtra'],
                ];

                echo '<pre>';
                print_r($update);
                print_r($found->id);
                echo '</pre>';
                //exit();

                //$found->fill($update);
                //$found->save();
            }
        }
    }

    echo '<pre>';
    print_r('end');
    echo '</pre>';
    exit();


});