<?php

namespace App\Http\Controllers;

use App\Models\Imoveis;
use App\Models\Municipios;
use App\Models\Provincias;
use App\Models\TipoImoveis;
use App\Models\Tipologia;
use Illuminate\Http\Request;

use Inertia\Inertia;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $dados['provincias']=Provincias::all();
        $dados['municipios']=Municipios::all();
        $dados['tipologiaImoveis']=Tipologia::all();
        $dados['tipoImoveis']=TipoImoveis::all();
        $dados['novos_imoveis']=Imoveis::with('fotosImoveis','condicaoImoveis','actividadeImoveis.operacaoImoveis','estadoImoveis')->orderBy('created_at','desc')->get();
        $dados['mais_proximos']=Imoveis::with('fotosImoveis','condicaoImoveis','actividadeImoveis.operacaoImoveis','estadoImoveis')->get();
        // dd($dados);
        return Inertia::render('Portal/PortalIndex', $dados);
        // return Inertia::render('Admin/Home');
    }
    public function portal_auth()
    {
        return Inertia::render('Admin/Portal');
    }
}
