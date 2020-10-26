<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

use App\Models\Empresa;
use App\Models\DepartamentoProduto;
use Symfony\Component\Console\Input\Input;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empresas = Empresa::with('estado')->get();
        return $empresas;
    }

    public function getByCEP(Request $request)
    {
        $cep = $request->Input('cep');
        $empresas = Empresa::with('estado')->where('cep', $cep)->orderBy('nome')->get();
        return $empresas;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'cnpj' => ['required', 'size:14', 'unique:empresas,cnpj'],
            'telefone' => 'required',
            'endereco' => 'required',
            'numero' => ['required', 'min:1'],
            'bairro' => 'required',
            'cidade' => 'required',
            'estado_id' => 'required',
            'cep' => ['required', 'size:8'],
        ]);

        $requestData = $request->all();
        if (!$request->file() == null) {
            $requestData['logo_url'] = $request->file('imgLogo')->store('empresa/' . $request->input('cnpj') . '/logo');
        }
        $empresa = Empresa::create($requestData);
        $departamentosPadrao = [
            "Alimentos",
            "Bebidas",
            "Açougue",
            "Congelados",
            "Frios & Laticínios",
            "Hortifrutti",
            "Padaria",
            "Doces & Sobremesas",
            "Perfumaria & Higiene",
            "Limpeza",
        ];
        foreach ($departamentosPadrao as $departamento) {
            $d = new DepartamentoProduto();
            $d->empresa_id = $empresa->id;
            $d->descricao = $departamento;
            DepartamentoProduto::create($d);
        }

        return $empresa;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $empresa = Empresa::with('estado')->findOrFail($id);
        return $empresa;
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
        $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'cnpj' => ['required', 'size:14'],
            'telefone' => 'required',
            'endereco' => 'required',
            'numero' => ['required', 'min:1'],
            'bairro' => 'required',
            'cidade' => 'required',
            'estado_id' => 'required',
            'cep' => ['required', 'size:8'],
        ]);
        $empresa = Empresa::findOrFail($id);

        $requestData = $request->all();
        if (!$request->file() == null) {
            Storage::delete($empresa->logo_url);
            $requestData['logo_url'] = $request->file('imgLogo')->store('empresa/' . $request->input('cnpj') . '/logo');
        }
        $empresa->update($requestData);

        return $empresa;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $empresa = Empresa::findOrFail($id);
        Storage::deleteDirectory('empresa/' . $empresa->cnpj);
        $empresa->delete();
        return $empresa;
    }

    public function getLogoImage($id)
    {
        $empresa = Empresa::findOrFail($id);

        $path = public_path() . '/storage/' . $empresa->logo_url;
        return Response::download($path);
    }

    public function teste(Request $request, $id)
    {
        $requestData = $request->all();
        return $requestData;
    }
}