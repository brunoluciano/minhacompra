<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\Carrinho;
use App\Models\ListaProdutoCarrinho;
use App\Models\Venda;
use App\Models\ItensVenda;


class CarrinhoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($cliente_id)
    {
        $carrinho = Carrinho::where('cliente_id', $cliente_id)->with(['cliente'])->first();
        return $carrinho;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $cliente_id)
    {
        $requestData = $request->all();
        $requestData['cliente_id'] = $cliente_id;

        $carrinho = Carrinho::create($requestData);

        return $carrinho;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function finalizarCompra($cliente_id, $carrinho_id)
    {
        $carrinho = Carrinho::where('id', $carrinho_id)->first();
        $produtos = ListaProdutoCarrinho::where('carrinho_id', $carrinho->id)->with('produto')->get();

        $venda = new Venda();
        $venda->empresa_id = $produtos[0]->produto->empresa_id;
        $venda->cliente_id = $cliente_id;
        $venda->funcionario_id = null;
        $venda->entregador_id = null;
        $venda->horario = Carbon::now()->toDateTimeString();
        $venda->qtd_itens = $carrinho->qtd_itens;
        $venda->total_venda = $carrinho->total;
        $venda->save();

        foreach ($produtos as $produto) {
            $itens_venda = new ItensVenda();
            $itens_venda->produto_id = $produto->produto->id;
            $itens_venda->venda_id = $venda->id;
            $itens_venda->quantidade = $produto->quantidade;
            $itens_venda->total = $produto->total;
            $itens_venda->save();
        }

        ListaProdutoCarrinho::where('carrinho_id', $carrinho->id)->delete();
        $carrinho->qtd_itens = 0;
        $carrinho->total = 0;
        $carrinho->save();

        return $venda;
    }
}
