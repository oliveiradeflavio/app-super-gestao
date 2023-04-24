<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    //ajustando o relacionamento da tabela para a tabela de produtos
    protected $table = 'produtos';

    protected $fillable = ['nome', 'descricao', 'peso', 'unidade_id', 'fornecedor_id'];

    //usando o hasone para relacionamento 1:1
    //Produto tem 1 ProdutoDetalhe
    //1 registro relacionado em produto_detalhes com base na fk produto_id
    public function produtoDetalhe()
    {
        return $this->hasOne('App\Models\ItemDetalhe', 'produto_id', 'id');
    }

    public function fornecedor(){
        return $this->belongsTo('App\Models\Fornecedor');
    }
}
