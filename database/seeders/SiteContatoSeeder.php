<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SiteContato;

class SiteContatoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //inserindo um registro
        // $contato = new SiteContato();
        // $contato->nome = "Sistema SG";
        // $contato->telefone = "(19) 99999-9999";
        // $contato->email = "contato@sg.com.br";
        // $contato->motivo_contato = "1";
        // $contato->mensagem = "Bem vindo ao sistema Super Gestão";
        // $contato->save();

        \App\Models\SiteContato::factory()->count(100)->create();
    }
}
