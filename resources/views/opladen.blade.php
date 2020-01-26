@extends('layouts.app')
@section('content')
    <div class="flex-center position-ref full-height">
        <div class="row justify-content-center opladen-width">
            @include('messages.messages')
        </div>
        <form action="{{ action('UserPageController@getBalanceFromDB') }}" method="post">
            {{ csrf_field() }}
            <div class="form-check col-xl-3 mx-auto">
                <input id="cardNumber" type="hidden" name="cardNumber" value="{{ old('cardNumber') }}">
                <input class="doneer-buttons submit-to-checkout" type="submit" value="Check Saldo">
            </div>
        </form>
        <br />
        <form action="{{ action('UserPageController@addBalance') }}" method="post">
            {{ csrf_field() }}
            <div class="form-group col-xl-3 mx-auto">
                <label for="card">Kaartnummer:</label><br>
                <input class="form-control" id="card" type="text" name="card" onkeyup="getValueFromCard()" value="{{ old('card') }}" autocomplete="off" required/>
            </div>
            <div class="form-check col-xl-3 mx-auto">
                <input class="doneer-buttons submit-to-checkout" type="submit" value="Opladen">
            </div>
        </form>
    </div>
@endsection