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
                <div class="d-flex justify-content-end">
                    @role('client')
                    <a href='{{ url('rezervuoti/'.$route->id) }}' class="btn btn-dark mr-3">Rezervuoti</a>
                    @endrole
                    @role('admin')
                    <a href='{{ url('rezervuoti/'.$route->id) }}' class="btn btn-dark mr-3">Rezervuoti</a>
                    <a href='{{ url('marsrutai/redaguoti/'.$route->id) }}' class="btn btn-primary mr-3">Redaguoti</a>
                    <a href='{{ url('marsrutai/salinti/'.$route->id) }}' class="btn btn-danger mr-3">Šalinti</a>
                    @endrole
                    <a href='{{ route('marsrutai') }}' class="btn btn-secondary mr-3">Atgal</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
