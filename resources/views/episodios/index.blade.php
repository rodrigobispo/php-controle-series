@extends('layout')

@section('cabecalho')
    Episódios da Temporada {{ $temporada->numero }}
@endsection

@section('conteudo')
@include('mensagem', ['mensagem' => $mensagem])

<form action="/temporadas/{{ $temporada->id }}/episodios/assistir" method="POST">
    @csrf
    <ul class="list-group">
            @foreach($episodios as $ep)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                Episódio {{ $ep->numero }}
                <input type="checkbox" 
                    name="episodios[]" 
                    value='{{ $ep->id }}'
                    {{ $ep->assistido ? 'checked' : '' }}>
            </li>
            @endforeach
    </ul>

    <button class="btn btn-primary mt-2 mb-2">Salvar</button>
</form>
@endsection
