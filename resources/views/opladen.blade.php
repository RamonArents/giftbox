@extends('layouts.app')
@section('content')
    <form action="{{ action('UserPageController@pay') }}" method="post">
        {{ csrf_field() }}
        <div class="form-group col-xl-3 mx-auto">
            <label for="card">Kaartnummer:</label><br>
            <div class="check-saldo">
                <input class="form-control" id="card" type="text" name="card" value="{{ old('card') }}" required/>
                <p id="getSaldo"></p>
                <button class="doneer-buttons submit-to-checkout" type="button">Check saldo</button>
            </div>
        </div>
        <div class="form-check col-xl-3 mx-auto">
            <input class="doneer-buttons submit-to-checkout" type="submit" value="Opladen">
        </div>
    </form>
@endsection