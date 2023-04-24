<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TesteController extends Controller
{
    public function teste($p1, $p2){
        // echo "parâmetro 1: $p1";
        // echo "<br>";
        // echo "parâmetro 2: $p2";
        // echo "<br>";
        // echo "A soma de $p1 + $p2 é: " . ($p1 + $p2);
        
        //return view('site.teste', ['p1' => $p1, 'p2' => $p2]); //passando os parametros para a view array associativo
        
        //return view('site.teste', compact('p1', 'p2')); //compact
        
        return view('site.teste')->with('p1', $p1)->with('p2', $p2); //whith
    }
}
