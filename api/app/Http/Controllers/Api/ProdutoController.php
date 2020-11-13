<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

use App\Models\Produto;
use App\Models\Empresa;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($empresa_id)
    {
        $produtos = Produto::with(['empresa', 'departamento', 'categoria', 'marca', 'unidade_medida', 'promocao'])
            ->where('empresa_id', $empresa_id)
            ->orderby('descricao')->get();
        return $produtos;
    }

    public function getByDepartamento($empresa_id, $departamento_id)
    {
        $produtos = Produto::with(['empresa', 'departamento', 'categoria', 'marca', 'unidade_medida', 'promocao'])
            ->where('empresa_id', $empresa_id)
            ->where('departamento_id', $departamento_id)
            ->get();
        return $produtos;
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
            'departamento_id' => 'required',
            'categoria_id' => 'required',
            'marca_id' => 'required',
            'unidade_medida_id' => 'required',
            'unidade' => 'required',
            'cod_barras' => 'required',
            'estoque_minimo' => 'required|min:1',
            'estoque_atual' => 'required|min:1',
            'estoque_maximo' => 'required|min:1',
            'preco' => 'required|min:1',
        ]);
        $empresa = Empresa::findOrFail($empresa_id);

        $requestData = $request->all();
        $requestData['empresa_id'] = $empresa_id;
        if (!$request->file() == null) {
            $requestData['imagem_url'] = $request->file('imgProduto')->store('empresa/' . $empresa->cnpj . '/produtos/' . $request->input('descricao'));
        }

        $produto = Produto::create($requestData);

        return $produto;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($empresa_id, $id)
    {
        $produto = Produto::with(['empresa', 'departamento', 'categoria', 'marca', 'unidade_medida'])
            ->where('empresa_id', $empresa_id)->findOrFail($id);
        return $produto;
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
            'departamento_id' => 'required',
            'categoria_id' => 'required',
            'marca_id' => 'required',
            'unidade_medida_id' => 'required',
            'unidade' => 'required',
            'cod_barras' => 'required',
            'estoque_minimo' => 'required|min:1',
            'estoque_atual' => 'required|min:1',
            'estoque_maximo' => 'required|min:1',
            'preco' => 'required|min:1',
        ]);
        $produto = Produto::with(['empresa', 'departamento', 'categoria', 'marca', 'unidade_medida'])
            ->where('empresa_id', $empresa_id)->findOrFail($id);

        $requestData = $request->all();
        $requestData['empresa_id'] = $empresa_id;
        if (!$request->file() == null) {
            Storage::deleteDirectory('empresa/' . $produto->empresa->cnpj . '/produtos/' . $produto->descricao);
            $requestData['imagem_url'] = $request->file('imgProduto')->store('empresa/' . $produto->empresa->cnpj . '/produtos/' . $request->input('descricao'));
        }
        $produto->update($requestData);

        return $produto;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($empresa_id, $id)
    {
        $produto = Produto::with(['empresa', 'departamento', 'categoria', 'marca', 'unidade_medida'])
            ->where('empresa_id', $empresa_id)->findOrFail($id);
        Storage::deleteDirectory('empresa/' . $produto->empresa->cnpj . '/produtos/' . $produto->descricao);
        $produto->delete();
        return $produto;
    }

    public function getProdutoImage($empresa_id, $id)
    {
        $produto = Produto::where('empresa_id', $empresa_id)->findOrFail($id);
        $path = public_path() . '/storage/' . $produto->imagem_url;
        return Response::download($path);
    }

    public function comPromocao($empresa_id)
    {
        $produtos = Produto::with(['empresa', 'departamento', 'categoria', 'marca', 'unidade_medida', 'promocao'])
            ->where('empresa_id', $empresa_id)
            ->where('promocao_ativa', true)
            ->get();
        return $produtos;
    }

    public function semPromocao($empresa_id)
    {
        $produtos = Produto::with(['empresa', 'departamento', 'categoria', 'marca', 'unidade_medida'])
            ->where('empresa_id', $empresa_id)
            ->where('promocao_ativa', false)
            ->get();
        return $produtos;
    }
}
