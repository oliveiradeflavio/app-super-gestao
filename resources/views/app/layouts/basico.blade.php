<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>@yield('titulo')</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{ asset('css/estilo_basico.css') }}">

</head>

<body>
    @include('app.layouts._partial.topo') {{-- menu (principal, sobre nós e contato) --}}
    @yield('conteudo')
   

</body>
</html>
