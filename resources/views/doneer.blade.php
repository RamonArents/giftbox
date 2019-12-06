@extends('layouts.app')
@section('content')
    <div class="flex-center position-ref full-height">

        <div class="text-center">
            <!--livestream by twitch-->
            <iframe
                    src="https://player.twitch.tv/?channel=giftbox_hsleiden"
                    frameborder="0"
                    allowfullscreen="true"
                    scrolling="no"
                    height="378"
                    width="620"></iframe>
            <div class="doneer-button">
                <!--create the payment method later before going to the server page (to put the LED on)-->
                <button class="doneer-buttons" type="button" onclick=sendRequestToRaspberry()>Steek kaarsje aan. (verzilveren)</button>
                <br>
                <br>
                <!--Buy ticket to use on website-->
                <form action="{{ action('UserPageController@pay') }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group buy-ticket">
                        <label for="email">Email:</label><br>
                        <input class="form-control" id="email" type="email" name="email" required/>
                    </div>
                    <input class="doneer-buttons" type="submit" name="payment" value="Koop code">
                </form>
            </div>

        </div>
    </div>
@endsection
