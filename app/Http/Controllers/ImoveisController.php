<?php

namespace App\Http\Controllers;

use App\Models\ActividadeImoveis;
use App\Models\Documentacoes;
use App\Models\FotosImoveis;
use App\Models\Imoveis;
use App\Models\Municipios;
use App\Models\Provincias;
use App\Models\SolicitarImoveis;
use App\Models\TipoDeDocumento;
use App\Models\TipoDocumentacoes;
use App\Models\TipoImoveis;
use App\Models\Tipologia;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ImoveisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function portal_imovel()
    {
        $dados['provincias']=Provincias::all();
        $dados['municipios']=Municipios::all();
        $dados['tipologiaImoveis']=Tipologia::all();
        $dados['tipoImoveis']=TipoImoveis::all();
        $dados['novos_imoveis']=Imoveis::with('fotosImoveis','condicaoImoveis','actividadeImoveis.operacaoImoveis','estadoImoveis')->orderBy('created_at','desc')->get();
        $dados['mais_proximos']=Imoveis::with('fotosImoveis','condicaoImoveis','actividadeImoveis.operacaoImoveis','estadoImoveis')->get();
        // dd($dados);
        return Inertia::render('Portal/PortalIndex', $dados);
        // return Inertia::render('Portal/Carousel');
        // return view();
    }
    public function index()
    {
        $dados['provincias']=Provincias::all();
        $dados['municipios']=Municipios::all();
        $dados['tipologiaImoveis']=Tipologia::all();
        $dados['tipoImoveis']=TipoImoveis::all();
        return Inertia::render('Portal/ImoveisCriar', $dados);
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
        // dd($request);
        $imovel = Imoveis::create([
            'designacao' => $request->get('designacao'),
            'descricao' => $request->get('designacao'),
            'mobiliado' => $request->get('mobiliado'),
            'metros' => $request->get('metros'),
            'localizacao' => $request->get('localizacao_geografica'),
            'imposto_predial' => $request->get('imposto_predial'),
            'numero_banheiro' => $request->get('numero_banheiro'),
            'provincia_id' => $request->get('provincia'),
            'preco' => $request->get('preco'),
            'estado_imoveis_id' => 3,
            'cozinha' => $request->get('numero_cozinha'),
            'suite' => $request->get('numero_quartos'),
            'condicao_imoveis_id' => $request->get('condicao_imovel'),
            'sala_de_estar' => $request->get('sala_de_estar'),
            'numero_quartos' => $request->get('numero_quartos'),
            'numero_andar' => $request->get('numero_andar'),
            //Vai deixar alguma coisa
            'mobiliado' => $request->get('mobiliado'),
            //Parte Interna
            'armario_embutido' => $request->get('armario_embutido'),
            'arcondicionados' => $request->get('ar_condicionados'),
            'mesa_cadeira' => $request->get('mesa_cadeira'),
            // 'maquina_lavar_roupa' => $request->get('maquina_lavar_roupa'),
            //Exterior
            'numero_garagem' => $request->get('numero_garagem'),
            'maquina_lavar_roupa' => $request->get('maquina_lavar_roupa'),
            'churrasqueira' => $request->get('churrasqueira'),
            'piscina' => $request->get('piscina'),
            'gerador' => $request->get('gerador'),
            'ginasio' => $request->get('ginasio'),
            'tanqueagua' => $request->get('tanqueagua'),
            'foto_principal' => $request->get('foto_principal'),

        ]);
        if ($request->hasFile('foto_principal')) {
            $fileFoto = $request->foto_principal->store('Foto_principal');
            $imovel->update([
                'foto_principal' => $fileFoto,
            ]);
        }
        if ($request->hasFile('tituloPropriedade')) {
            $filepdf = $request->tituloPropriedade->store('Tipo_Propriedade');
            $fotos = Documentacoes::create([
                'foto' => $filepdf,
                'imoveis_id' => $imovel->id,
                'tipo_domumentacoes' => 1,
            ]);
        }

        if ($request->hasFile('croquis')) {
            $filepdf = $request->croquis->store('Croquis');
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

            if ($request->get('proprietario_id')== 1) {
                $proprietario_colaborador = 1;
            } elseif ($request->get('colaborador_id')== 2) {
                $proprietario_colaborador = 2;
            } else {
                $proprietario_colaborador = 0;
            }
            // dd($proprietario_colaborador);
            if ($request->get('arrendamento_id' )== 1) {
                $operacao_imoveis_id = 1;
                $mes = $request->get('meses');
            } else if ($request->get('venda_id')== 1) {
                $operacao_imoveis_id = 2;
                $mes = 0;
            } else {
                $operacao_imoveis_id = 0;
            }


            $actividade = ActividadeImoveis::create([
                'proprietario_colaborador' => $proprietario_colaborador,
                'operacao_imoveis_id' => $operacao_imoveis_id,
                'imoveis_id' => $imovel->id,
                'tempo_arrendar' => $request->get('tempo_arrendar'),
                'quantidade_prestacoes' => $request->get('quantidade_prestacoes'),
                // 'users_id' => auth()->user()->id,
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
        $data['imoveis'] = Imoveis::with('fotosImoveis','condicaoImoveis','actividadeImoveis.operacaoImoveis','estadoImoveis')->find($id);
        ;
        return Inertia::render('Portal/ImovelSelecionado', $data);
        // dd();
    }
    public function filtrar_imoveis_paginate(Request $request)
    {
        // $imoveis = Imoveis::with('fotosimoveis')->get();
        $imoveis = Imoveis::with('fotosImoveis','condicaoImoveis','actividadeImoveis.operacaoImoveis','estadoImoveis')->paginate(20);
        // dd($imoveis);
        return response()->json($imoveis);
    }
   
}
