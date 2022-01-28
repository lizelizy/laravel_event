@extends('layouts.main') <?php // Funciona como o include_once ?>

@section('title', 'HCD Events') <?php // Define o título da página ?>

@section('content') <?php // Copia o conteúdo selecionado do arquivo ?>

<div id="search-container" class="col-md-12">
  <h1>Busque um Evento</h1>
  <form action="/" method="GET">
    <input type="text" id="search" name="search" class="form-control" placeholder="Procurar">
</br>
    <input type="submit" id="busca" class="btn btn-primary">
  </form>
</div>

<div id="events-container" class="cold-md-12">
  @if($search)
  <h2>Buscando por {{ $search }}</h2>
  @else
  <h2>Próximos Eventos</h2>
  <p class="subtitle">Veja os eventos dos próximos dias</p>
  @endif
  <div id="cards-container" class="row">

  @foreach($events as $event)
 <div class="card col-md-3">
    <img src="img/events/{{ $event->image }}" alt="{{ $event->title }}";>
      <div class="card body">
       <p class="card-date">{{ date('d/m/y', strtotime($event->date) ) }}</p> {{-- Converte a data estadunidense para BR --}}
       <h5 class="card-title">{{$event->title}}</h5>
       <p class="card-participantes"> {{count($event->users)}} participantes</p>
       <a href="/events/{{ $event->id }}" class="btn btn-primary">Saber mais</a>
   </div>
 </div>
@endforeach
@if(count($events) == 0 && $search)
<p>Não foi encontrado nenhum evento com {{ $search }}! <a href="/"> Ver Todos! </a></p>
@elseif(count($events) == 0)
<p>Não há eventos disponíveis</
@endif
  </div>
</div>

@endsection