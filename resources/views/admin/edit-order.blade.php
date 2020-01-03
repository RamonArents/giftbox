@extends('layouts.app')
@section('content')
    <form action="{{ action('AdminController@editOrder', ['id' => $order->id]) }}" method="post">
        {{ csrf_field() }}
        <div class="form-group col-xl-3 mx-auto">
            <label for="email">Email:</label><br>
            <input class="form-control" id="email" type="email" name="email" value="{{ $order->email }}" required/>
        </div>
        <div class="form-group col-xl-3 mx-auto">
            <label for="orderNumber">Ordernummer:</label><br>
            <input class="form-control" id="orderNumber" type="text" name="orderNumber" value="{{ $order->orderNumber }}" required/>
        </div>
        <div class="form-group col-xl-3 mx-auto">
            <label for="paymentStatus">Betaal status:</label>
            <select id="paymentStatus" name="paymentStatus" class="mdb-select md-form">
                <option value="paid" {{ $order->paymentStatus == 'paid' ? 'selected' : '' }}>paid</option>
                <option value="open"{{ $order->paymentStatus == 'open' ? 'selected' : '' }}>open</option>
                <option value="pending"{{ $order->paymentStatus == 'pending' ? 'selected' : '' }}>pending</option>
                <option value="failed"{{ $order->paymentStatus == 'failed' ? 'selected' : '' }}>failed</option>
                <option value="expired"{{ $order->paymentStatus == 'expired' ? 'selected' : '' }}>expired</option>
                <option value="refused"{{ $order->paymentStatus == 'refused' ? 'selected' : '' }}>refused</option>
            </select>
        </div>
        <div class="form-check col-xl-3 mx-auto">
            <input class="doneer-buttons submit-to-checkout" type="submit" value="Bewerk order">
        </div>
    </form>
@endsection