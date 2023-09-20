<?php

namespace App\Http\Controllers;

use App\Mail\EmailImoveilNegociacao;
use App\Models\ActividadeImoveis;
use App\Models\Imoveis;
use App\Models\SolicitarImoveis;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
        $userLog=auth()->user()->load('tipo_user');
        $imovel=Imoveis::find($request->imovel_id);
        $solicitavisita=SolicitarImoveis::with('usuario_marca_visita')->where('imoveis_id',$request->imovel_id)->where('funcionario_id',null)->first();
       $email_marca_visita=$solicitavisita->usuario_marca_visita->email;
       $nome_marca_visita=$solicitavisita->usuario_marca_visita->name;
        $mensagem='A sua marcacao foi aceite no horario escolhido.';
        $url = action([ImoveisController::class, 'index']);

        // dd($url);
        $imovel->update([
            // 'estado_imoveis_id'=>5,
        ]
            
        );
        $solicitavisita->update([
            // 'funcionario_id'=>auth()->user()->id,
        ]);
        $marca_visita=User::find($solicitavisita->user_marca_visita);
        // dd($imovel, $solicitavisita->usuario_marca_visita->email);
        Mail::to('angelfiremilonga@gmail.com')->send(new EmailImoveilNegociacao ($mensagem,$nome_marca_visita,$url));
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
    public function gostar_imovel(Request $request)
    {
        
        $imovel=Imoveis::find($request->imovel_id);
        // dd($imovel);
        $imovel->update([
            'estado_imoveis_id'=>8,
        ]
            
        );
    }
    public function nao_gostar_imovel(Request $request)
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
