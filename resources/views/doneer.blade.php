@extends('layouts.app')
@section('content')
    <div class="flex-center position-ref full-height">
        <div class="row justify-content-center">
            @include('messages.messages')
        </div>
        <div class="text-center">
            <!--livestream by twitch-->
            <iframe
                    src="https://player.twitch.tv/?channel=giftbox_hsleiden"
                    frameborder="0"
                    allowfullscreen="true"
                    scrolling="no"></iframe>
                <form action="{{ action('UserPageController@useCode') }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group col-xl-3 mx-auto">
                        <label for="code">Verzilver code:</label><br>
                        <input class="form-control" id="code" type="text" name="code" value="{{ old('code') }}" required/>
                    </div>
                    <input class="doneer-buttons" type="submit" value="Laat lampje branden">
                </form>
                <p>Of:</p>
                <!--Buy ticket to use on website-->
                <a class="btn doneer-buttons buycode" href="{{ route('buycode') }}">Koop code</a>
        </div>
    </div>
@endsection
