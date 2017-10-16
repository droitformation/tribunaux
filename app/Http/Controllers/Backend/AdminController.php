<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Droit\Canton\Repo\CantonInterface;
use App\Droit\Autorite\Repo\AutoriteInterface;
use App\Droit\District\Repo\DistrictInterface;
use App\Droit\Commune\Repo\CommuneInterface;
use App\Droit\Tribunaux\Repo\TribunauxInterface;
use App\Droit\Menu\Repo\MenuInterface;

class AdminController extends Controller
{
    protected $canton;
    protected $district;
    protected $autorite;
    protected $commune;
    protected $tribunaux;
    protected $menu;

    public function __construct(CantonInterface $canton,DistrictInterface $district, AutoriteInterface $autorite,CommuneInterface $commune, TribunauxInterface $tribunaux, MenuInterface $menu)
    {
        $this->canton    = $canton;
        $this->district  = $district;
        $this->autorite  = $autorite;
        $this->commune   = $commune;
        $this->tribunaux = $tribunaux;
        $this->menu      = $menu;
    }

    /**
     *
     * @return Response
     */
    public function index()
    {
        $cantons = $this->canton->getAll();

        return view('backend.index')->with(['cantons' => $cantons]);
    }

    public function clean($string)
    {

  /*      $string = str_replace('<br/>'," \n ",$string);
        $string = str_replace('-',' ',$string);
        $string = str_replace('&nbsp;','',$string);

        $string = str_replace('T&eacute;l',', T&eacute;l',$string);
        $string = str_replace('Fax:',', Fax:',$string);
        $string = str_replace('Case postale',', Case postale',$string);
        $string = str_replace('Postfach',', Postfach ',$string);
        $string = str_replace('Tel.:',', Tel.:',$string);
        $string = strip_tags($string);
        */
        $string = str_replace('-',' ',$string);
        $string = str_replace('Mail:',' ',$string);
        $string = html_entity_decode($string);
        return nl2br($string);
    }

    public function export()
    {
        $cantons = $this->canton->getAll();

        $tribunaux = $cantons->map(function ($canton, $key) {

            $autorites = collect([]);
            
            $districts = $canton->districts->map(function ($district, $key) use ($canton) {
                $autorites = $district->autorites->map(function ($autorite, $key) use ($canton) {

                    $siege = empty($canton->canton_tribunaux->siege) && !empty($autorite->siege) ? $autorite->siege : $canton->canton_tribunaux->siege;
                    return ['nom' => $autorite->nom, 'nom_de' => $autorite->nom_de, 'siege' => $siege, 'siege_de' => $autorite->siege_de];
                });

                return [
                    'nom' => $district->nom, 'nom_de' => $district->nom_de, 'tribunal' => $district->tribunal,'tribunal_de' => $district->tribunal_de, 'autorites' => $autorites
                ];
            });

            if($canton->is_second_level){
                $autorites = $canton->autorites->map(function ($autorite, $key) use ($canton) {

                    $siege = empty($canton->canton_tribunaux->siege) && !empty($autorite->siege) ? $autorite->siege : $canton->canton_tribunaux->siege;

                    return ['nom' => $autorite->nom, 'nom_de' => $autorite->nom_de, 'siege' => $siege, 'siege_de' => $autorite->siege_de];
                });
            }

            return [
                'canton'  => $canton->titre,
                'deuxieme' => $this->clean($canton->canton_tribunaux->deuxieme),
                'premier'  => $this->clean($canton->canton_tribunaux->premier),
                'districts' => $districts,
                'autorites' => $autorites
            ];
        });

    /*    echo '<pre>';
        print_r($tribunaux);
        echo '</pre>';exit();*/

        return \PDF::loadView('backend.export', ['tribunaux' => $tribunaux])->setPaper('a4')->stream();
        
      /*  \Excel::create('TribunauxCivilsExport', function($excel) use($tribunaux) {

            // Set the title
            $excel->setTitle('Tribunaux Civils Suisse');

            // Chain the setters
            $excel->setCreator('TribunauxCivils')->setCompany('UniNE');

            $excel->sheet('Page', function($sheet) use ($tribunaux) {

                $sheet->setOrientation('landscape');

                $sheet->appendRow(['Canton','Tribunal deuxième instance','Tribunal première instance']);
                $sheet->row($sheet->getHighestRow(), function ($row) {
                    $row->setFontSize(13)->setFontWeight('bold');
                });
                $sheet->rows($tribunaux->toArray());

            });

        })->download('xls');*/

    }
}
