<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\LogAcesso;

class LogAcessoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {       

        //$request - manipular
        $ip = $request->server->get('REMOTE_ADDR');
        $rota = $request->getRequestUri();

        //salvando no banco de dados como log
        LogAcesso::create(['log' => "IP: $ip requisitou a rota $rota"]);
        
        //return $next($request);
        //return Response('Chegamos no middleware e finalizamos por aqui');

        //response - manipular

        $resposta = $next($request);
        $resposta->setStatusCode(201, 'Acesso foi modificado via middleware');
        return $resposta;
        //dd($resposta);
    }
}
