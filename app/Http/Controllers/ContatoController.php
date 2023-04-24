<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SiteContato;
use App\Models\MotivoContato;

class ContatoController extends Controller
{
    public function contato(Request $request){
        $titulo = 'Super Gestão - Contato';

        //var_dump($_GET);
        //var_dump($_POST);
        // echo '<pre>';
        // print_r($request->all());
        // echo '</pre>';
        // echo $request->input('nome');
        // echo '<br>';
        // echo $request->input('email');

        /*  // Forma 1 de salvar no banco
        $contato = new SiteContato();
        $contato->nome = $request->input('nome');
        $contato->telefone = $request->input('telefone');
        $contato->email = $request->input('email');
        $contato->motivo_contato = $request->input('motivo_contato');
        $contato->mensagem = $request->input('mensagem');

        //print_r($contato->getAttributes());
        $contato->save();
        */


        // Forma 2 de salvar no banco usando o fill e fillable preenchido no model site contato
        // $contato = new SiteContato();
        // $contato->fill($request->all());
        // //print_r($contato->getAttributes());
        // $contato->save();

        // Forma 3 de salvar no banco usando o create e fillable preenchido no model site contato
        // $contato = new SiteContato();
        // $contato->create($request->all());


        $motivo_contato = MotivoContato::all();           

        
        return view('site.contato', ['titulo' => 'Super Gestão - Contato', 'motivo_contato' => $motivo_contato ]);
    }

    public function salvar(Request $request){
        //realizar a validação dos dados do formulário recebido no request 
        $request->validate([
            'nome' => 'required|min:3|max:40|unique:site_contatos,nome',
            'telefone' => 'required',
            'email' => 'required|email',
            'motivo_contatos_id' => 'required',
            'mensagem' => 'required|min:10|max:2000'
        ], 
        [
            
            'nome.min' => 'O campo nome precisa ter no mínimo :min caracteres',
            'nome.max' => 'O campo nome precisa ter no máximo :max caracteres',
            'nome.unique' => 'O nome informado já está em uso',            
            
            'email.email' => 'O campo email precisa ser um email válido',
                     
            'mensagem.min' => 'O campo mensagem precisa ter no mínimo :min caracteres',
            'mensagem.max' => 'O campo mensagem precisa ter no máximo :max caracteres',

            'required' => 'O campo :attribute é obrigatório'

        ]
    );
        SiteContato::create($request->all());
        return redirect()->route('site.index');
    } 
}
