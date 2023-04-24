<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fornecedor extends Model
{
    use HasFactory;
    use SoftDeletes; //usando o trait para usar o softdelete

    //ajustando a tabela que o eloquent irá usar
    protected $table = 'fornecedores';
    
    //usando o metodo fillable para definir quais campos podem ser preenchidos usando o tinker
    protected $fillable = ['nome', 'site', 'uf', 'email'];

    public function produtos(){
        return $this->hasMany('App\Models\Item', 'fornecedor_id', 'id');
    }

    /*
    * usando o metodo save() para salvar os dados no banco de dados
    * usando o metodo all() para recuperar todos os registros do banco de dados 
    * usando o metodo find() para recuperar o registro do banco passando o id (pk) como parametro. Exemplo: find(id), find([1,2,3])
    * usando o metodo where() para recuperar o registro do banco passando o campo, a operação_comparador e o valor como parametro. Exemplo: where('campo', 'operador de comparação', 'valor')->get()
    * usando o metodo whereIn() para recuperar o registro do banco passando o campo e o array de valores como parametro. Exemplo: whereIn('campo', ['valor1', 'valor2', 'valor3'])->get()
    * usando o metodo whereNotIn() para recuperar o registro do banco passando o campo que sejam diferentes do array de valores como parametro. Exemplo: whereNotIn('campo', ['valor1', 'valor2', 'valor3'])->get()
    * usando o metodo whereBetween() para recuperar o registro do banco passando o campo que estejam em um intervalo do array de valores como parametro. Exemplo: whereBetween('campo', ['valor1', 'valor2'])->get()
    * usando o metodo whereNotBetween() para recuperar o registro do banco passando o campo que não estejam em um intervalo do array de valores como parametro. Exemplo: whereNotBetween('campo', ['valor1', 'valor2'])->get()
    * usando o metodo fill() para preencher/atualizar os campos do objeto com os valores passados como parametro. Exemplo: fill(['campo1' => 'valor1', 'campo2' => 'valor2'])
    * usando o metodo update() para atualizar os dados no banco de dados. Exemplo:  Fornecedor::whereIn('id', [1,2])->update(['nome' => 'Fornecedor Teste', 'site' => 'teste.com.br' ]); 
    * usando o metodo delete() para deletar os dados no banco de dados. Exemplo: Fornecedor::where('id', 1)->delete(); SiteContato::find(7)->delete();
    * usando o metodo detroy() para deletar os dados no banco de dados. Exemplo: Fornecedor::destroy(2); Fornecedor::destroy([3,4,5]); SiteContato::destroy(5);
    * usando softdeletes() para inativar os dados no banco de dados. Exemplo: Fornecedor::destroy(2); Fornecedor::destroy([3,4,5]); SiteContato::destroy(5);
    * usando o metodo withTrashed() / onlyTrashed() para recuperar os dados inativos no banco de dados. Exemplo: Fornecedor::withTrashed()->get();
    * usando o restore() para restaurar os dados inativos no banco de dados. Exemplo: Fornecedor::withTrashed()->where('id', 2)->restore();

     selecionando vários registros com where com and
     $contatos = SiteContato::where('nome', '<>', 'Flávio')->whereIn('motivo_contato', [1,2])->whereBetween('created_at',['2022-12-01 00:00:00', '2022-12-31 23:59:59'])->get();
    
     * selecionando vários registros com where com or
     $contatos = SiteContato::where('nome', '<>', 'Flávio')->orWhereIn('motivo_contato', [1,2])->orWhereBetween('created_at',['2022-12-01 00:00:00', '2022-12-31 23:59:59'])->get();

     *selecionando registros com o whereNull e whereNotNull
        $contatos = SiteContato::whereNull('updated_at')->get();
        $contatos = SiteContato::whereNotNull('created_at')->get();

    *selecionando registros por data e hora
        $contatos = SiteContato::whereDate('created_at', '2022-12-31')->get();
        $contatos = SiteContato::whereMonth('created_at', '12')->get();
        $contatos = SiteContato::whereDay('created_at', '31')->get();
        $contatos = SiteContato::whereYear('created_at', '2022')->get();
        $contatos = SiteContato::whereTime('created_at', '23:59:59')->get();

    *selecionando registros com o whereColumn
     $contato = SiteContato::whereColumn('created_at', 'updated_at')->get();
     $contato = SiteContato::whereColumn('created_at', '>', 'updated_at')->get();
     $contato = SiteContato::where('id', '>=', 2)->whereColumn('created_at', '>=', 'updated_at')->get();
     
     *ordenando resultados
        $contatos = SiteContato::orderBy('nome', 'desc')->get();
        $contatos = SiteContato::orderBy('nome', 'desc')->orderBy('motivo_contato', 'asc')->get();
        $contatos = SiteContato::whereBetween('id', [2,6])->orderBy('motivo_contato')->orderBy('nome', 'desc')->get();

    *collection  - first, last e reverse
        $contatos = SiteContato::all();
        $primeiro = $contatos->first();
        $ultimo = $contatos->last();
        $contatos = $contatos->reverse();
    
    *collection  - toArray() e toJson()
        $contatos = SiteContato::all();
        $contatos = $contatos->toArray();
        $contatos = $contatos->toJson();
    
    *collection  - pluck()
        $contatos = SiteContato::all();
        $contatos = $contatos->pluck('nome');
        $contatos = $contatos->pluck('nome', 'id');
        $contatos = $contatos->pluck('email', 'nome');
     
    https://laravel.com/docs/9.x/collections




     */
}
