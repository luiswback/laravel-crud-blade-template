@extends('layouts.main')

@section('title', 'Eventos E-Sports')

@section('content')

    <div id="search-container" class="col-md-12">

        <h1>Busque por um evento</h1>

        <form action="/" method="get">
            <input type="text" name="search" id="search" class="form-control" placeholder="Procurar evento... ">
            <button class="busca"><ion-icon name="search-outline"></ion-icon></button>
        </form>
    </div>

    <div id="events-container" class="col-md-12">
        @if($search)
            <h2>Buscando por: {{ $search }}</h2>
            <p class="subtitle">Veja os eventos dos próximos dias</p>
        @else
            <h2>Próximos Eventos</h2>

        @endif

        <div id="cards-container" class="row">
            @foreach($events as $event)
                <div class="card col-md-3">
                    <div class="test">
                        <img src="/imagem/events/{{ $event->image }}" alt="{{ $event->title }}">
                    </div>
                    <div class="card-body">
                        {{--   Formatando a data para os padrões BR--}}
                        <p class="card-date">{{ date('d/m/Y', strtotime($event->date)) }}</p>
                        <h5 class="card-title">{{ $event->title }}</h5>
                        <p class="card-participants">{{ count($event->users)}} Participantes</p>
                        <a href="/events/{{ $event->id }}" class="btn btn-primary">Saber mais</a>
                    </div>
                </div>
            @endforeach
            @if(count($events) === 0 && $search)
                <p>Não foi possível encontrar nenhum evento com {{ $search }}!
                    <br><br>
                    <a href="/"><button class="btn btn-primary">Ver todos os eventos disponíveis</button></a>
                </p>
                @elseif(count($events) === 0)
                    <p>Não há eventos disponíveis</p>

                @endif
        </div>
    </div>

    {{--Comentário aleatório! > nao renderiza na view--}}

@endsection
