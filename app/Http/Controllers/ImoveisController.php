<?php

namespace App\Http\Controllers;

use App\Models\ActividadeImoveis;
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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) { 
   
   if(has($request->get('fotoPrincipal'))){
        dd($request);
    }
        
        // return response()->json($request);
    
        // $data = $request->all();
        // Imoveis::created($data);
      
        $imovel=Imoveis::created([
            'designacao'=>$request->get('designacao'),
            'descricao'=>$request->get('descricao'),
            'mobiliado_id'=>$request->get('mobiliado_id'),
            'cozinha'=>$request->get('cozinha'),
            'suite'=>$request->get('suite'),
            'sala_de_estar'=>$request->get('sala_de_estar'),
            'numero_quartos'=>$request->get('numero_quartos'),
            'numero_garagem'=>$request->get('numero_garagem'),
            'numero_andar'=>$request->get('numero_andar'),
            'metros'=>$request->get('metros'),
            'numero_banheiro'=>$request->get('numero_banheiro'),
            'tempo_arrendar'=>$request->get('numero_banheiro'),
            'imposto_predial'=>$request->get('imposto_predial'),
            'mesa_cadeira'=>$request->get('mesa_cadeira'),
            'armario_embutido'=>$request->get('armario_embutido'),
            'armario_cozinha'=>$request->get('armario_cozinha'),
            'piscina'=>$request->get('piscina'),
            'numero_banheiro'=>$request->get('numero_banheiro'),
            'numero_banheiro'=>$request->get('numero_banheiro'),
         

        ]);
        $actividade=ActividadeImoveis::created([
            'proprietario_colaborador'=>$request->get('numero_banheiro'),
            'operacao_imoveis_id'=>$request->get('numero_banheiro'),
            'imoveis_id'=>$request->get('numero_banheiro'),
            'users_id'=>$request->get('numero_banheiro'),
            'meses'=>$request->get('numero_banheiro'),
        ]);
       
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
    public function update(Request $request, $id)
    {
        $imovel = Imoveis::find($id);
        $data = $request->all();
        $imovel->update($data);
        return redirect()->back()->with('Actualização feita com sucesso');
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
        $data['imovel'] = Imoveis::find($id);
        // dd($data['id_imovel']);
        return Inertia::render('Portal/ImovelSelecionado', $data);
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
