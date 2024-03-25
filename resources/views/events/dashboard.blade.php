@extends("layouts.main")

@section("title", "Dashboard")

@section("content")
<div class="col-md-10 offset-md-1 dashboard-title-container">
    <h1>Meus Eventos:</h1>
</div>
<div class="col-md-10 offset-md-1 dashboard-events-container">
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
                    <td scope="row">{{ $loop->index + 1 }}</td>
                    <td><a href="/events/{{$event->id}}">{{ucfirst($event->title)}}</a></td>
                    <td>0</td>
                        <td>
                            <a href="#"class="btn btn-info edit-btn"><ion-icon name="create-outline"></ion-icon> Editar </a>
                            <form action="/events/{{$event->id}}" method="POST">
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="btn btn-danger delete-btn"><ion-icon name="trash-outline"></ion-icon>Deletar</button>

                            </form>
                        </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>Você não possui eventos. <a href="/events/create">Criar evento</a></p>

    @endif

</div>






@endsection