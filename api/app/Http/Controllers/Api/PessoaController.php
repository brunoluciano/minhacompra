<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Pessoa;
use Symfony\Component\Console\Input\Input;

class PessoaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pessoas = Pessoa::with('estado')->get();
        return $pessoas;
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
            'cpf' => ['required', 'size:11', 'unique:pessoas,cpf'],
            'sexo' => 'required',
            'nascimento' => 'required',
            'telefone' => 'required',
            'endereco' => 'required',
            'numero' => ['required', 'min:1'],
            // 'complemento' => 'required',
            'cidade' => 'required',
            'estado_id' => 'required',
            'bairro' => 'required',
            'cep' => ['required', 'size:8'],
        ]);

        $pessoa = new Pessoa;
        $pessoa->nome = $request->input('nome');
        $pessoa->cpf = $request->input('cpf');
        $pessoa->sexo = $request->input('sexo');
        $pessoa->nascimento = $request->input('nascimento');
        $pessoa->telefone = $request->input('telefone');
        $pessoa->endereco = $request->input('endereco');
        $pessoa->numero = $request->input('numero');
        $pessoa->complemento = $request->input('complemento');
        $pessoa->cidade = $request->input('cidade');
        $pessoa->estado_id = $request->input('estado_id');
        $pessoa->bairro = $request->input('bairro');
        $pessoa->cep = $request->input('cep');

        $pessoa->save();

        return $pessoa;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pessoa = Pessoa::with('estado')->findOrFail($id);
        return $pessoa;
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
            'cpf' => ['required', 'size:11'],
            'sexo' => 'required',
            'nascimento' => 'required',
            'telefone' => 'required',
            'endereco' => 'required',
            'numero' => ['required', 'min:1'],
            // 'complemento' => 'required',
            'cidade' => 'required',
            'estado_id' => 'required',
            'bairro' => 'required',
            'cep' => ['required', 'size:8'],
        ]);

        $requestData = $request->all();

        $pessoa = Pessoa::findOrFail($id);
        $pessoa->update($requestData);

        return $pessoa;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pessoa = Pessoa::findOrFail($id);
        $pessoa->delete();

        return $pessoa;
    }
}
