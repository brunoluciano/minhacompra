<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\MarcaProduto;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($empresa_id)
    {
        $marcas = MarcaProduto::with('empresa')->where('empresa_id', $empresa_id)->get();
        return $marcas;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $empresa_id)
    {
        $request->validate([
            'descricao' => 'required',
        ]);

        $requestData = $request->all();
        $requestData['empresa_id'] = $empresa_id;

        $marca = MarcaProduto::create($requestData);

        return $marca;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($empresa_id, $id)
    {
        $marca = MarcaProduto::with('empresa')->where('empresa_id', $empresa_id)->findOrFail($id);
        return $marca;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $empresa_id, $id)
    {
        $request->validate([
            'descricao' => 'required',
        ]);

        $requestData = $request->all();
        $requestData['empresa_id'] = $empresa_id;

        $marca = MarcaProduto::with('empresa')->where('empresa_id', $empresa_id)->findOrFail($id);
        $marca->update($requestData);

        return $marca;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($empresa_id, $id)
    {
        $marca = MarcaProduto::with('empresa')->where('empresa_id', $empresa_id)->findOrFail($id);
        $marca->delete();
        return $marca;
    }
}
