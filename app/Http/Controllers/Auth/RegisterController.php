<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Imobiliaria;
use App\Models\Pessoa;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    //REPLICANDO A FUNÇÃO REDIRECTTO E USANDO A VARIAVEL PERFIL PARA OMPREENDER O REDIRECIONAMENTO.
    // protected $redirectPe = RouteServiceProvider::PERFIL;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'tipo_user' => ['required', 'string'],
        ]);
    }
    protected function redirecionarUsuario()
    {
        // Recupere a URL anterior da sessão ou redirecione para uma rota padrão se não houver uma URL anterior.
        $previousUrl = session('previous_url', '/homes');
        // dd($previousUrl);
        return redirect($previousUrl);
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {

        // dd(session('url.intended'));
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'tipo_user' => $data['tipo_user'],
            'password' => Hash::make($data['password']),
        ]);
       
        if ($data['pessoa']) {
            Pessoa::created([
                'user_id'=>$user->id,
                'tipo_documentacoes_id'=>$data['tipo_documentacoes_id'],
                'numero_identificacao'=>$data['numero_identificacao'],
    
            ]);
            
        } else {
            Imobiliaria::created([
                'user_id'=>$user->id,
                'designacao'=>$data['name'],
                'nif'=>$data['nif'],
    
            ]);
        }
        return $user;
        // if (session('url.intended')) {

        //     return redirect()->intended($this->redirectPath());
        // }
    }
    // session(['previous_url' => url()->previous()]);
    // return $this->redirecionarUsuario();
}
