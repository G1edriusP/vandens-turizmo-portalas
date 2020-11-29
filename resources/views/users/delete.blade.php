@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Ar tikrai norite pašalinti vartotoją "'.$user->name.' '.$user->surname.'"?' ) }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('vartotojai/salinti', ['user' => $user]) }}">
                        @csrf
                        @method('DELETE')

                        <div class="d-flex justify-content-center">
                            <div class="form-group row mb-0">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-danger mr-5">
                                        {{ __('Šalinti') }}
                                    </button>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6">
                                    <a href={{ route('vartotojai') }} class="btn btn-dark" role="button">
                                        {{ __('Atgal') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
