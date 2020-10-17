<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

use App\Models\Banner;
use App\Models\Empresa;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($empresa_id)
    {
        $banners = Banner::with('empresa')->where('empresa_id', $empresa_id)->get();
        return $banners;
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
            'imgBanner' => 'required',
        ]);
        $empresa = Empresa::findOrFail($empresa_id);

        $requestData = $request->all();
        $requestData['empresa_id'] = $empresa_id;
        if (!$request->file() == null) {
            $requestData['imagem_url'] = $request->file('imgBanner')->store('empresa/' . $empresa->cnpj . '/banners');
        }
        $banner = Banner::create($requestData);

        return $banner;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($empresa_id, $id)
    {
        $banner = Banner::with('empresa')->where('empresa_id', $empresa_id)->findOrFail($id);
        return $banner;
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
            'imgBanner' => 'required',
        ]);
        $empresa = Empresa::findOrFail($empresa_id);
        $banner = Banner::with('empresa')->where('empresa_id', $empresa_id)->findOrFail($id);

        $requestData = $request->all();
        $requestData['empresa_id'] = $empresa_id;
        if (!$request->file() == null) {
            Storage::delete($banner->imagem_url);
            $requestData['imagem_url'] = $request->file('imgBanner')->store('empresa/' . $empresa->cnpj . '/banners');
        }
        $banner->update($requestData);

        return $banner;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($empresa_id, $id)
    {
        $banner = Banner::with('empresa')->where('empresa_id', $empresa_id)->findOrFail($id);
        Storage::delete($banner->imagem_url);
        $banner->delete();
        return $banner;
    }

    public function getBannerImage($empresa_id, $id)
    {
        $banner = Banner::where('empresa_id', $empresa_id)->findOrFail($id);
        $path = public_path() . '/storage/' . $banner->imagem_url;
        return Response::download($path);
    }
}
