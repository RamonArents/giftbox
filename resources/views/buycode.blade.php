@extends('layouts.app')
@section('content')
    <form action="{{ action('UserPageController@pay') }}" method="post">
        {{ csrf_field() }}
        <div class="form-group buy-ticket">
            <label for="email">Email:</label><br>
            <input class="form-control" id="email" type="email" name="email" required/>
        </div>
        <div class="form-group buy-ticket">
            <label for="numberOfCodes">Aantal codes (iedere code kan eenmalig voor 1 kaarsje worden gebruikt):</label><br>
            <input class="form-control" id="numberOfCodes" type="number" name="numberOfCodes" min="1" max="5" step=".01" required/>
        </div>
        <div class="form-check buy-ticket">
            <input class="form-check-input" id="paymethod-ideal" type="radio" name="paymethod" value="ideal"/>
            <label class="form-check-label" for="paymethod-ideal">Ideal:</label>
        </div>
        <div class="form-check buy-ticket">
            <input class="form-check-input" id="paymethod-paypal" type="radio" name="paymethod" value="paypal"/>
            <label class="form-check-label" for="paymethod-paypal">Paypal:</label>
        </div>
        <input class="doneer-buttons" type="submit" name="payment" value="Koop code">
    </form>
@endsection