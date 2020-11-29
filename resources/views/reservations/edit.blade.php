@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Rezervacijos "'.$reservation->id).'" redagavimas' }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('rezervacija_redaguoti', ['reservation' => $reservation, 'items' => $items, 'user' => $user]) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="data_from"
                                class="col-md-4 col-form-label text-md-right">{{ __('Data nuo') }}</label>

                            <div class="col-md-4">
                                <input id="data_from" type="date"
                                    class="form-control @error('data_from') is-invalid @enderror" name="data_from"
                                    value="{{ $reservation->data_from->toDateString() }}" required autocomplete="name"
                                    autofocus>

                                @error('data_from')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="data_to"
                                class="col-md-4 col-form-label text-md-right">{{ __('Data iki') }}</label>

                            <div class="col-md-4">
                                <input id="data_to" type="date"
                                    class="form-control @error('data_to') is-invalid @enderror" name="data_to"
                                    value="{{ $reservation->data_to->toDateString() }}" required autocomplete="surname"
                                    autofocus>

                                @error('data_to')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="baidare"
                                class="col-md-4 col-form-label text-md-right">{{ __('Baidarės ( 50 LT / vnt. )') }}</label>
                            <div class="col-md-4">
                                <input id="baidare" type="number"
                                    class="form-control @error('baidare') is-invalid @enderror" name="baidare"
                                    value={{$items[0]->count}} required autofocus min="0">

                                @error('baidare')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="kanoja"
                                class="col-md-4 col-form-label text-md-right">{{ __('Kanojos ( 40 LT / vnt. )') }}</label>
                            <div class="col-md-4">
                                <input id="kanoja" type="number"
                                    class="form-control @error('kanoja') is-invalid @enderror" name="kanoja"
                                    value={{$items[1]->count}} required autofocus min="0">

                                @error('kanoja')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="valtis"
                                class="col-md-4 col-form-label text-md-right">{{ __('Valtys ( 70 LT / vnt. )') }}</label>
                            <div class="col-md-4">
                                <input id="valtis" type="number"
                                    class="form-control @error('valtis') is-invalid @enderror" name="valtis"
                                    value={{$items[2]->count}} required autofocus min="0">
                                @error('valtis')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <p class="col-md-4 col-form-label text-md-right">{{ __('Užsakymo suma') }}</p>
                            <div class="col-md-4">
                                <h5 class="form-control" id="reservation_price">{{ $reservation->reservation_price }} LT
                                </h5>
                            </div>
                        </div>

                        <div class="form-group row">
                            <p class="col-md-4 col-form-label text-md-right">{{ __('Rezervavimo mokestis') }}</p>
                            <div class="col-md-4">
                                <h5 class="form-control" id="fee">{{ $reservation->reservation_fee }} LT</h5>
                            </div>
                        </div>

                        <div class="form-group row">
                            <p class="col-md-4 col-form-label text-md-right">{{ __('Užsakymo nuolaida') }}</p>
                            <div class="col-md-4">
                                <h5 class="form-control" id="discount">{{ $reservation->discount }} %</h5>
                            </div>
                        </div>

                        <div class="form-group row">
                            <p class="col-md-4 col-form-label text-md-right">{{ __('Mokėtina suma') }}</p>
                            <div class="col-md-4">
                                <h5 class="form-control" id="price">
                                    {{ round($reservation->reservation_price + $reservation->reservation_fee - (($reservation->reservation_price + $reservation->reservation_fee) * ($reservation->discount / 100)), 2) }}
                                    LT</h5>
                            </div>
                        </div>

                        @role('client')
                        <select hidden class="form-control" name="status" id="status">
                            <option value={{ "Vykdoma" }} selected>Vykdoma</option>
                        </select>
                        @endrole

                        @role('admin')
                        <div class="form-group row">
                            <label for="status"
                                class="col-md-4 col-form-label text-md-right">{{ __('Būsena') }}</label>

                            <div class="col-md-4">
                                <select class="form-control" name="status" id="status">
                                    <option value={{ "Vykdoma" }} selected>Vykdoma</option>
                                    <option value={{ "Patvirtinta" }}>Patvirtinta</option>
                                    <option value={{ "Baigta" }}>Baigta</option>
                                </select>

                                @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        @endrole

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-success">
                                    {{ __('Išsaugoti') }}
                                </button>
                                <a href='{{ url('rezervacijos/'.$reservation->id) }}' class="btn btn-secondary mr-3">Atgal</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('input').on('change', function () {
            var kiekis_baidares = $('#baidare').val();
            var kiekis_kanojos = $('#kanoja').val();
            var kiekis_valtys = $('#valtis').val();

            var suma = (kiekis_kanojos) * 40 +
                (kiekis_baidares) * 50 +
                (kiekis_valtys) * 70;

            var nuolaida_kaina = 0;
            var nuolaida_proc = 0;
            var nuolaida_papildoma = 0;
            var moketina_suma = 0;

            if (suma >= 200 && suma < 250) {
                nuolaida_proc = 3;
            } else if (suma >= 250 && suma < 400) {
                nuolaida_proc = 5;
            } else if (suma >= 400) {
                nuolaida_proc = 10;
            }
            
            rezervaciju_kiekis = {{ $user->reservations_number }};
            rezervaciju_kaina = {{ $user->reservations_cost }};

            if (rezervaciju_kaina > 1000) {
                nuolaida_papildoma = 3;
            } else if (rezervaciju_kaina > 2000) {
                nuolaida_papildoma = 5;
            } else if (rezervaciju_kaina > 3000) {
                nuolaida_papildoma = 10;
            }

            nuolaida_kaina = suma * ((nuolaida_proc + nuolaida_papildoma) / 100);
            mokestis = {{ $user->reservations_number < 10 ? 12.99 : 0 }};
            moketina_suma = suma - nuolaida_kaina + mokestis;

            $('#reservation_price').text(suma.toFixed(2) + ' LT');
            $('#discount').text(nuolaida_papildoma + '% + ' + nuolaida_proc + '% -> ' + nuolaida_kaina.toFixed(2) + ' LT');
            $('#fee').text(mokestis.toFixed(2) + ' LT');
            $('#price').text(moketina_suma.toFixed(2) + ' LT');
            
        })
    });

</script>
@endsection
