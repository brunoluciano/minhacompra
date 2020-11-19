<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Venda;
use App\Models\Cliente;

class VendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($empresa_id)
    {
        $vendas = Venda::with(['cliente', 'empresa', 'funcionario', 'entregador', 'status_venda'])->where('empresa_id', $empresa_id)->get();
        foreach ($vendas as $venda) {
            $pessoa = Cliente::where('id', $venda->cliente_id)->with('pessoa')->first();
            $venda['pessoa'] = $pessoa->pessoa;
        }
        return $vendas;
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
            'cliente_id' => 'required',
            'horario' => 'required',
            'qtd_itens' => 'required|min:1',
            'total_venda' => 'required',
        ]);

        $requestData = $request->all();
        $requestData['empresa_id'] = $empresa_id;

        $venda = Venda::create($requestData);

        return $venda;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($empresa_id, $id)
    {
        $venda = Venda::with(['cliente', 'empresa', 'funcionario', 'entregador', 'status_venda'])->where('empresa_id', $empresa_id)->findOrFail($id);
        return $venda;
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
            'cliente_id' => 'required',
            'horario' => 'required',
            'qtd_itens' => 'required|min:1',
            'total_venda' => 'required',
        ]);

        $requestData = $request->all();
        $requestData['empresa_id'] = $empresa_id;

        $venda = Venda::with(['cliente', 'empresa', 'funcionario', 'entregador', 'status_venda'])->where('empresa_id', $empresa_id)->findOrFail($id);
        $venda->update($requestData);

        return $venda;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($empresa_id, $id)
    {
        $venda = Venda::with(['cliente', 'empresa', 'funcionario', 'entregador', 'status_venda'])->where('empresa_id', $empresa_id)->findOrFail($id);
        $venda->delete();
        return $venda;
    }
}
