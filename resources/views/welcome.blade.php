@extends('layouts.main')
@section("title",'Renato Wernik')
@section("content")


<div id="search-container" class="col-md-12">
    <h1>Busque um evento</h1>
    <form action="/"method="GET">
        <input type="text" id="search" name="search" class="form-control" placeholder="Procurar...">
    </form>
</div>
<div id="events-container" class="col-md-12">
    @if($search)
    <h2>Buscando por: {{$search}}</h2>
    @else
    <h2>Próximos eventos</h2>
    <p class="subtitle">Veja os eventos dos próximos dias</p>
    @endif
    <div id="cards-container" class="row">
        @foreach($events as $event)
        <div class="card col-md-3">
            <img src="/img/events/{{ $event->image}} " alt="{{ $event->title }}">
            <div class="card-body">
                <p class="card-date">{{ date("d/m/Y", strtotime( $event->date ))}}</p>
                <h5 class="card-title">{{ $event->title }}</h5>
                <p class="card-participantes">{{count($event->users)}} participantes</p>
                <a href="/events/{{$event->id}}" class="btn btn-primary">Saber mais</a>
                <form action="{{ route('events.destroy', $event->id) }}" method="POST" style="display: inline;">
                @csrf
                {{--@method('DELETE')
                <button type="submit" class="btn btn-danger">Remover Evento</button> --}}
            </form>
            </div>
        </div>
        @endforeach
        @if(count($events) == 0 && $search)
            <p>Não foi possivel encontrar nenhum evento com {{ $search }}! <a href="/">Ver todos eventos disponíveis</a></p>
        @elseif(count($events)== 0)
            <p>Não há eventos disponiveis</p>

        @endif
    </div>
</div>
    
    <!-- comentario html(aparece no console) -->
    {{-- comentario com blade (nao aparece no console) --}}

@endsection