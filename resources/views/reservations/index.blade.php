@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @foreach ($reservations as $reservation)
        <div class="col-4 my-3">
            <div class="card">
                <img class="card-img-top" src="{{ $routes[$reservation->route_id-1]->photo }}" alt="">
                <div class="card-body">
                    <h4 class="text-center">{{ $routes[$reservation->route_id-1]->name }}</h4>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Rezervacijos numeris: <strong>{{ $reservation->id }}</strong></li>
                    <li class="list-group-item">Data nuo:
                        <strong>{{ Carbon\Carbon::parse($reservation->data_from)->format('Y-m-d') }}</strong>
                    </li>
                    <li class="list-group-item">Data iki:
                        <strong>{{ Carbon\Carbon::parse($reservation->data_to)->format('Y-m-d') }}</strong>
                    </li>
                </ul>
                <div class="card-body d-flex justify-content-around">
                    <a href='{{ url('rezervacijos/'.$reservation->id) }}' class="btn btn-dark">Peržiūrėti</a>
                    {{-- <a href='{{ url('marsrutai/'.$route->id) }}' class="btn btn-secondary">Redaguoti</a> --}}
                    {{-- @role('admin')
                    <a href='{{ url('marsrutai/salinti/'.$route->id) }}' class="btn btn-danger">Šalinti</a>
                    @endrole --}}
                </div>
            </div>
        </div>
        @endforeach


    </div>
</div>
@endsection
