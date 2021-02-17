@extends('layouts.app')
@section('content')
    Admin index

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <a href="{{ route('users.index') }}">Ver usuarios</a>
            </div>
            <div class="col-md-6">
                <a href="{{ route('venta.index') }}">Ver ventas</a>
            </div>
        </div>

    </div>


@endsection
