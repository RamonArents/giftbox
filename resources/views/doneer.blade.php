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
                <button type="button" onclick=sendRequestToRaspberry()>Steek kaarsje aan.</button>
            </div>

        </div>
    </div>
@endsection
