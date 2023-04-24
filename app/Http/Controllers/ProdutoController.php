<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\ProdutoDetalhe;
use App\Models\Unidade;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Fornecedor;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$produtos = Produto::paginate(10);

        //usando hasone e belongsTo para nomes não padronizados
       //$produtos = Item::paginate(10);
       $produtos = Item::with(['produtoDetalhe'])->paginate(10); //mudando o carregamento para eager loading

       /* aproach 1 para 1 relacionamento 1:1
       foreach($produtos as $key => $produto){
            //print_r($produto->getAttributes());
            //echo '<br><br><br>';

            $produtoDetalhe = ProdutoDetalhe::where('produto_id', $produto->id)->first();
            if(isset($produtoDetalhe)){
                //print_r($produtoDetalhe->getAttributes());

                $produtos[$key]['comprimento'] = $produtoDetalhe->comprimento;
                $produtos[$key]['largura'] = $produtoDetalhe->largura;
                $produtos[$key]['altura'] = $produtoDetalhe->altura;
            }
           // echo '<hr>';
        }
        */

       return view('app.produto.index', ['produtos' => $produtos, 'request' => $request->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $unidades = Unidade::all();
        $fornecedores = Fornecedor::all();
        
        return view('app.produto.create', ['unidades' => $unidades, 'fornecedores' => $fornecedores ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $regras = [
            'nome' => 'required|min:3|max:40',
            'descricao' => 'required|min:3|max:2000',
            'peso' => 'required|integer',
            'unidade_id' => 'exists:unidades,id',

        ];

        $feedback = [
            'required' => 'O campo :attribute é obrigatório',
            'nome.min' => 'O campo nome precisa ter no mínimo 3 caracteres',
            'nome.max' => 'O campo nome precisa ter no máximo 40 caracteres',
            'descricao.min' => 'O campo descrição precisa ter no mínimo 3 caracteres',
            'descricao.max' => 'O campo descrição precisa ter no máximo 2000 caracteres',
            'peso.integer' => 'O campo peso precisa ser um número inteiro',
            'unidade_id.exists' => 'A unidade de medida informada não existe',
        ];

        $request->validate($regras, $feedback);

        Produto::create($request->all());
        return redirect()->route('produto.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function show(Produto $produto)
    {
        //dd($produto);
        return view('app.produto.show', ['produto' => $produto]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function edit(Produto $produto)
    {
        $unidades = Unidade::all();
        $fornecedores = Fornecedor::all();
        return view('app.produto.edit', ['produto' => $produto, 'unidades' => $unidades, 'fornecedores' => $fornecedores ]);
        //return view('app.produto.create', ['produto' => $produto, 'unidades' => $unidades ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produto $produto)
    {
        //$request->all(); //payload
        //$produto //instancia do objeto no estado anterior
        $regras = [
            'nome' => 'required|min:3|max:40',
            'descricao' => 'required|min:3|max:2000',
            'peso' => 'required|integer',
            'unidade_id' => 'exists:unidades,id',
            'fornecedor_id' => 'exists:fornecedores,id',

        ];

        $feedback = [
            'required' => 'O campo :attribute é obrigatório',
            'nome.min' => 'O campo nome precisa ter no mínimo 3 caracteres',
            'nome.max' => 'O campo nome precisa ter no máximo 40 caracteres',
            'descricao.min' => 'O campo descrição precisa ter no mínimo 3 caracteres',
            'descricao.max' => 'O campo descrição precisa ter no máximo 2000 caracteres',
            'peso.integer' => 'O campo peso precisa ser um número inteiro',
            'unidade_id.exists' => 'A unidade de medida informada não existe',
            'fornecedor_id.exists' => 'O fornecedor informado não existe',
        ];

        $request->validate($regras, $feedback);
           
        $produto->update($request->all()); //atualiza o objeto no estado anterior com os dados do payload
        return redirect()->route('produto.show', ['produto' => $produto->id ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produto $produto)
    {
        //
        // dd($produto);
        $produto->delete();
        return redirect()->route('produto.index');
        
    }
}
