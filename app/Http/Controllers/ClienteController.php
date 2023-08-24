<?php

namespace App\Http\Controllers;
// use Socialite;
use App\Library\Authenticate;
use App\Library\GoogleClient;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Socialite;
use Laravel\Socialite\Facades\Socialite as FacadesSocialite;


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
        
        return Inertia::render('Admin/Clientes/Cliente');
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



public function redirectToGoogle()
{
    // dd(1);
  
    return Socialite::driver('google')->redirect();
}

public function handleGoogleCallback()
{
    $user = Socialite::driver('google')->user();
    // Faça o login do usuário ou registre-o conforme necessário
    // $user contém as informações do usuário retornado pelo Google

    return redirect('/home'); // Redirecionar após o login
}
}
