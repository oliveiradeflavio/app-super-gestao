<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;
    protected $fillable = ['nome', 'descricao', 'peso', 'unidade_id'];

    //usando o hasone para relacionamento 1:1
    //Produto tem 1 ProdutoDetalhe
    //1 registro relacionado em produto_detalhes com base na fk produto_id
    public function produtoDetalhe(){
        return $this->hasOne('App\Models\ProdutoDetalhe');
    }
}
