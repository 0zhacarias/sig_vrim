<?php

namespace App\Http\Controllers;

use App\Models\Imoveis;
use App\Models\SolicitarImoveis;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SolicitarImoveisController extends Controller
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
     * @param  \App\Models\SolicitarImoveis  $solicitarImoveis
     * @return \Illuminate\Http\Response
     */
    public function show(SolicitarImoveis $solicitarImoveis)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SolicitarImoveis  $solicitarImoveis
     * @return \Illuminate\Http\Response
     */
    public function edit(SolicitarImoveis $solicitarImoveis)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SolicitarImoveis  $solicitarImoveis
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SolicitarImoveis $solicitarImoveis)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SolicitarImoveis  $solicitarImoveis
     * @return \Illuminate\Http\Response
     */
    public function destroy(SolicitarImoveis $solicitarImoveis)
    {
        //
    }
    public function solicitar_visita(Request $request)
    {
        // dd($request);
        $solicitar_visita = SolicitarImoveis::create([
            'designacao' => $request->get('designacao'),
            'hora_visita' => $request->get('hora_visita'),
            'data_visita' => $request->get('data_visita'),
            'actividade_imoveis_id' => $request->get('actividade_imoveis_id'),
            'imoveis_id' => $request->get('imoveis_id'),
            'user_marca_visita' => auth()->user()->id,

        ]);
        Imoveis::find($request->get('imoveis_id'))->update([
            'estado_imoveis_id' => 4,
        ]);
        // $data[]=$request;
return redirect()->back()->with('success','sucesso');
        // return Inertia::render('Admin/Clientes/SolicitarVisista');
    }
}
