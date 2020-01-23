@extends('layouts.app')
@section('content')
    <form action="{{ action('AdminController@editCard', ['id' => $card->id]) }}" method="post">
        {{ csrf_field() }}
        <div class="form-group col-xl-3 mx-auto">
            <label for="card">Kaartnummer:</label><br>
            <input class="form-control" id="card" type="text" name="card" value="{{ $card->cardNumber }}" required/>
        </div>
        <div class="form-group col-xl-3 mx-auto">
            <label for="balance">Saldo:</label>
            <input class="form-control" id="balance" type="number" name="balance" value="{{ $card->balance }}" required/>
        </div>
        <div class="form-check col-xl-3 mx-auto">
            <input class="doneer-buttons submit-to-checkout" type="submit" value="Bewerk kaart">
        </div>
    </form>
@endsection