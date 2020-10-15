<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Empresa;

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

        // $empresa = new Empresa;
        // $empresa->email = $request->input('email');
        // $empresa->pessoa_id = $request->input('pessoa_id');

        // $empresa->save();

        $requestData = $request->all();
        if(!$request->file() == null) {
            $requestData['logo_url'] = $request->file('imgLogo')->store('empresa/'. $request->input('cnpj') . '/logo');
        }        
        $empresa = Empresa::create($requestData);
        

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
}
