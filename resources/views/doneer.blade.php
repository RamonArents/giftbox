@extends('layouts.app')
@section('content')
    <div class="flex-center position-ref full-height">
        @include('messages.messages')
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
                <form action="{{ action('UserPageController@useCode') }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group buy-ticket">
                        <label for="code">Verzilver code:</label><br>
                        <input class="form-control" id="code" type="text" name="code" required/>
                    </div>
                    <input class="doneer-buttons" type="submit" value="Steek kaarsje aan.">
                </form>
                <br>
                <br>
                <!--Buy ticket to use on website-->
                <a class="btn doneer-buttons" href="{{ route('buycode') }}">Koop code</a>
            </div>

        </div>
    </div>
@endsection
