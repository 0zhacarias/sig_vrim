<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Socialite\Facades\Socialite;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|*/
//Rotas para fazer o login com a conta google usando o Socialite.
Route::get('/auth/redirect',[App\Http\Controllers\Auth\LoginController::class,'redirectToGoogle'])->name('login.google');
Route::get('/auth/callback',[App\Http\Controllers\Auth\LoginController::class,'handleGoogleCallback'])->name('callback.google');
// Route::get('/auth/redirect', function () {
//     return Socialite::driver('google')->redirect();
// });
 
// Route::get('/auth/callback', function () {
//     $user = Socialite::driver('google')->user();
//     // $user->token
// });

Route::get('/login/google', [App\Http\Controllers\ClienteController::class,'redirectToGoogle']);
Route::get('/login/google/callback', [App\Http\Controllers\ClienteController::class,'handleGoogleCallback']);
// Route::get('/', function () {
//     return Inertia::render('Portal/PortalIndex');
//     // return view('welcome');
// })->name('index');
Route::get('/',[App\Http\Controllers\ImoveisController::class,'index'])->name('index');
Route::get('/RegistrarConta', function () {
    return Inertia::render('Portal/RegistrarConta');
    // return view('welcome');
});

Route::get('/Registrar-conta', function () {
    return Inertia::render('Portal/RegistrarConta');
    // return view('welcome');
});
Route::get('/logar', function () {
    return Inertia::render('Portal/Login') ;
})->name('login.login');
Route::get('/condominio/create', function () {
    return Inertia::render('Portal/RegistrarConta');
});
Route::group(['prefix' => 'portal'], function () {
Route::resource('/imoveis',App\Http\Controllers\ImoveisController::class);
// Route::resource('/imovel-selecionado',App\Http\Controllers\ImoveisController::class);
Route::resource('/imobiliaria-proprietario',App\Http\Controllers\ProprietarioController::class);
Route::resource('/venda-arendamento',App\Http\Controllers\VendaController::class);
Route::resource('/Solicitar-venda',App\Http\Controllers\VendaController::class);
Route::resource('/Solicitar-arrendamento',App\Http\Controllers\ArrendamentoController::class);
Route::resource('/Pagamento',App\Http\Controllers\PagamentoController::class);
Route::post('/Solicitar-visita',[App\Http\Controllers\SolicitarImoveisController::class,'solicitar_visita'])->name('solicitar-visita');
Route::post('/municipios',[App\Http\Controllers\ImoveisController::class,'municipios'])->name('municipios');
Route::post('/tipo-tipologia',[App\Http\Controllers\ImoveisController::class,'tipo_tipologia'])->name('tipo-tipologia');
// Route::post('/Solicitar-visita/{id}',[App\Http\Controllers\ImoveisController::class,'solicitar_visita']);
Route::get('/imovel-selecionado/{id}',[App\Http\Controllers\ImoveisController::class,'imovel_selecionado'])->name('immovel-selecionado');
Route::get('/imoveis-provincia/{id}',[App\Http\Controllers\ImoveisController::class,'imoveis_provincia']);
Route::get('/listaImoveisCompras',[App\Http\Controllers\ImoveisController::class,'lista_imoveis_comprar'])->name('comprar-imoveis');
Route::get('/listaImoveisArrendamentos',[App\Http\Controllers\ImoveisController::class,'lista_imoveis_arrendamento'])->name('arrendar-imoveis');
Route::post('/filtrarImoveisPaginate',[App\Http\Controllers\ImoveisController::class,'filtrar_imoveis_paginate'])->name('pesquisar-imoveis');
Route::get('/imoveisPaginacao',[App\Http\Controllers\ImoveisController::class,'imoveis_paginacao'])->name('novos-imoveis');
Route::get('/imoveisProximoPaginacao',[App\Http\Controllers\ImoveisController::class,'paginacao_imoveis_proximo'])->name('imoveis-proximos');

});

Route::get('/arrendamento', function () {
    return Inertia::render('Portal/Arrendamento');
})->name('arrendamento');


// Route::get('/home', function () {
//     return view('home');
// });

// Route::resource('/registrar-usuario',App\Http\Controllers\RegistrarController::class);
// Route::post('/registrar',[App\Http\Controllers\RegistrarController::class,'registrar_usuario']);
Route::get('/register', function () {
    return view('auth.register');
})->name('cadastrar');
// Route::post('/register', function () {
//     return Inertia::render('auth.register');
// })->name('cadastrar');
Route::get('/login', function () {
    return view('auth.login');
})->name('login');
Auth::routes();
// Route::post('/register', App\Http\Controllers\Auth\RegisterController::class);
// Route::get('/', function () {
//     return Inertia::render('Portal/PortalIndex');
//     // return view('welcome');
// })->name('index');
Route::get('/',[App\Http\Controllers\ImoveisController::class,'portal_imovel'])->name('index');

Route::get('/perfil',[App\Http\Controllers\ClienteController::class,'perfil_cliente']);
Route::resource('/home', App\Http\Controllers\HomeController::class);
Route::resource('/moradores', App\Http\Controllers\MoradorController::class);
Route::resource('/condominios', App\Http\Controllers\CondominioController::class);
Route::get('/paginarwte', [App\Http\Controllers\HomeController::class, 'portal_auth'])->name('home');
Route::post('/nao-validar-processo', [App\Http\Controllers\ActividadeImoveisController::class, 'nao_validar_processo'])->name('gostar');
Route::post('/validar-processo', [App\Http\Controllers\ActividadeImoveisController::class, 'validar_processo'])->name('home');
Route::post('/gostar-imovel', [App\Http\Controllers\ActividadeImoveisController::class, 'gostar_imovel'])->name('naogostar');
Route::post('/nao-gostar-imovel', [App\Http\Controllers\ActividadeImoveisController::class, 'nao_gostar_imovel'])->name('home');
Route::post('/carregar-imoveis-processo', [App\Http\Controllers\ActividadeImoveisController::class, 'carregar_imoveis_processo'])->name('carregar_imoveis');
Route::resource('/funcionario',App\Http\Controllers\FuncionarioController::class);
Route::resource('/cliente',App\Http\Controllers\ClienteController::class);