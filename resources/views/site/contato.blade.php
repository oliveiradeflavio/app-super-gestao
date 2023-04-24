@extends('site.layouts.basico')
@section('conteudo')
@section('titulo', $titulo) {{-- $titulo é uma variável que foi passada como parâmetro para a view lá do controlador --}}}

        <div class="conteudo-pagina">
            <div class="titulo-pagina">
                <h1>Entre em contato conosco</h1>
            </div>

            <div class="informacao-pagina">
                <div class="contato-principal">
                    @component('site.layouts._components.form_contato', ['classe' => 'borda-preta', 'mensagem' => 'Mensagem enviada com sucesso! Entraremos em contato o mais breve possível.', 'motivo_contato' => $motivo_contato])
                     <p>Nossa equipe entrará em contato com você o mais breve possível.</p>
                    @endcomponent
                </div>
            </div>  
        </div>

        {{-- {{ print_r($motivo_contato)}} --}}

        <div class="rodape">
            <div class="redes-sociais">
                <h2>Redes sociais</h2>
                <img src="{{asset('img/facebook.png')}}">
                <img src="{{asset('img/linkedin.png')}}">
                <img src="{{asset('img/youtube.png')}}">
            </div>
            <div class="area-contato">
                <h2>Contato</h2>
                <span>(11) 3333-4444</span>
                <br>
                <span>supergestao@dominio.com.br</span>
            </div>
            <div class="localizacao">
                <h2>Localização</h2>
                <img src="{{asset('img/mapa.png')}}">
            </div>
        </div>

@endsection