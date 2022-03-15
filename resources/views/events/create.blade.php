@extends('layouts.main')

@section('title', 'Criar Evento')

@section('content')


    <div id="event-create-container" class="col-md-6 offset-md-3">
        <h1>Crie o seu evento</h1>


        <form action="/events" method="post" enctype="multipart/form-data">
            @csrf  {{-- Necessário para o laravel permitir o envio do form   --}}


            <div class="form-group">
                <label for="image">Imagem do evento:</label>
                <input type="file" id="image" name="image" class="form-control-plaintext" style="color: white">
            </div>

            <div class="form-group">
                <label for="title">Evento:</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Nome do evento" maxlength="45">
            </div>

            <div class="form-group">
                <label for="date">Data do evento:</label>
                <input type="date" class="form-control" id="date" name="date">
            </div>

            <div class="form-group">
                <label for="city">Cidade:</label>
                <input type="text" class="form-control" id="city" name="city" placeholder="Local do evento">
            </div>

            <div class="form-group">
                <label for="private">O evento é privado?</label>
                <select name="private" id="private" class="form-control" >
                    <option value="0">Não</option>
                    <option value="1">Sim</option>
                </select>
            </div>

            <div class="form-group">
                <label for="description">Descrição:</label>
                <textarea name="description" id="description"  class="form-control" placeholder="O que vai acontecer no evento"></textarea>
            </div>

            <input type="submit" class="btn btn-primary" value="Criar Evento">
        </form>
    </div>

@endsection
