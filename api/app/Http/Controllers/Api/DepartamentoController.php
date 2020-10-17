<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\DepartamentoProduto;

class DepartamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($empresa_id)
    {
        $departamentos = DepartamentoProduto::with('empresa')->where('empresa_id', $empresa_id)->get();
        return $departamentos;
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

        $departamento = DepartamentoProduto::create($requestData);

        return $departamento;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($empresa_id, $id)
    {
        $departamento = DepartamentoProduto::with('empresa')->where('empresa_id', $empresa_id)->findOrFail($id);
        return $departamento;
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

        $departamento = DepartamentoProduto::with('empresa')->where('empresa_id', $empresa_id)->findOrFail($id);
        $departamento->update($requestData);

        return $departamento;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($empresa_id, $id)
    {
        $departamento = DepartamentoProduto::with('empresa')->where('empresa_id', $empresa_id)->findOrFail($id);
        $departamento->delete();
        return $departamento;
    }
}
