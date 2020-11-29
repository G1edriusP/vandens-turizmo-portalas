@extends('layouts.app')

@section('content')
@role('admin')
<div class="container">
    <div class="d-flex justify-content-between">
        <div class="d-flex justify-content-start">
            <div class="btn-group">
                <a class="btn btn-success btn-sm mr-3" href="{{ route('vartotojai_sukurti') }}"
                    role="button">Sukurti</a>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        @foreach ($users as $user)
        <div class="col-4 my-3">
            <div class="card">
                <div class="card-body">
                    <h4 class="text-center">{{ $user->name.' '.$user->surname }}</h4>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">E-paštas: <strong>{{ $user->email }}</strong></li>
                    <li class="list-group-item">Rolė:
                        <strong>{{ $user->role_id == 1 ? 'Administratorius' : 'Vartotojas' }}</strong></li>
                    <li class="list-group-item">Atliktų rezervacijų kiekis:
                        <strong>{{ $user->reservations_number }}</strong></li>
                    <li class="list-group-item">Atliktų rezervacijų kaina:
                        <strong>{{ $user->reservations_cost }}</strong>
                    </li>
                </ul>
                <div class="card-body d-flex justify-content-around">
                    <a href='{{ url('vartotojai/redaguoti/'.$user->id) }}' class="btn btn-secondary">Redaguoti</a>
                    <a href='{{ url('vartotojai/salinti/'.$user->id) }}' class="btn btn-danger">Šalinti</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endrole
@endsection
