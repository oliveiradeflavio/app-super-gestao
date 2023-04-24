<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use Illuminate\Http\Request;

class FornecedorController extends Controller
{

    public function index(){
        return view('app.fornecedor.index');
    }

    public function listar(Request $request){

        //fazendo a busca no banco de dados

        //para uasr a paginação de resultados, tirei o get() e coloquei o paginate(3)
        $fornecedores = Fornecedor::with(['produtos'])->where('nome', 'like', "%{$request->nome}%")
                                    ->where('site', 'like', "%{$request->site}%")
                                    ->where('uf', 'like', "%{$request->uf}%")
                                    ->where('email', 'like', "%{$request->email}%")        
                                    ->paginate(5);    
 
         //retornando os dados para a view                       
        return view('app.fornecedor.listar', ['fornecedores' => $fornecedores, 'request' => $request->all() ]);
    }

    public function adicionar(Request $request){

        //variavel que irá apresentar a mensagem de sucesso
        $msg = '';

        //inclusão de dados
        if($request->input('_token') != '' && $request->input('id') == ''){
            //cadastro de fornecedor
            
            //validando os dados
            $regras = [
                'nome' => 'required|min:3|max:40',
                'site' => 'required|url',
                'uf' => 'required|size:2',
                'email' => 'email'            
            ];

            //feedback de mensagens de erro/controle
            $feedback = [
                'required' => 'O campo :attribute é obrigatório',               
                'nome.min' => 'O campo nome deve ter no mínimo 3 caracteres',
                'nome.max' => 'O campo nome deve ter no máximo 40 caracteres',            
                'site.url' => 'O campo site deve ter um formato de URL válido (http://www.site.com.br)',                
                'uf.size' => 'O campo UF deve ter 2 caracteres',
                'email.email' => 'O campo email deve ter um formato válido de email'
            ];

            //aplicando a validação
            $request->validate($regras, $feedback);

            //salvando os dados no banco de dados
            $fornecedor = new Fornecedor();
            $fornecedor->create($request->all());

            //mensagem de sucesso
            $msg = "Cadastro realizado com sucesso!";
            
        }

        //se o token estiver preenchido e o id também, será uma edição de fornecedor
        if($request->input('_token') != '' && $request->input('id') != ''){
            $fornecedor = Fornecedor::find($request->input('id'));
            $update = $fornecedor->update($request->all());

            if($update){
                $msg = "Fornecedor atualizado com sucesso!";
            }else{
                $msg = "Erro ao atualizar o fornecedor!";
            }

            return redirect()->route('app.fornecedor.editar', ['id' => $request->input('id'), 'msg' => $msg]);
        }

        return view('app.fornecedor.adicionar', ['msg' => $msg]);
    }

        public function editar($id, $msg = ''){
            //buscando o fornecedor no banco de dados pelo id
            $fornecedor = Fornecedor::find($id);

            //encaminhar os dados para a view adicionar, essa view já tem os campos. Assim não precisamos criar outra view
            return view('app.fornecedor.adicionar', ['fornecedor' => $fornecedor, 'msg' => $msg]);
        }

        public function excluir($id){
            Fornecedor::find($id)->delete();

            return redirect()->route('app.fornecedor');
        }




    // public function index(){
    //     $fornecedores = [
    //         0 =>[ 'nome' => 'Fornecedor 1', 
    //         'status' => 'N', 
    //         'cnpj' => '00.000.000/0001-00', 
    //         'ddd' => '19', 
    //         'telefone' => '99999-9999'],
            
    //         1 =>[ 'nome' => 'Fornecedor 2',
    //         'status' => 'S',
    //         'cnpj' => null,
    //         'ddd' => '11',
    //         'telefone' => '88888-8888'],
            
    //         2 =>[ 'nome' => 'Fornecedor 3',
    //         'status' => 'S',
    //         'cnpj' => null,
    //         'ddd' => '15',
    //         'telefone' => '77777-7777']     
    //     ];

    //     //operador ternário
    //     /*
    //     condicacao ? se verdade : se falso        
    //     */        
    //     // $msg =  isset($fornecedores[0]['cnpj']) ? 'CNPJ informado' : 'CNPJ não informado';
    //     // echo $msg;

    //     return view('app.fornecedor.index', compact('fornecedores'));
    // }
}
