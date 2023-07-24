<?php

namespace App\Http\Controllers;

use App\Models\Imoveis;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ImoveisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Portal/ImoveisCriar');
        // return view();
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
        $data=$request->all();
        Imoveis::created($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Imoveis  $imoveis
     * @return \Illuminate\Http\Response
     */
    public function show(Imoveis $imoveis)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Imoveis  $imoveis
     * @return \Illuminate\Http\Response
     */
    public function edit(Imoveis $imoveis)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Imoveis  $imoveis
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Imoveis $imoveis)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Imoveis  $imoveis
     * @return \Illuminate\Http\Response
     */
    public function destroy(Imoveis $imoveis)
    {
        //
    }
    public function lista_imoveis_comprar()
    {
       
        return Inertia::render('Portal/ListaImoveis');
    }
    public function lista_imoveis_arrendamento()
    {
        return Inertia::render('Portal/ListaImoveis');
        // dd();
    }
    public function imovel_selecionado($id)
    {
        $id = base64_decode(base64_decode(base64_decode($id)));
        $data['imovel']=Imoveis::find($id);
        // dd($data['id_imovel']);
        return Inertia::render('Portal/ImovelSelecionado',$data);
        // dd();
    }

    public function filtrar_imoveis_paginate(Request $request)
    {
        $imoveis = Imoveis::paginate(10);
        return response()->json($imoveis);
    }
    public function solicitar_visita($id)
    {
        return Inertia::render('Admin/Clientes/SolicitarVisista');
    }
}
