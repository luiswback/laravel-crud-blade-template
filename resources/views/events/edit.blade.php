@extends('layouts.main')

@section('title', 'Editando:' . $event->title)

@section('content')


    <div id="event-create-container" class="col-md-6 offset-md-3">
        <h1>Editando: {{ $event->title }}</h1>


        <form action="/events/update/{{ $event->id }}" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="_method" value="PUT">  {{--  Input usado para o método put funcionar sem dar pau --}}

            @csrf  {{-- Necessário para o laravel permitir o envio do form   --}}


            <div class="form-group">
                <label for="image">Imagem do evento:</label>
                <input type="file" id="image" name="image" class="form-control-plaintext" style="color: white">
                <img class="img-preview" src="/imagem/events/{{ $event->image }}" alt="{{ $event->title }}">
            </div>

            <div class="form-group">
                <label for="title">Evento:</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Nome do evento"  value="{{ $event->title }}" maxlength="45">
            </div>

            <div class="form-group">
                <label for="date">Data do evento:</label>
                <input type="date" class="form-control" id="date" name="date" value="{{$event->date->format('Y-m-d')}}">
            </div>

            <div class="form-group">
                <label for="city">Cidade:</label>
                <input type="text" class="form-control" id="city" name="city" placeholder="Local do evento" value="{{ $event->city }}">
            </div>

            <div class="form-group">
                <label for="private">O evento é privado?</label>
                <select name="private" id="private" class="form-control">
                    <option value="0">Não</option>
                    <option value="1" {{ $event->private === 1 ? "selected='selected'" : "" }}>Sim</option>
                </select>
            </div>

            <div class="form-group">
                <label for="description">Descrição:</label>
                <textarea name="description" id="description"  class="form-control" placeholder="O que vai acontecer no evento">{{ $event->description }}</textarea>
            </div>

            <input type="submit" class="btn btn-primary" value="Editar evento">
        </form>
    </div>

@endsection
