<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return "Olá, seja bem vindo ao curso de Laravel 9";
// });

Route::get("/", "App\http\Controllers\PrincipalController@principal")->name('site.index');

// Route::get('/sobre-nos', function () {
//     return "sobre nós";
// });

Route::get("/sobre-nos", "App\http\Controllers\SobreNosController@sobrenos")->name('site.sobrenos')->middleware('log.acesso');

// Route::get('/contato', function () {
//     return "contato";
// });

Route::get("/contato", "App\http\Controllers\ContatoController@contato")->name('site.contato');
Route::post("/contato", "App\http\Controllers\ContatoController@salvar")->name('site.contato');


//nome, categoria, assunto, mensagem

//tornando o parametro opcional inserindo o caracter ? no final do parametro e atribuindo um valor padrão na função de callback
// Route::get('/contato/{nome}/{categoria}/{assunto}/{mensagem?}', function(string $nome, string $categoria, string $assunto, string $mensagem = 'mensagem não informada'){
//     echo "Estamos aqui: ".$nome . " " . $categoria . " " . $assunto . " " . $mensagem;
// });

//usando expressões regulares para validar os parametros
// Route::get('/contato/{nome}/{categoria_id}', 
// function(
//     string $nome = "Desconhecido", 
//     int $categoria_id = 1 // 1 ->'Informação'
//     )
//     {
//     echo "Estamos aqui: $nome - $categoria_id";
// })->where('categoria_id', '[0-9]+')->where('nome', '^[\p{L}\s-]+'); //full Letter Unicode property \p{L}.

Route::get("/login/{erro?}", 'App\http\Controllers\LoginController@index')->name('site.login');
Route::post("/login", 'App\http\Controllers\LoginController@autenticar')->name('site.login');

//agrupando rotas -> usando o prefix app
Route::middleware('autenticacao:padrao,visitante')->prefix('/app')->group(function () {
    Route::get("/home", 'App\http\Controllers\HomeController@index')->name('app.home');
    Route::get("/sair", 'App\http\Controllers\LoginController@sair')->name('app.sair');
    Route::get("/cliente", 'App\http\Controllers\ClienteController@index')->name('app.cliente');
    
    Route::get('/fornecedor', 'App\Http\Controllers\FornecedorController@index')->name('app.fornecedor');
    Route::post('/fornecedor/listar', 'App\Http\Controllers\FornecedorController@listar')->name('app.fornecedor.listar');
    Route::get('/fornecedor/listar', 'App\Http\Controllers\FornecedorController@listar')->name('app.fornecedor.listar');
    Route::get('/fornecedor/adicionar', 'App\Http\Controllers\FornecedorController@adicionar')->name('app.fornecedor.adicionar');
    Route::post('/fornecedor/adicionar', 'App\Http\Controllers\FornecedorController@adicionar')->name('app.fornecedor.adicionar');
    Route::get('/fornecedor/editar/{id}/{msg?}', 'App\Http\Controllers\FornecedorController@editar')->name('app.fornecedor.editar');
    Route::get('/fornecedor/excluir/{id}', 'App\Http\Controllers\FornecedorController@excluir')->name('app.fornecedor.excluir');
    
    
    
    //produtos
   // Route::get("/produto", 'App\http\Controllers\ProdutoController@index')->name('app.produto');
   Route::resource('produto', 'App\http\Controllers\ProdutoController');

   //produtos_detalhes
   Route::resource('produto-detalhe', 'App\http\Controllers\ProdutoDetalheController');
   
});

//redirecionamento de rotas 
// Route::get('/rota1', function() {return 'rota1';})->name('site.rota1');

// Route::get('/rota2', function() {return redirect()->route('site.rota1');})->name('site.rota2');

// //Pode ser utilizado o redirect, passando a rota de origem para a rota de destino.
// //Route::redirect('/rota2','/rota1');

Route::get('/teste/{p1}/{p2}', 'App\Http\Controllers\TesteController@teste')->name('teste');


//rota de fallback -> rota 404 not found
Route::fallback(function () {
    echo "A rota acessada não existe. <a href='" . route('site.index') . "'>clique aqui</a> para ir para página principal";
});




/* verbo http
get
post
put
patch
delete
options
*/