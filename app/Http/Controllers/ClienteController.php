<?php

namespace App\Http\Controllers;
// use Socialite;
use App\Library\Authenticate;
use App\Library\GoogleClient;
use App\Models\Cliente;
use App\Models\Imoveis;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
// use App\Http\Controllers\Socialite;
use Laravel\Socialite\Facades\Socialite;
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
        //
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
        
        //
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
        //
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
    public function perfil_cliente()
    {
        
        $dados['meus_imoveis']=Imoveis::with('fotosImoveis','condicaoImoveis','actividadeImoveis.operacaoImoveis','estadoImoveis')->orderBy('created_at','desc')->get();
        $dados['meus_pagamentos']=Imoveis::with('fotosImoveis','condicaoImoveis','actividadeImoveis.operacaoImoveis','estadoImoveis')->get();
        $dados['imoveis_processos']=Imoveis::with('fotosImoveis','condicaoImoveis','actividadeImoveis.operacaoImoveis','estadoImoveis')->get();
       
        return Inertia::render('Admin/Clientes/Cliente',$dados);
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
