@extends('layouts.app')
@section('content')
    <form action="{{ action('UserPageController@pay') }}" method="post">
        {{ csrf_field() }}
        <div class="form-group col-xl-3 mx-auto">
            <label for="email">Email:</label><br>
            <input class="form-control" id="email" type="email" name="email" value="{{ old('email') }}" required/>
        </div>
        <div class="form-group col-xl-3 mx-auto">
            <label for="numberOfCodes">Aantal codes (iedere code kan eenmalig voor 1 lampje worden gebruikt):</label><br>
            <input class="form-control" id="numberOfCodes" type="number" name="numberOfCodes" min="1" max="5" value="{{ old('numberOfCodes') }}" required/>
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
            <input class="doneer-buttons submit-to-checkout" type="submit" value="Koop code">
        </div>
    </form>
@endsection