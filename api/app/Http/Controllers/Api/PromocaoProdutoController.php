<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\PromocaoProduto;

class PromocaoProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($empresa_id, $produto_id)
    {
        $promocoes = PromocaoProduto::with('produto')
            ->where('produto_id', $produto_id)->get();
        return $promocoes;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $empresa_id, $produto_id)
    {
        $request->validate([
            'porcentagem' => 'required',
            'novo_preco' => 'required',
        ]);

        $requestData = $request->all();
        $requestData['produto_id'] = $produto_id;

        $promocao = PromocaoProduto::create($requestData);

        return $promocao;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($empresa_id, $produto_id, $id)
    // {
    //     $promocao = PromocaoProduto::with('produto')
    //          ->where('produto_id', $produto_id)->findOrFail($id);
    //     return $promocao;
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $empresa_id, $produto_id, $id)
    {
        $request->validate([
            'porcentagem' => 'required',
            'novo_preco' => 'required',
        ]);

        $requestData = $request->all();
        $requestData['produto_id'] = $produto_id;

        $promocao = PromocaoProduto::with('produto')->where('produto_id', $produto_id)->findOrFail($id);
        $promocao->update($requestData);

        return $promocao;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($empresa_id, $produto_id, $id)
    {
        $promocao = PromocaoProduto::with('produto')->where('produto_id', $produto_id)->findOrFail($id);
        $promocao->delete();
        return $promocao;
    }
}
