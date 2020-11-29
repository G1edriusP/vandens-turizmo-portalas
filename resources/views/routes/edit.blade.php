@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Maršruto"'.$route->name.'" redagavimas') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('marsrutas_redaguoti', ['route' => $route]) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="name"
                                class="col-md-4 col-form-label text-md-right">{{ __('Pavadinimas') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ $route->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="difficulty"
                                class="col-md-4 col-form-label text-md-right">{{ __('Sunkumas') }}</label>

                            <div class="col-md-6">
                                <select class="form-control" name="difficulty" id="difficulty">
                                    <option value="{{ $route->difficulty }}">{{ $route->difficulty }}</option>
                                    <option value="Lengvas">Lengvas</option>
                                    <option value="Vidutinis">Vidutinis</option>
                                    <option value="Sunkus">Sunkus</option>
                                </select>

                                @error('difficulty')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="length" class="col-md-4 col-form-label text-md-right">{{ __('Ilgis') }}</label>

                            <div class="col-md-6">
                                <input id="length" type="number"
                                    class="form-control @error('length') is-invalid @enderror" name="length"
                                    value="{{ $route->length }}" required autocomplete="length" autofocus>

                                @error('length')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description"
                                class="col-md-4 col-form-label text-md-right">{{ __('Aprašymas') }}</label>

                            <div class="col-md-6">
                                <input id="description" type="text"
                                    class="form-control @error('description') is-invalid @enderror" name="description"
                                    value="{{ $route->description }}" required autocomplete="description" autofocus>

                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="photo"
                                class="col-md-4 col-form-label text-md-right">{{ __('Nuotrauka') }}</label>

                            <div class="col-md-6">
                                <input id="photo" type="text" class="form-control @error('photo') is-invalid @enderror"
                                    name="photo" value="{{ $route->photo }}" required autocomplete="photo" autofocus>

                                @error('photo')
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
                                <a href='{{ url('marsrutai/'.$route->id) }}' class="btn btn-secondary mr-3">Atgal</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
