@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <!--add delete component for each code-->
            @foreach($codes as $code)
                @component('components.delete-code-component', ['id' => $code->id]) @endcomponent
            @endforeach
            @include('messages.messages')
            <div class="table-responsive-xl">
                <!--show table with codes-->
                <table class="table table-dark">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">code</th>
                        <th scope="col">gebruikt</th>
                        <th scope="col">datum</th>
                        <th scope="col">bewerken</th>
                        <th scope="col">verwijderen</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($codes as $code)
                        <tr>
                            <th scope="row">{{ $code->id }}</th>
                            <td>{{ $code->codeNumber }}</td>
                            <td>{{ $code->used }}</td>
                            <td>{{ $code->created_at }}</td>
                            <td><a href="{{ route('editCodeView', ['id' => $code->id]) }}" role="button"><span class="fas fa-pen"></span></a></td>
                            <td><span class="fa fa-fw fa-trash cursor-pointer" data-toggle="modal" data-target="#deleteCodeModal{{ $code->id }}"></span></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection