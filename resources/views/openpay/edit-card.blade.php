@extends('layouts.app')
@section('content')

    @section('scripts')
        <script type="text/javascript" src="https://openpay.s3.amazonaws.com/openpay.v1.min.js"></script>
        <script type='text/javascript' src="https://openpay.s3.amazonaws.com/openpay-data.v1.min.js"></script>

        <script>
            $(document).ready(function(){
                // OpenPay.setId('mpqoljlvexjbgev0xwyp');
                // OpenPay.setApiKey('pk_2f5b2ebacb4943ff9f9296baf55ba4e5');
                // OpenPay.setSandboxMode(true); // cambiar a true cuando este en produccion
                //
                // $('#updateCardBtn').on('click', function (event) {
                //     event.preventDefault();
                //     $("#updateCardBtn").prop( "disabled", true);
                //     OpenPay.token.extractFormAndCreate('update-card-form', success_callbak, error_callbak);
                // });
                //
                // var success_callbak = function(response) {
                //     var token_id = response.data.id;
                //     $('#token_id').val(token_id);
                //     console.log(token_id);
                //     $('#update-card-form').submit();
                //
                // };
                //
                // var error_callbak = function(response) {
                //     var desc = response.data.description != undefined ? response.data.description : response.message;
                //     alert("ERROR [" + response.status + "] " + desc);
                //     $("#updateCardBtn").prop("disabled", false);
                // };
                //
                // OpenPay.card.update(UPDATE_CARD_OBJECT, SUCCESS_CALLBACK, ERROR_CALLBACK, {CLIENTE-ID}, CARD_ID);

            });
        </script>
    @endsection

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-2">
                <div class="card">
                    <div class="card-header">
                        <h4>Editar tarjeta</h4>
                    </div>
                    <div class="card-body">

                        <form id="update-card-form" class="" action="{{ route('openpay.updateCard', $card->id) }}" method="post">
                            {{ csrf_field() }}
                            @method('PUT')
                            <input type="hidden" name="token_id" id="token_id">
                            <div class="form-group">
                                <label for="holder_name" class="col-md-4 control-label">Nombre del titular *</label>
                                <div class="col-md-9">
                                    <input class="form-control" type="text" name="holder_name" data-openpay-card="holder_name" value="{{ $card->serializableData['holder_name'] }}">
                                </div>
                            </div>

                            <h5>Fecha de expiración</h5>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="expiration_month" class="control-label">Mes de expiración *</label>
                                        <input class="form-control" type="text" name="expiration_month" data-openpay-card="expiration_month" value="{{ $card->serializableData['expiration_month'] }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="expiration_year" class="control-label">Año de expiración *</label>
                                        <input class="form-control" type="text" name="expiration_year" data-openpay-card="expiration_year" value="{{ $card->serializableData['expiration_year'] }}">
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer text-right">
                                <a href="{{ route('openpay.getCards') }}" class="btn btn-secondary btn-sm">Regresar</a>
                                <button class="btn btn-primary btn-sm" type="submit">Crear tarjeta</button>
                                {{-- <a id="updateCardBtn" class="btn btn-primary btn-sm" role="button">Crear tarjeta</a> --}}
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
