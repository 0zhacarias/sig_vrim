<?php

namespace App\Http\Controllers;
// use Socialite;
use App\Library\Authenticate;
use App\Library\GoogleClient;
use App\Mail\EmailImoveilNegociacao;
use App\Models\Cliente;
use App\Models\Imoveis;
use App\Models\Municipios;
use App\Models\Pessoa;
use App\Models\Provincias;
use App\Models\SolicitarImoveis;
use App\Models\TipoImoveis;
use App\Models\Tipologia;
use App\Models\TipoUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;
use Laravel\Socialite\Facades\Socialite;
// use App\Http\Controllers\Socialite;
use PDF;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ClienteController extends Controller
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
        dd();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {

        dd(2);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
    }
    public function atualizar_perfil(Request $request)
    {
        // dd($request);

        $numero = $request->get('numero_telefone');
        $pais = "244";

        // Remove a parte do prefixo da URL
        $numerousuario = str_replace('244', '', $request->get('numero_telefone'));
        $utilizador = User::find($request->user_id);
        
        $nomeRoles = $utilizador->getRoleNames()->first();
        $utilizador->removeRole($nomeRoles);
        $rolesanterior = $utilizador->tipo_user_id;
        // dd();
        $utilizador->update([
            'name' => $request->get('nome'),
            'telefone' => $numerousuario,
            'email' => $request->get('email'),
            'tipo_user_id' => $request->usuario['tipo_user_id'],

        ]);
        $pessoa = Pessoa::find($request->id);
        $pessoa->update([
            'nome' => $request->get('nome'),
            'numero_telefone' => $request->get('numero_telefone'),
            'email' => $request->get('email'),
            'numero_identificacao' => $request->get('numero_identificacao'),
            'provincia_id' => $request->get('provincia_id'),
        ]);
        if ($request->usuario['tipo_user_id'] == 1) {
            // $utilizador->revokePermissionTo('');
            $utilizador->assignRole('Funcionario');
        } elseif ($request->usuario['tipo_user_id'] == 2) {
            // $utilizador->revokePermissionTo('');
            $utilizador->assignRole('Clientes');
        } elseif ($request->usuario['tipo_user_id'] == 3) {
            // $utilizador->revokePermissionTo('');
            $utilizador->assignRole('Proprietários');
        } elseif ($request->usuario['tipo_user_id'] == 4) {
            // $utilizador->revokePermissionTo('');
            $utilizador->assignRole('Colaborador');
        } elseif ($request->usuario['tipo_user_id'] == 5) {
            // $utilizador->revokePermissionTo('');
            $utilizador->assignRole('Corretor');
        }
        //    dd($pessoa,$utilizador);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        //
    }
    public function permissoes()
    {
        $dados['roles'] = Role::with('permissions')->get();
        $dados['permissions'] = Permission::with('roles')->get();
        // dd($dados);
        return Inertia::render('Admin/Clientes/SincronizarRolesPermissoes', $dados);
        // return Inertia::render('Clietes/SincronizarRolesPermissoes');
    }
    public function perfil_cliente()
    {

        // $mensagem='A sua marcacao foi aceite no horario escolhido.';
        // $url = action([ImoveisController::class, 'index']);

        // // dd($imovel, $solicitavisita->usuario_marca_visita->email);
        // Mail::to('zhacarias50@outlook.com')->send(new EmailImoveilNegociacao ($mensagem));


        if (auth()->user()) {
            $userLog = auth()->user()->load('tipo_user');
            $dados['cliente'] = User::where('id', $userLog->id)->first();

            $dados['meus_imoveis'] = Imoveis::where('cadastrado_por', $userLog->id)
                ->with('fotosImoveis', 'condicaoImoveis', 'actividadeImoveis.operacaoImoveis', 'estadoImoveis')->orderBy('created_at', 'desc')->get();
            $dados['meus_pagamentos'] = Imoveis::with('fotosImoveis', 'condicaoImoveis', 'actividadeImoveis.operacaoImoveis', 'estadoImoveis')->get();
            $id_user_marca_visita = SolicitarImoveis::where('user_marca_visita', $userLog->id)->select('imoveis_id')->get();
            if ($userLog->tipo_user_id == 1) {

                $dados['imoveis_processos'] = Imoveis::whereIn('estado_imoveis_id', [4, 5, 6, 7, 8])
                    ->with('fotosImoveis', 'condicaoImoveis', 'actividadeImoveis.operacaoImoveis', 'estadoImoveis')
                    ->get();
            } else {
                $dados['imoveis_processos'] = Imoveis::whereIn('id', $id_user_marca_visita)->whereIn('estado_imoveis_id', [4, 5, 6, 7, 8])
                    ->with('fotosImoveis', 'condicaoImoveis', 'actividadeImoveis.operacaoImoveis', 'estadoImoveis')->get();
            }
            return Inertia::render('Admin/Clientes/Cliente', $dados);
        } else {
            $dados['vazio'] = '';
            $dados['meus_imoveis'] = Imoveis::with('fotosImoveis', 'condicaoImoveis', 'actividadeImoveis.operacaoImoveis', 'estadoImoveis')->orderBy('created_at', 'desc')->get();
            $dados['meus_pagamentos'] = Imoveis::with('fotosImoveis', 'condicaoImoveis', 'actividadeImoveis.operacaoImoveis', 'estadoImoveis')->get();

            return Inertia::render('Portal/PortalIndex', $dados);
        }


        //    dd($dados['imoveis_processos']);
        // return Inertia::render('Admin/Clientes/Cliente',$dados);
    }
    public function perfil()
    {
        $dados['provincias'] = Provincias::all();
        $dados['municipios'] = Municipios::all();
        $dados['tipologiaImoveis'] = Tipologia::all();
        $dados['tipoImoveis'] = TipoImoveis::all();

        if (auth()->user()) {
            $userLog = auth()->user()->load('tipo_user');
            if ($userLog->tipo_user->id == 1) {
                $dados['tipoUsuario'] = TipoUser::all();
            } else {
                $dados['tipoUsuario'] = TipoUser::whereNotIn('id', [1])->get();
            }
            $dados['pessoa'] = Pessoa::where('user_id', $userLog->id)->with('provincias', 'usuario.tipo_user')->first();
            $dados['cliente'] = User::where('id', $userLog->id)->with('pessoa.provincias', 'tipo_user')->first();

            $dados['meus_imoveis'] = Imoveis::where('cadastrado_por', $userLog->id)
                ->with('fotosImoveis', 'condicaoImoveis', 'actividadeImoveis.operacaoImoveis', 'estadoImoveis')->orderBy('created_at', 'desc')->get();
            $dados['meus_pagamentos'] = Imoveis::with('fotosImoveis', 'condicaoImoveis', 'actividadeImoveis.operacaoImoveis', 'estadoImoveis')->get();
            $id_user_marca_visita = SolicitarImoveis::where('user_marca_visita', $userLog->id)->select('imoveis_id')->get();
            if ($userLog->tipo_user_id == 1) {

                $dados['imoveis_processos'] = Imoveis::whereIn('estado_imoveis_id', [4, 5, 6, 7, 8])
                    ->with('fotosImoveis', 'condicaoImoveis', 'actividadeImoveis.operacaoImoveis', 'estadoImoveis')
                    ->get();
            } else {
                $dados['imoveis_processos'] = Imoveis::whereIn('id', $id_user_marca_visita)->whereIn('estado_imoveis_id', [4, 5, 6, 7, 8])
                    ->with('fotosImoveis', 'condicaoImoveis', 'actividadeImoveis.operacaoImoveis', 'estadoImoveis')->get();
            }
            return Inertia::render('Admin/Clientes/Perfil', $dados);
        } else {
            $dados['vazio'] = '';
            $dados['meus_imoveis'] = Imoveis::with('fotosImoveis', 'condicaoImoveis', 'actividadeImoveis.operacaoImoveis', 'estadoImoveis')->orderBy('created_at', 'desc')->get();
            $dados['meus_pagamentos'] = Imoveis::with('fotosImoveis', 'condicaoImoveis', 'actividadeImoveis.operacaoImoveis', 'estadoImoveis')->get();

            return Inertia::render('Portal/PortalIndex', $dados);
        }
    }
    public function processos()
    {

        if (auth()->user()) {

            $userLog = auth()->user()->load('tipo_user');
            $dados['cliente'] = User::where('id', $userLog->id)->first();

            $dados['meus_imoveis'] = Imoveis::where('cadastrado_por', $userLog->id)
                ->with('fotosImoveis', 'condicaoImoveis', 'actividadeImoveis.operacaoImoveis', 'estadoImoveis')->orderBy('created_at', 'desc')->get();
            $dados['meus_pagamentos'] = Imoveis::with('fotosImoveis', 'condicaoImoveis', 'actividadeImoveis.operacaoImoveis', 'estadoImoveis')->get();
            $id_user_marca_visita = SolicitarImoveis::where('user_marca_visita', $userLog->id)->select('imoveis_id')->get();
            if ($userLog->tipo_user_id == 1) {

                $dados['imoveis_processos'] = Imoveis::whereIn('estado_imoveis_id', [4, 5, 6, 7, 8])
                    ->with('fotosImoveis', 'condicaoImoveis', 'actividadeImoveis.operacaoImoveis', 'estadoImoveis')
                    ->get();
                // dd($dados['imoveis_processos']);
            } else {
                $dados['imoveis_processos'] = Imoveis::whereIn('id', $id_user_marca_visita)->whereIn('estado_imoveis_id', [4, 5, 6, 7, 8])
                    ->with('fotosImoveis', 'condicaoImoveis', 'actividadeImoveis.operacaoImoveis', 'estadoImoveis')->get();
            }
            return Inertia::render('Admin/Clientes/MeusImoveisProcesso', $dados);
        } else {
            $dados['vazio'] = '';
            $dados['meus_imoveis'] = Imoveis::with('fotosImoveis', 'condicaoImoveis', 'actividadeImoveis.operacaoImoveis', 'estadoImoveis')->orderBy('created_at', 'desc')->get();
            $dados['meus_pagamentos'] = Imoveis::with('fotosImoveis', 'condicaoImoveis', 'actividadeImoveis.operacaoImoveis', 'estadoImoveis')->get();

            return Inertia::render('Portal/PortalIndex', $dados);
        }
    }
    public function anuncios()
    {

        if (auth()->user()) {
            $userLog = auth()->user()->load('tipo_user');
            $dados['cliente'] = User::where('id', $userLog->id)->first();
            $dados['meus_pagamentos'] = Imoveis::with('fotosImoveis', 'condicaoImoveis', 'actividadeImoveis.operacaoImoveis', 'estadoImoveis')->get();
            $id_user_marca_visita = SolicitarImoveis::where('user_marca_visita', $userLog->id)->select('imoveis_id')->get();
            if ($userLog->tipo_user_id == 1) {
                $dados['imoveis_processos'] = Imoveis::whereIn('estado_imoveis_id', [4, 5, 6, 7, 8])
                    ->with('fotosImoveis', 'condicaoImoveis', 'actividadeImoveis.operacaoImoveis', 'estadoImoveis')
                    ->get();
            } else {
                $dados['meus_imoveis'] = Imoveis::where('cadastrado_por', $userLog->id)
                ->with('fotosImoveis', 'condicaoImoveis', 'actividadeImoveis.operacaoImoveis', 'estadoImoveis')->orderBy('created_at', 'desc')->get();
                $dados['imoveis_processos'] = Imoveis::whereIn('id', $id_user_marca_visita)->whereIn('estado_imoveis_id', [4, 5, 6, 7, 8])
                    ->with('fotosImoveis', 'condicaoImoveis', 'actividadeImoveis.operacaoImoveis', 'estadoImoveis')->get();
            }
            return Inertia::render('Admin/Clientes/MeusAnuncios', $dados);
        } else {
            $dados['vazio'] = '';
            $dados['meus_imoveis'] = Imoveis::with('fotosImoveis', 'condicaoImoveis', 'actividadeImoveis.operacaoImoveis', 'estadoImoveis')->orderBy('created_at', 'desc')->get();
            $dados['meus_pagamentos'] = Imoveis::with('fotosImoveis', 'condicaoImoveis', 'actividadeImoveis.operacaoImoveis', 'estadoImoveis')->get();

            return Inertia::render('Portal/PortalIndex', $dados);
        }
    }
    public function pdf_declaracao()
    {
        $userLog = auth()->user()->load('tipo_user');
        $declaracao = User::where('id', $userLog->id)->get();
        // $quantidade=count($tipo_problema_projeto);
        // dd($tipo_problema_projeto);
        $pdf = PDF::loadView('declaracaoPDF', [
            'declaracaoPDF' => $declaracao,
            'datatime' => date("Y-m-d"),
            // 'quantidade_modulo_projecto'=>$quantidade,
        ]);
        return $pdf->stream('Listas tipo de problemas projecto.pdf');
        # code...
    }
    // Generate PDF
    public function createPDF()
    {
        // retreive all records from db
        $data = Employee::all();
        // share data to view
        view()->share('employee', $data);
        $pdf = PDF::loadView('pdf_view', $data);
        // download PDF file with download method
        return $pdf->download('pdf_file.pdf');
    }
    public function login_google()
    {

        $googleClient = new GoogleClient;
        $googleClient->init();

        if ($googleClient->authenticated()) {
            $auth = new Authenticate();

            return $auth->authGoogle($googleClient->getData());
        }

        return view('login', ['authUrl' => $googleClient->generateLink()]);
    }
}
