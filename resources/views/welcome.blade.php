@extends('layouts.app')
<!--style only for landing page-->
<style>
    body{
        overflow: hidden;
    }
</style>
@section('content')
    <!--This is the background image-->
    <div class="background">
        <img class="background-image" src="{{URL('/images/background.jpg')}}" alt="background image" />
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
            <div class="text-center homepageview">
                <p>Op deze website kunt u een kaarsje opsteken voor uw dierbare. Door een donatie te doen aan de kerk krijgt u een code. Met deze code kunt u uw kaarsje live zien gaan branden.</p>
                <a href="{{ route('donatiepage') }}" class="btn homepage-button">Doneer</a>
            </div>
        </div>
        </div>
    </div>
@endsection
