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
                <p>Op deze website kunt u een donatie doen. Door een code te kopen doet u een donatie. Als u deze op de website verzilverd zal er een lampje gaan branden als dank.</p>
                <a href="{{ route('donatiepage') }}" class="btn homepage-button">Doneer</a>
            </div>
        </div>
        </div>
    </div>
@endsection
