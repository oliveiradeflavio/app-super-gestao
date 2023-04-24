<form action={{ route('site.contato') }} method="post">
    @csrf
    <input name='nome' value='{{old('nome')}}' type="text" placeholder="Nome" class="{{$classe}}">
    @if($errors->has('nome'))
        {{$errors->first('nome')}}
    @endif
    <br>
    <input name='telefone' value='{{old('telefone')}}' type="text" placeholder="Telefone" class="{{$classe}}">
    {{ $errors->has('telefone') ? $errors->first('telefone') : ''}}
    <br>
    <input name='email' value='{{old('email')}}' type="text" placeholder="E-mail" class="{{$classe}}">
    {{ $errors->has('email') ? $errors->first('email') : ''}}
    <br>
    {{-- {{ print_r($motivo_contato)}} --}}
    <select class="{{$classe}}" name='motivo_contatos_id'>
        <option value="">Qual o motivo do contato?</option>

        {{-- informação vindo de ContatoController --}}
        @foreach ($motivo_contato as $key => $mc )
            <option value="{{ $mc->id }}" {{old('motivo_contatos_id') == $mc->id ? 'selected' : ''}}>{{ $mc->motivo_contato }}</option>
        @endforeach

        {{-- <option value="1" {{old('motivo_contato') == 1 ? 'selected' : ''}}>Dúvida</option>
        <option value="2" {{old('motivo_contato') == 2 ? 'selected' : ''}}>Elogio</option>
        <option value="3" {{old('motivo_contato') == 3 ? 'selected' : ''}}>Reclamação</option> --}}
    </select>
    {{ $errors->has('motivo_contatos_id') ? $errors->first('motivo_contatos_id') : ''}}
    <br>
    <textarea name='mensagem' class="{{$classe}}">{{ (old('mensagem') != '') ? old('mensagem'): 'Preencha aqui a sua mensagem' }}   
    </textarea>
    {{ $errors->has('mensagem') ? $errors->first('mensagem') : ''}}
    <br>
    <button type="submit" class="{{$classe}}">ENVIAR</button>
</form>
{{ $slot }}

@if($errors->any())

    <div style="position:absolute; top:0px; left:0px; width:100%; background:red">
        @foreach ($errors->all() as $erro )
            {{ $erro }}
            <br>
        @endforeach
    </div>
@endif


