<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdutoDetalhe extends Model
{
    use HasFactory;
    protected $fillable = ['produto_id', 'comprimento', 'largura', 'altura', 'unidade_id'];

    //usando o belongsTo para relacionamento 1:1
    public function produto(){
        return $this->belongsTo('App\Models\Produto');
    }
}
