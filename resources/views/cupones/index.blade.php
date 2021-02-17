@extends('layouts.app')
@section('content')

<section id="clients">
    <div class="container">
        <div class="row">
            
            <div class="col-lg-12 justify-content-center">
                <div class="section-header">
                    
                    <div class="row">
                        <div class="col-sm-6 col-md-6 col-lg-6">
                            <h4>Cupones</h4>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6 text-right">
                            <div class="row">
                                <div class="col-lg-12 justify-content-center">
                                    <a href="{!! route('perfil.show') !!}" class="btn-sec">Perfil</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        
        <section id="content">
            <div class="table-responsive">
                <table class="table table-bb">
                    <thead class="text-center">
                        <th class="text-center align-middle" scope="col">Cupón id</th>
                        <th class="text-center align-middle" scope="col">Código</th>
                        <th class="text-center align-middle" scope="col">Tipo cupón</th>
                        <th class="text-center align-middle" scope="col">Cantidad</th>
                        <th class="text-center align-middle" scope="col">Usado</th>
                        <th class="text-center align-middle" scope="col">Creado</th>
                        <th class="text-center align-middle" scope="col">Vencimiento</th>
                        <th class="text-center align-middle" scope="col"></th>
                        <th class="text-center align-middle" scope="col"></th>
                    </thead>
                    <tbody>
                        @foreach ($cupones as $cupon)
                        <tr>
                            <td class="align-middle text-center">{{ $cupon->id }}</td>
                            <td class="align-middle text-center">{{ $cupon->codigo }}</td>
                            <td class="align-middle text-center">{{ $cupon->tipo_cupon }}</td>
                            <td class="align-middle text-center">
                                {{ $cupon->tipo_cupon == 'descuento_porcentaje' ? $cupon->porcentaje_descuento.'%' : '$'.$cupon->valor_descuento }}
                            </td>
                            <td class="align-middle text-center">{{ $cupon->usado }}</td>
                            <td class="align-middle text-center">{{ $cupon->fecha_inicio }}</td>
                            <td class="align-middle text-center">{{ $cupon->fecha_fin }}</td>
                            <td class="align-middle text-center">
                                <a href="{{ route('coupon.edit', $cupon->id) }}" class="btn-edit">Editar cupón</a>
                            </td>
                            <td class="align-middle text-center">
                                <form action="{{ route('coupon.destroy', $cupon->id) }}" method="POST">
                                    @method('DELETE')
                                    <button type="submit" class="btn-del">Eliminar cupón</button>
                                    @csrf
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </div>
    <div class="float-right mt-3">
        <a href="{{ route('coupon.create') }}" class="btn-back">Crear cupón</a>
    </div>
</section>


@endsection