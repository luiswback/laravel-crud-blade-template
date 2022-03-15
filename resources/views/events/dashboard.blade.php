@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

    <div id="dashboard-title-container" class="col-md-10 offset-md-1 dashboard-title-container">
        <h1>Meus Eventos</h1>
    </div>

    <div id="dashboard-events-container" class="col-md-10 offset-md-1 dashboard-events-container">
        @if(count($events) > 0)
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Participantes</th>
                    <th scope="col">Ações</th>
                </tr>
                </thead>

                <tbody>
                @foreach($events as $event)
                    <tr>
                        <td scope="row">{{ $loop->index +1 }}</td>
                        <td><a href="/events/{{ $event->id }}">{{ $event->title }}</a></td>
                        <td>{{ count($event->users) }}</td>
                        <td>
                            <a class="btn btn-info" href="/events/edit/{{ $event->id }}">
                                <ion-icon name="create-outline"></ion-icon>
                                Editar</a>

                            <form action="/events/{{ $event->id }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger ">
                                    <ion-icon name="trash-outline"></ion-icon>
                                    Deletar
                                </button>

                            </form>


                        </td>
                    </tr>

                @endforeach
                </tbody>

            </table>
        @else
            <p>Você ainda não tem eventos. <a href="events/create">crie um evento agora mesmo clicando aqui!</a></p>
        @endif
    </div>


    <div id="dashboard-title-container" class="col-md-10 offset-md-1 dashboard-title-container">
        <h1>Eventos que estou participando</h1>
    </div>

    <div id="dashboard-events-container" class="col-md-10 offset-md-1 dashboard-events-container">
        @if(count($eventasparticipant) > 0):

        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Participantes</th>
                <th scope="col">Ações</th>
            </tr>
            </thead>

            <tbody>
            @foreach($eventasparticipant as $event)
                <tr>
                    <td scropt="row">{{ $loop->index +1 }}</td>
                    <td><a href="/events/{{ $event->id }}">{{ $event->title }}</a></td>
                    <td>{{ count($event->users) }}</td>
                    <td>
                        <form action="/events/leave/{{ $event->id }}" method="post">
                            @csrf
                            @method("DELETE")
                            <button type="submit" class="btn btn-danger delete-btn">
                                <ion-icon name="trash-outline"></ion-icon>
                                Sair do Evento
                            </button>
                        </form>
                    </td>
                </tr>

            @endforeach
            </tbody>

        </table>

        @else

            <p>Você ainda não está participando de nenhum evento. <a href="/">Veja todos os eventos disponíveis clicando aqui!</a></p>

        @endif

    </div>





@endsection
