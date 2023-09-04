<?php

namespace App\Http\Controllers;

use App\Models\ActividadeImoveis;
use App\Models\Documentacoes;
use App\Models\FotosImoveis;
use App\Models\Imoveis;
use App\Models\TipoDeDocumento;
use App\Models\TipoDocumentacoes;
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
        // return Inertia::render('Portal/Carousel');
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
    public function store(Request $request)
    {

        // return response()->json($request);

        // $data = $request->all();
        // Imoveis::created($data);
        // dd($request->get('mutiplaImagem'));
        dd($request);
        $imovel = Imoveis::create([
            'designacao' => $request->get('designacao'),
            'descricao' => $request->get('descricao'),
            'mobiliado_id' => $request->get('mobiliado_id'),
            'cozinha' => $request->get('cozinha'),
            'suite' => $request->get('suite'),
            'sala_de_estar' => $request->get('sala_de_estar'),
            'numero_quartos' => $request->get('numero_quartos'),
            'numero_garagem' => $request->get('numero_garagem'),
            'numero_andar' => $request->get('numero_andar'),
            'metros' => $request->get('metros'),
            'numero_banheiro' => $request->get('numero_banheiro'),
            'tempo_arrendar' => $request->get('tempo_arrendar'),
            'imposto_predial' => $request->get('imposto_predial'),
            'mesa_cadeira' => $request->get('mesa_cadeira'),
            'armario_embutido' => $request->get('armario_embutido'),
            'armario_cozinha' => $request->get('armario_cozinha'),
            'piscina' => $request->get('piscina'),
            'sofa' => $request->get('sofa'),
            'preco' => $request->get('preco'),
            


        ]);
        if($request->hasFile('fotoPrincipal')){
            $fileFoto =$request-> fotoPrincipal->store('Foto_principal');
            $fotos = FotosImoveis::create([
                'foto' => $fileFoto,
                'imoveis_id' => $imovel->id,
            ]);
        }
        if($request->hasFile('tituloPropriedade')){
            $filepdf =$request-> tituloPropriedade->store('Tipo_Propriedade');
            $fotos = Documentacoes::create([
                'foto' => $filepdf,
                'imoveis_id' => $imovel->id,
                'tipo_domumentacoes' => 1,
            ]);
        }
     
        if($request->hasFile('croquis')){
            $filepdf =$request-> croquis->store('Croquis');
            $fotos = Documentacoes::create([
                'nome_arquivo' => $filepdf,
                'imoveis_id' => $imovel->id,
                'tipo_domumentacoes' => 2,
            ]);
        }
        if ($request->hasFile('mutiplaImagem')) {
            foreach ($request->mutiplaImagem as $foto) {
                $fileFoto =  $foto->store('Foto_Multipla');
                $fotos = FotosImoveis::create([
                    'foto' => $fileFoto,
                    'imoveis_id' => $imovel->id,
                ]);
            };

if($request->get('proprietario_id',1)){
    $proprietario_colaborador=1;
}elseif($request->get('colaborador_id',1)){
    $proprietario_colaborador=2;   
}else{
    $proprietario_colaborador=0;

}
if($request->get('arrendamento_id' == 1)){
    $operacao_imoveis_id=1;
    $mes=$request->get('meses');
}else if($request->get('venda_id' == 1)){
    $operacao_imoveis_id=2;
    $mes=0;
}else{
    $operacao_imoveis_id=0;
}


            $actividade = ActividadeImoveis::create([
                'proprietario_colaborador' => $proprietario_colaborador,
                'operacao_imoveis_id' => $operacao_imoveis_id,
                'imoveis_id' => $imovel->id,
                'users_id' => auth()->user()->id,
                'meses' => $mes,
            ]);
        }
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
        $data['imovel'] = Imoveis::with('fotosImoveis')->find($id);
        // dd($data['imovel']);
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
