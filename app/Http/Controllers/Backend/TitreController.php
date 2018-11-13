<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Droit\Titre\Repo\TitreInterface;

class TitreController extends Controller
{
    protected $titre;

    public function __construct(TitreInterface $titre)
    {
        $this->titre = $titre;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $this->titre->update($request->all());

        return redirect()->back()->with(array('status' => 'success', 'message' => 'Le titre a été édité'));
    }
}
