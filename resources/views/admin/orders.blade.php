@extends('layouts.app')
@section('content')
    <div class="container">
        @include('messages.messages')
        <div class="row justify-content-center">
            @foreach($orders as $order)
                @component('components.delete-order-component', ['id' => $order->id]) @endcomponent
            @endforeach
                <div class="table-responsive-xl">
                <table class="table table-dark">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">payment_id</th>
                        <th scope="col">email</th>
                        <th scope="col">ordernummer</th>
                        <th scope="col">aantal codes</th>
                        <th scope="col">payment status</th>
                        <th scope="col">datum</th>
                        <th scope="col">bewerken</th>
                        <th scope="col">verwijderen</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <th scope="row">{{ $order->id }}</th>
                        <td>{{ $order->payment_id }}</td>
                        <td>{{ $order->email }}</td>
                        <td>{{ $order->orderNumber }}</td>
                        <td>{{ $order->numberOfCodes }}</td>
                        <td>{{ $order->paymentStatus }}</td>
                        <td>{{ $order->created_at }}</td>
                        <td><a href="#" role="button"><span class="fas fa-pen"></span></a></td>
                        <td><a href="#" role="button"><span class="fa fa-fw fa-trash cursor-pointer" data-toggle="modal" data-target="#deleteOrderModal"></span></a></td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                </div>
            </div>
    </div>
@endsection