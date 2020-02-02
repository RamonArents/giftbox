@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <!--add delete component for each card-->
            @foreach($cards as $card)
                @component('components.delete-card-component', ['id' => $card->id]) @endcomponent
            @endforeach
            @include('messages.messages')
            <div class="table-responsive-xl">
                <!--show table with cards-->
                <table class="table table-dark">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">kaartnummer</th>
                        <th scope="col">saldo</th>
                        <th scope="col">datum</th>
                        <th scope="col">bewerken</th>
                        <th scope="col">verwijderen</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cards as $card)
                        <tr>
                            <th scope="row">{{ $card->id }}</th>
                            <td>{{ $card->cardNumber }}</td>
                            <td>{{ $card->balance }}</td>
                            <td>{{ $card->created_at }}</td>
                            <td><a href="{{ route('editCardView', ['id' => $card->id]) }}" role="button"><span class="fas fa-pen"></span></a></td>
                            <td><span class="fa fa-fw fa-trash cursor-pointer" data-toggle="modal" data-target="#deleteCardModal{{ $card->id }}"></span></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection