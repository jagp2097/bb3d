@extends('layouts/app')
@section('content')
@section('scripts')
<script src="{{ asset('js/elementos_w3css.js') }}"></script>
@endsection


<section id="clients" class="payment-step my-5">

  <div class="section-header">
    <h4 class="ml-5">Opinión</h4>
  </div>
  


  <div class="row justify-content-center mt-5 mb-4">
    <div class="col-md-12 text-center">
      <p class="payment-step-paragraph">Sentimos que te vayas. ¿Podrías darnos una opinión acerca de tu experiencia en este sitio? Nos serviría de mucho
          para ofrecer un mejor servicio a nuestros clientes. (Opcional)</p>
    </div>
  </div>

  <div class="row justify-content-center my-5 mx-5">
    <div class="col-md-12 text-center">
      <form action="{{ route('opinion.store') }}" method="POST">
        @csrf
        <textarea class="form-control" name="opinion" rows="4"></textarea> <br>
        <button class="btn-del" type="submit">Eliminar cuenta</button>
      </form>
    </div>
  </div>

</section>
   
@endsection