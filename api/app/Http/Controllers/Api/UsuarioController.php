<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\Usuario;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($empresa_id)
    {
        $usuarios = Usuario::with(['empresa', 'tipo_usuario'])->where('empresa_id', $empresa_id)->get();
        return $usuarios;
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
            'nome' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:usuarios,email'],
            'password' => ['required', 'min:3'],
            'tipo_usuario_id' => ['required'],
        ]);

        $requestData = $request->all();
        $requestData['empresa_id'] = $empresa_id;
        $senha = Hash::make($request->input('password'));
        $requestData['password'] = $senha;

        $usuario = Usuario::create($requestData);

        return $usuario;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($empresa_id, $id)
    {
        $usuario = Usuario::with(['empresa', 'tipo_usuario'])->where('empresa_id', $empresa_id)->findOrFail($id);
        return $usuario;
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
            'nome' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:3'],
            'tipo_usuario_id' => ['required'],
        ]);

        $requestData = $request->all();
        $requestData['empresa_id'] = $empresa_id;
        $senha = Hash::make($request->input('password'));
        $requestData['password'] = $senha;

        $usuario = Usuario::with(['empresa', 'tipo_usuario'])->where('empresa_id', $empresa_id)->findOrFail($id);
        $usuario->update($requestData);

        return $usuario;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($empresa_id, $id)
    {
        $usuario = Usuario::with(['empresa', 'tipo_usuario'])->where('empresa_id', $empresa_id)->findOrFail($id);
        $usuario->delete();
        return $usuario;
    }
}
