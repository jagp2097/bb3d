@extends('layouts.app')
@section('content')

@if (session('coupon_status'))
<div class="container alert alert-danger" role="alert">
  {{ session('coupon_status') }}
</div>
@endif

<section id="clients">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 justify-content-center">
        <div class="text-center mt-5 mb-3" style="height:100vh;">
          
          <div class="section-header">
            <h3 style="font-size:3.6em;color:#1d99bf">Ingrese el código del cupón</h3>
          </div>
          
          <div class="text-center mt-2 mb-3">

            <form action="{{ route('coupon.verificar') }}" method="POST">
            @csrf
                <input style="font-size:2em" type="text" name="cupon_adelantado">

                <div class="text-center mt-3">
                  <button class="btn-sec" type="submit">Verificar</button>
                  <a href="{{ route('paquete.index') }}" class="btn-edit">Regresar</a>
                </div>

            </form>


          </div>
          
          
        </div>
      </div>
    </div>
  </div>
</section>

@endsection