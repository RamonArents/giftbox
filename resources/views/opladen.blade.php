@extends('layouts.app')
@section('content')
    <div class="flex-center position-ref full-height">
        <div class="row justify-content-center opladen-width">
            @include('messages.messages')
        </div>
        <!--check balance-->
        <div class="row justify-content-center opladen-width">
            <h2>Saldo checken</h2>
        </div>
        <form action="{{ action('UserPageController@getBalanceFromDB') }}" method="post">
            {{ csrf_field() }}
            <div class="form-check col-xl-3 mx-auto">
                <label for="cardNumber">Kaartnummer:</label><br>
                <input class="form-control" id="cardNumber" type="text" name="cardNumber" value="{{ old('card') }}" required/>
            </div>
            <br />
            <div class="form-group col-xl-3 mx-auto">
                <input class="doneer-buttons submit-to-checkout" type="submit" value="Check Saldo">
            </div>
        </form>
        <br />
        <!--add balance-->
        <div class="row justify-content-center opladen-width">
            <h2>Saldo opladen</h2>
        </div>
        <form action="{{ action('UserPageController@addBalance') }}" method="post">
            {{ csrf_field() }}
            <div class="form-group col-xl-3 mx-auto">
                <label for="card">Kaartnummer:</label><br>
                <input class="form-control" id="card" type="text" name="card" value="{{ old('card') }}" required/>
            </div>
            <div class="form-group col-xl-3 mx-auto">
                <label for="amount">Bedrag (max €20):</label><br>
                <input class="form-control" id="amount" type="number" name="amount" min="1" max="20" value="{{ old('amount') }}" required/>
            </div>
            {{--<div class="form-check col-xl-3 mx-auto">--}}
                {{--<label class="form-check-label" for="paymethod-ideal">Ideal--}}
                    {{--<input class="form-check-input" id="paymethod-ideal" type="radio" name="paymethod" value="ideal"/>--}}
                    {{--<span class="checkmark"></span>--}}
                {{--</label>--}}
            {{--</div>--}}
            {{--<div class="form-check col-xl-3 mx-auto">--}}
                {{--<label class="form-check-label" for="paymethod-paypal">Paypal--}}
                    {{--<input class="form-check-input" id="paymethod-paypal" type="radio" name="paymethod" value="paypal"/>--}}
                    {{--<span class="checkmark"></span>--}}
                {{--</label>--}}
            {{--</div>--}}
            <div class="form-check col-xl-3 mx-auto">
                <input class="doneer-buttons submit-to-checkout" type="submit" value="Opladen">
            </div>
        </form>
    </div>
@endsection