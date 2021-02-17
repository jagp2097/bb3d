@extends('layouts/app')
@section('content')
    
<section id="clients">
        <div class="container">
          <div class="row">
            
            <div class="col-lg-12 justify-content-center">
              <div class="section-header">
                
                <div class="row">
                  <div class="col-sm-6 col-md-6 col-lg-6">
                    <h4>Opiniones</h4>
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
                    <th class="text-center align-middle" scope="col"></th>
                    <th class="text-center align-middle" scope="col">Nombre del cliente</th>
                    <th class="text-center align-middle" scope="col">Email</th>
                    <th class="text-center align-middle" scope="col">Opinión</th>
                    <th class="text-center align-middle" scope="col">Fecha</th>
                    <th class="text-center align-middle" scope="col"></th>
                  </thead>
                  <tbody>
                    @foreach($opiniones as $opinion)
                    <tr>
                      {{-- <td class="text-center align-middle">{{ $opinion->id }}</td> --}}
                      <td class="text-center align-middle"></td>
                      <td class="text-center align-middle">{{ $opinion->nombre }}</td>
                      <td class="text-center align-middle">{{ $opinion->email }}</td>
                      <td class="text-center align-middle">{{ $opinion->opinion }}</td>
                      <td class="text-center align-middle">{{ $opinion->created_at->format('d-M-Y') }}</td>
                      <td class="text-center align-middle">
                        <form action="{{ route('opinion.destroy', $opinion->id) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn-del">Eliminar</button>
                        </form>
                      </td>
                      
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </section>
            
            <div class="float-right">
              {{ $opiniones->links() }}
            </div>
        </section>

@endsection