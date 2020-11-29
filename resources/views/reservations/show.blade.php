@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="row">
            <div class="col">
                <div class="card-body">
                    <h2 class="text-center">{{ $route->name }}</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <img class="card-img-top" src="{{$route->photo}}" alt="">
                <ul class="list-group list-group-flush border border-light">
                    <li class="list-group-item">Ilgis: <strong>{{ $route->length }}</strong></li>
                    <li class="list-group-item">Sudėtingumas: <strong>{{ $route->difficulty }}</strong></li>
                </ul>
            </div>
            <div class="col">
                <p>{{ $route->description }}</p>
                <hr>
                <h2 class="text-center">Rezervacija: {{ $reservation->id }}</h2>
                <ul class="list-group list-group-flush border border-light">
                    <li class="list-group-item">Data nuo: <strong>{{ $reservation->data_from->toDateString() }}</strong>
                    </li>
                    <li class="list-group-item">Data iki: <strong>{{ $reservation->data_to->toDateString() }}</strong>
                    </li>
                    <li class="list-group-item">
                        <div class="row justify-content-center">
                            <h5 class="mb-3">Nuomuojama įranga</h5>
                        </div>
                        <div class="row">
                            <div class="col d-flex justify-content-center px-0">
                                <h6>Baidarės (50 LT/vnt.): <strong>{{ $items[0]->count }}</strong></h6>
                            </div>
                            <div class="col d-flex justify-content-center px-0">
                                <h6>Kanojos (40 LT/vnt.): <strong>{{ $items[1]->count }}</strong></h6>
                            </div>
                            <div class="col d-flex justify-content-center px-0">
                                <h6>Valtys (70 LT/vnt.): <strong>{{ $items[2]->count }}</strong></h6>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">Rezervacijos kaina:
                        <strong>{{ round($reservation->reservation_price, 2) }} LT</strong>
                    </li>
                    <li class="list-group-item">Rezervacijos mokestis:
                        <strong>{{ $reservation->reservation_fee }} LT</strong>
                    </li>
                    <li class="list-group-item">Nuolaida: <strong>{{ $reservation->discount }} %</strong></li>
                    <li class="list-group-item">Mokėtina suma:
                        <strong>{{ round($reservation->reservation_price + $reservation->reservation_fee - (($reservation->reservation_price + $reservation->reservation_fee) * ($reservation->discount / 100)), 2) }}
                            LT</strong>
                    </li>
                </ul>
                <div class="d-flex justify-content-center my-3">
                    @role('admin')
                    <a href='{{ url('rezervacijos/redaguoti/'.$reservation->id) }}'
                        class="btn btn-primary mr-4">Redaguoti</a>
                    <a href='{{ url('rezervacijos/salinti/'.$reservation->id) }}'
                        class="btn btn-danger mr-4">Šalinti</a>
                    @endrole

                    @if ($reservation->status == 'Vykdoma')
                    @role('client')
                    <a href='{{ url('rezervacijos/redaguoti/'.$reservation->id) }}'
                        class="btn btn-primary mr-4">Redaguoti</a>
                    <a href='{{ url('rezervacijos/salinti/'.$reservation->id) }}'
                        class="btn btn-danger mr-4">Šalinti</a>
                    @endrole
                    @endif
                    <a href='{{ route('rezervacijos') }}' class="btn btn-secondary mr-4">Atgal</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
