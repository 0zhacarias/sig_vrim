<?php

namespace App\Http\Controllers;

use App\Mail\EmailImoveilNegociacao;
use App\Models\ActividadeImoveis;
use App\Models\Imoveis;
use App\Models\SolicitarImoveis;
use App\Models\User;
use PDF;
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
    public function emailValidar($solicitavisita, $mensagem)
    {
        $email_marca_visita = $solicitavisita->usuario_marca_visita->email;
        $nome_marca_visita = $solicitavisita->usuario_marca_visita->name;
        // Imovel
        $designacao_imovel = $solicitavisita->imovel->designacao;
        $localizacao = $solicitavisita->imovel->localizacao;
        $preco = $solicitavisita->imovel->preco;
        $condicao_imovel = $solicitavisita->imovel->condicaoImoveis->designacao;
        //Informação da visita
        $data_visita = $solicitavisita->data_visita;
        $hora_visita = $solicitavisita->hora_visita;
        $url = action([ImoveisController::class, 'portal_imovel']);
        // dd($solicitavisita);
        Mail::to('zhacarias50@outlook.com')->send(new EmailImoveilNegociacao(
            $mensagem,
            $nome_marca_visita,
            $url,
            $designacao_imovel,
            $localizacao,
            $preco,
            $condicao_imovel,
            $data_visita,
            $hora_visita
        ));
    }
    public function validar_processo(Request $request)
    {
        
        $userLog = auth()->user()->load('tipo_user');
        
        
        $imovel = Imoveis::find($request->imovel_id);
       
        if( $imovel->estado_imoveis_id==3){
            $imovel->update(
                [
                    'estado_imoveis_id'=>1,
                ]
    
            );
        }else if($imovel->estado_imoveis_id==4){
            $imovel->update(
                [
                    'estado_imoveis_id'=>1,
                ]
    
            );
        }
        $solicitavisita = SolicitarImoveis::with('usuario_marca_visita')->where('imoveis_id', $request->imovel_id)->where('funcionario_id', null)->first();
        $mensagem = 'A sua marcação foi aceite no horário desejado.';
        $this->emailValidar($solicitavisita, $mensagem);
        // dd($url);
      
        $solicitavisita->update([
            'funcionario_id' => auth()->user()->id,
        ]);
       
        // dd($imovel, $solicitavisita->usuario_marca_visita->email);

    }
    public function nao_validar_processo(Request $request)
    {
        $solicitavisita = SolicitarImoveis::with('usuario_marca_visita')->where('imoveis_id', $request->imovel_id)->where('funcionario_id', null)->first();
        $mensagem = 'A sua marcação não foi aceite no horário desejado, por favor volte a reagendar o mesmo.';
        $this->emailValidar($solicitavisita, $mensagem);
        $imovel = Imoveis::find($request->imovel_id);
        
        if( $imovel->estado_imoveis_id==3){
            $imovel->update(
                [
                    'estado_imoveis_id'=>2,
                    ]
                    
                );
            }else if($imovel->estado_imoveis_id==4){
                $imovel->update(
                    [
                        'estado_imoveis_id'=>5,
                        ]
                        
                    );
                }
               
    }
    public function cancelar_processo(Request $request)
    {
        // dd($request);
        $solicitavisita = SolicitarImoveis::with('usuario_marca_visita')->where('imoveis_id', $request->imovel_id)->where('funcionario_id', null)->first();
        $mensagem = 'Devido algumas inregularidade no processo, foi concelado o imóvel, e estará disponivel para outros interessado..';
        $this->emailValidar($solicitavisita, $mensagem);
        $imovel = Imoveis::find($request->imovel_id);
        $imovel->update(
            [
                'estado_imoveis_id' => 1,
            ]

        );
    }
    public function imprimir_documentacao( $id)
    {

        $declaracao=Imoveis::where('id',$id)->get();
        $userLog = auth()->user()->load('tipo_user');
        $user = User::where('id', $userLog->id)->get();
        
        $pdf = PDF::loadView('declaracaoPDF', [
            'declaracaoPDF' => $declaracao,
            'datatime' => date("Y-m-d"),
            'user'=>$user,
        ]);
        // dd($pdf );
        return $pdf->stream('Listas tipo de problemas projecto.pdf');

    }
    public function emitir_anuncio($id)
    {

        $declaracao=Imoveis::where('id',$id)->get();
        $userLog = auth()->user()->load('tipo_user');
        $user = User::where('id', $userLog->id)->get();
        
        $pdf = PDF::loadView('eminitirAnuncioPDF', [
            'eminitirAnuncioPDF' => $declaracao,
            'datatime' => date("Y-m-d"),
            'user'=>$user,
        ]);
        // dd($pdf );
        return $pdf->stream('Listas tipo de problemas projecto.pdf');

    }
    public function emitir_relatorios_processo()
    {

        $declaracao=Imoveis::all();
        $userLog = auth()->user()->load('tipo_user');
        // $user = User::where('id', $userLog->id)->get();
        
        $pdf = PDF::loadView('emitirRelatorioProcesso', [
            'emitirRelatorioProcesso' => $declaracao,
            'datatime' => date("Y-m-d"),
            // 'user'=>$user,
        ]);
        // dd($pdf );
        return $pdf->stream('Listas tipo de problemas projecto.pdf');

    }
    public function gostar_imovel(Request $request)
    {
        $imovel = Imoveis::find($request->imovel_id);
        $imovel->update(
            [
                'estado_imoveis_id'=>8,
            ]

        );
        $imovel = Imoveis::find($request->imovel_id);
        $solicitavisita = SolicitarImoveis::with('confirmar_marcacao_visita', 'imovel.condicaoImoveis')->where('imoveis_id', $request->imovel_id)->first();
        //Informação do funcionario
        $email_marca_visita = $solicitavisita->usuario_marca_visita->email;
        $nome_confirma_visita = $solicitavisita->confirmar_marcacao_visita->name;
        //Informação do imovel
        $designacao_imovel = $solicitavisita->imovel->designacao;
        $localizacao = $solicitavisita->imovel->localizacao;
        $preco = $solicitavisita->imovel->preco;
        $preco = $solicitavisita->imovel->condicaoImoveis->designacao;
        //Informação da visita
        $data_visita = $solicitavisita->data_visita;
        $hora_visita = $solicitavisita->hora_visita;
        // dd($solicitavisita);
        $mensagem = 'Gostaste do Imóvel.';
        $url = action([ImoveisController::class, 'portal_imovel']);
        // Mail::to('zhacarias50@outlook.com')->send(new EmailImoveilNegociacao($mensagem, $nome_confirma_visita, $url));
    }
    public function nao_gostar_imovel(Request $request)
    {

        $imovel = Imoveis::find($request->imovel_id);
        // dd($imovel);
        $imovel->update(
            [
                'estado_imoveis_id' => 1,
            ]

        );
    }
    public function carregar_imoveis_processo()
    {
        return response()->json(2);
    }
}
