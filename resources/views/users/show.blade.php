@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="row">
            <div class="col">
                <div class="card-body">
                    <h2 class="text-center">{{ $user->name.' '.$user->surname }}</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <ul class="list-group list-group-flush border border-light">
                    <li class="list-group-item">E-pašto adresas: <strong>{{ $user->email }}</strong></li>
                    <li class="list-group-item">Rolė:
                        <strong>{{ $user->role_id == 'Administratorius' ? 'Administratorius' : 'Vartotojas' }}</strong>
                    </li>
                    <li class="list-group-item">Atliktų rezervacijų kiekis:
                        <strong>{{ $user->reservations_number }}</strong></li>
                    <li class="list-group-item">Atliktų rezervacijų kaina:
                        <strong>{{ $user->reservations_cost }}</strong></li>
                    <li class="list-group-item">Vartotojo sukūrimo data: <strong>{{ $user->created_at }}</strong></li>
                </ul>
                <div class="row d-flex justify-content-end my-3 mx-3">
                    <a href='{{ url('vartotojai/redaguoti/'.$user->id) }}' class="btn btn-primary mr-3">Redaguoti</a>
                    <a href='{{ url()->previous() }}' class="btn btn-secondary mr-3">Atgal</a>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
