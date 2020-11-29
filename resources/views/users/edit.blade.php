@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Vartotojo "'.$user->name.' '.$user->surname.'" redagavimas') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('vartotojas_redaguoti', ['user' => $user]) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Vardas') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="surname"
                                class="col-md-4 col-form-label text-md-right">{{ __('Pavardė') }}</label>

                            <div class="col-md-6">
                                <input id="surname" type="text"
                                    class="form-control @error('surname') is-invalid @enderror" name="surname"
                                    value="{{ $user->surname }}" required autocomplete="surname" autofocus>

                                @error('surname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email"
                                class="col-md-4 col-form-label text-md-right">{{ __('E-paštas') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ $user->email}}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password"
                                class="col-md-4 col-form-label text-md-right">{{ __('Slaptažodis') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    autocomplete="password" autofocus>

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        @role('admin')
                        <div class="form-group row">
                            <label for="role_id" class="col-md-4 col-form-label text-md-right">{{ __('Rolė') }}</label>

                            <div class="col-md-6">
                                <select class="form-control" name="role_id" id="role_id">
                                    <option value={{ $user->role_id }} selected disabled hidden>
                                        {{$user->role_id == 1 ? 'Administratorius' : 'Vartotojas'}}</option>
                                    <option value={{1}}>Administratorius</option>
                                    <option value={{2}}>Vartotojas</option>
                                </select>

                                @error('role_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        @endrole

                        <div class="form-group row">
                            <label for="reservations_number"
                                class="col-md-4 col-form-label text-md-right">{{ __('Atliktų rezervacijų kiekis') }}</label>

                            <div class="col-md-6">
                                <input id="reservations_number" type="number"
                                    class="form-control @error('reservations_number') is-invalid @enderror"
                                    name="reservations_number" value="{{ $user->reservations_number }}" required
                                    autocomplete="reservations_number" autofocus>

                                @error('reservations_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="reservations_cost"
                                class="col-md-4 col-form-label text-md-right">{{ __('Atliktų rezervacijų kaina') }}</label>

                            <div class="col-md-6">
                                <input id="reservations_cost" type="number" step="0.01"
                                    class="form-control @error('reservations_cost') is-invalid @enderror"
                                    name="reservations_cost" value="{{ $user->reservations_cost }}" required
                                    autocomplete="reservations_cost" autofocus>

                                @error('reservations_cost')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Išsaugoti') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
