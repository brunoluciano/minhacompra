<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Carrinho;
use App\Models\ListaProdutoCarrinho;
use App\Models\Produto;

class ListaProdutoCarrinhoController extends Controller
{
    public function index($cliente_id)
    {
        $carrinho = Carrinho::where('cliente_id', $cliente_id)->get();
        $carrinho = $carrinho[0];

        $listaProdutosCarrinho = ListaProdutoCarrinho::where('carrinho_id', $carrinho->id)->with('produto')->get();

        return $listaProdutosCarrinho;
    }

    public function addProduto(Request $request, $cliente_id)
    {
        $request->validate([
            'produto_id' => ['required'],
            'carrinho_id' => ['required'],
            'quantidade' => ['required', 'min:1'],
        ]);

        $produto = Produto::where('id', $request->input('produto_id'))->with('promocao')->first();
        $preco_produto = $produto->promocao_ativa == true ? $produto->promocao->novo_preco : $produto->preco;

        $total = $preco_produto * $request->input('quantidade');

        $requestData = $request->all();
        $requestData['total'] = $total;

        $produtoAdicionado = ListaProdutoCarrinho::create($requestData);
        $listaProdutoAdicionado = ListaProdutoCarrinho::with(['produto', 'carrinho'])->findOrFail($produtoAdicionado->id);

        // ATUALIZAR CARRINHO
        $qtd_itens = ListaProdutoCarrinho::where('carrinho_id', $produtoAdicionado->carrinho_id)->count();
        $total_carrinho = ListaProdutoCarrinho::where('carrinho_id', $produtoAdicionado->carrinho_id)->sum('total');
        $carrinho = Carrinho::findOrFail($produtoAdicionado->carrinho_id);
        $carrinho->qtd_itens = $qtd_itens;
        $carrinho->total = $total_carrinho;
        $carrinho->save();

        return $listaProdutoAdicionado;
    }

    public function remProduto($cliente_id, $produto_id)
    {
        $carrinho = Carrinho::where('cliente_id', $cliente_id)->with(['cliente'])->first();

        $produtoRemovido = ListaProdutoCarrinho::with(['produto', 'carrinho'])
            ->where('carrinho_id', $carrinho->id)
            ->where('produto_id', $produto_id)
            ->first();
        $produtoRemovido->delete();

        // ATUALIZAR CARRINHO
        $qtd_itens = ListaProdutoCarrinho::where('carrinho_id', $produtoRemovido->carrinho_id)->count();
        $total_carrinho = ListaProdutoCarrinho::where('carrinho_id', $produtoRemovido->carrinho_id)->sum('total');
        $carrinho = Carrinho::findOrFail($produtoRemovido->carrinho_id);
        $carrinho->qtd_itens = $qtd_itens;
        $carrinho->total = $total_carrinho;
        $carrinho->save();

        return $produtoRemovido;
    }
}
