<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Droit\Menu\Repo\MenuInterface;

class MenuController extends Controller
{
    protected $menu;

    public function __construct(MenuInterface $menu)
    {
        $this->menu = $menu;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $menus = $this->menu->getAll()->sortBy('rang');

        return view('backend.menus.index')->with(['menus' => $menus]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.menus.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $menu = $this->menu->create($request->all());

        return redirect('admin/menu/'.$menu->id)->with(array('status' => 'success', 'message' => 'Le lien a été crée' ));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $menu = $this->menu->find($id);

        return view('backend.menus.show')->with(['menu' => $menu]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $this->menu->update($request->all());

        return redirect()->back()->with(array('status' => 'success', 'message' => 'Le lien a été édité' ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->menu->delete($id);

        return redirect()->back()->with(array('status' => 'success', 'message' => 'Le lien a été supprimé' ));
    }

    public function sorting(Request $request)
    {
        $data = $request->all();

        $menus = $this->menu->updateSorting($data['rang']);

        print_r($data);
    }
}
