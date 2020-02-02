@extends('layouts.app')
@section('content')
    <!--edit a code-->
    <form action="{{ action('AdminController@editCode', ['id' => $code->id]) }}" method="post">
        {{ csrf_field() }}
        <div class="form-group col-xl-3 mx-auto">
            <label for="code">Code:</label><br>
            <input class="form-control" id="code" type="number" name="code" value="{{ $code->codeNumber }}" required/>
        </div>
        <div class="form-group col-xl-3 mx-auto">
            <label for="used">Gebruikt:</label>
            <select id="used" name="used" class="mdb-select md-form">
                <!--To check if the code is used, this lambda expression is used-->
                <option value="1" {{ $code->used == '1' ? 'selected' : '' }}>Gebruikt</option>
                <option value="0"{{ $code->used == '0' ? 'selected' : '' }}>Niet gebruikt</option>
            </select>
        </div>
        <div class="form-check col-xl-3 mx-auto">
            <input class="doneer-buttons submit-to-checkout" type="submit" value="Bewerk code">
        </div>
    </form>
@endsection