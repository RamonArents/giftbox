@extends('layouts.app')

@section('content')
    <!--This is the background image (possible to change dynamically in admin later, only homepage)-->
    <div class="background">
        <img class="background-image" src="{{URL('/images/background.jpg')}}" alt="background image" />
    </div>
        <div class="flex-center position-ref full-height">

            <div class="content">
                <div class="homepage-button">
                    <a href="{{ route('donatiepage') }}" class="btn">Doneer</a>
                </div>

            </div>
        </div>
@endsection
