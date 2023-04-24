<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    public function index(Request $request){
        $erro = '';
        if($request->get('erro') == 1){
            $erro = 'Usuário ou senha inválido(s)';
        }
        if($request->get('erro') == 2){
            $erro = 'Faça login para acessar o painel';
        }

        return view('site.login', ['titulo' => 'Login', 'erro' => $erro]);
    }

    public function autenticar(Request $request){
        //regras de validação
        $regras = [
            'usuario' => 'email',
            'senha' => 'required'
        ];

        //mensagens de feedback de validação
        $feedback = [
            'usuario.email' => 'O campo usuário precisa ser um e-mail válido',
            'senha.required' => 'O campo senha é obrigatório'
        ];

        //validando os dados
        $request->validate($regras, $feedback);

        //recuperando os dados do formulário
        $email = $request->get('usuario');
        $password = $request->get('senha');

        // echo "Usuario: $email <br>";
        // echo "Senha: $password <br>";

        //iniciar o Model User
        $user  = new User();
        
        $usuario = $user->where('email', $email)->where('password', $password)->get()->first();

        if(isset($usuario->name)){
           // echo "Usuário existe";
           session_start();
           $_SESSION['nome'] = $usuario->name;
           $_SESSION['email'] = $usuario->email;
           return redirect()->route('app.home'); 

        }else{
            return redirect()->route('site.login', ['erro' => 1]);
        }

        //verificando se o usuário existe     
    }

    public function sair(){
        session_destroy();
        return redirect()->route('site.index');
    }
}
