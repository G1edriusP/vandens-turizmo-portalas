@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between">
        @role('admin')
        <div class="d-flex justify-content-start">
            <div class="btn-group">
                <a class="btn btn-success btn-sm mr-3" href="{{ route('marsrutai_sukurti') }}" role="button">Sukurti</a>
            </div>
        </div>
        @endrole
        <div class="d-flex justify-content-end">
            <div class="btn-group">
                <button class="btn btn-secondary btn-sm dropdown-toggle mr-3" type="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Sudėtingumas
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href={{ request()->fullUrlWithQuery(['diff' => '']) }}>-</a>
                    <a class="dropdown-item" href={{ request()->fullUrlWithQuery(['diff' => 'Lengvas']) }}>Lengvas</a>
                    <a class="dropdown-item"
                        href={{ request()->fullUrlWithQuery(['diff' => 'Vidutinis']) }}>Vidutinis</a>
                    <a class="dropdown-item" href={{ request()->fullUrlWithQuery(['diff' => 'Sunkus']) }}>Sunkus</a>
                </div>
            </div>
            <div class="btn-group">
                <button class="btn btn-secondary btn-sm dropdown-toggle mr-3" type="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Ilgis
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href={{ request()->fullUrlWithQuery(['len' => '']) }}>-</a>
                    @foreach ($lengths as $item)
                    <a class="dropdown-item"
                        href={{ request()->fullUrlWithQuery(['len' => $item->length]) }}>{{ $item->length }}</a>
                    @endforeach
                </div>
            </div>
            <div class="btn-group">
                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Rikiavimas
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href={{ request()->fullUrlWithQuery(['sor' => 'asc']) }}>Didėjimo
                        tvarka</a>
                    <a class="dropdown-item" href={{ request()->fullUrlWithQuery(['sor' => 'desc']) }}>Mažėjimo
                        tvarka</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        @foreach ($routes as $route)
        <div class="col-4 my-3">
            <div class="card">
                <img class="card-img-top" src="{{$route->photo}}" alt="">
                <div class="card-body">
                    <h4 class="text-center">{{ $route->name }}</h4>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Ilgis: <strong>{{ $route->length }}</strong></li>
                    <li class="list-group-item">Sudėtingumas: <strong>{{ $route->difficulty }}</strong></li>
                </ul>
                <div class="card-body d-flex justify-content-around">
                    @role('admin')
                    <a href='{{ url('rezervuoti/'.$route->id) }}' class="btn btn-dark">Rezervuoti</a>
                    @endrole
                    @role('client')
                    <a href='{{ url('rezervuoti/'.$route->id) }}' class="btn btn-dark">Rezervuoti</a>
                    @endrole
                    <a href='{{ url('marsrutai/'.$route->id) }}' class="btn btn-secondary">Peržiūrėti</a>
                    @role('admin')
                    <a href='{{ url('marsrutai/salinti/'.$route->id) }}' class="btn btn-danger">Šalinti</a>
                    @endrole
                </div>
            </div>
        </div>
        @endforeach


    </div>
</div>
@endsection
