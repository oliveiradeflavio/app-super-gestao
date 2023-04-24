<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Fornecedor;
use Illuminate\Support\Facades\DB;

class FornecedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //instanciando um objeto Fornecedor e setando seus atributos
        $fornecedor = new Fornecedor();
        $fornecedor->nome = "Fornecedor 100";
        $fornecedor->site = "fornecedor100.com.br";
        $fornecedor->uf = "MG";
        $fornecedor->email = "contato@fornecedor100.com.br";
        $fornecedor->save();

        // Outra forma de criar um registro (atenção par ao atributo fillable do model Fornecedor)
        Fornecedor::create([
            'nome' => 'Fornecedor 200',
            'site' => 'fornecedor200.com.br',
            'uf' => 'SP',
            'email' => 'contato@fornecedor200.cm.br'
        ]);

        //outra forma de criar um registro, insert tradicional que não passa pelo tratamento do eloquent
        DB::table('fornecedores')->insert([
            'nome' => 'Fornecedor 300',
            'site' => 'fornecedor300.com.br',
            'uf' => 'RJ',
            'email' => 'contato@fornecedor300.com.br'
        ]);    
    
    }
}
