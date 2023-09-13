<?php

namespace App\Http\Controllers;

use App\Models\ActividadeImoveis;
use App\Models\Imoveis;
use Illuminate\Http\Request;

class ActividadeImoveisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ActividadeImoveis  $actividadeImoveis
     * @return \Illuminate\Http\Response
     */
    public function show(ActividadeImoveis $actividadeImoveis)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ActividadeImoveis  $actividadeImoveis
     * @return \Illuminate\Http\Response
     */
    public function edit(ActividadeImoveis $actividadeImoveis)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ActividadeImoveis  $actividadeImoveis
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ActividadeImoveis $actividadeImoveis)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ActividadeImoveis  $actividadeImoveis
     * @return \Illuminate\Http\Response
     */
    public function destroy(ActividadeImoveis $actividadeImoveis)
    {
        //
    }
    public function validar_processo(Request $request)
    {
        
        $imovel=Imoveis::find($request->imovel_id);
        // dd($imovel);
        $imovel->update([
            'estado_imoveis_id'=>8,
        ]
            
        );
    }
    public function nao_validar_processo(Request $request)
    {
        
        $imovel=Imoveis::find($request->imovel_id);
        // dd($imovel);
        $imovel->update([
            'estado_imoveis_id'=>3,
        ]
            
        );
    }
public function carregar_imoveis_processo() {
    return response()->json(2);
}
}
