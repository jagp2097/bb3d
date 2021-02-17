@extends('layouts.app')
@section('content')

  <div class="container">
    <div class="row">
      <div class="col-md-10 col-md-offset-2">
        <div class="card">
          <div class="card-header"> <h4>Agregar usuario</h4> </div>
          Password = a1b2c3 /** Recordar que cambie **/
          <div class="card-body">

            @if ($user->exists)
              <form class="" action="{{ route('users.update', $user->id) }}" method="post">
                  @method('PATCH')
                {{ csrf_field() }}
            @else
              <form class="" action="{{ route('users.store') }}" method="post">
                {{ csrf_field() }}
            @endif
              <h5>Agregar usuario</h5>
              <div class="form-group">
                <label for="nombre_usuario" class="col-md-4 control-label">Nombre del usuario *</label>
                <div class="col-md-9">
                  <input type="text" name="nombre_usuario" id="nombre_usuario" class="form-control" @if($user->exists) value="{{ $user->perfil->nombre }}" @endif />
                  @if ($errors->has('nombre_usuario'))
                    <span class="help-block ">
                      <strong class="text-danger">{{ $errors->first('nombre_usuario') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="form-group">
                <label for="ap_pa_usuario" class="col-md-4 control-label">Apellido Paterno del usuario *</label>
                <div class="col-md-9">
                  <input type="text" name="ap_pa_usuario" id="ap_pa_usuario" class="form-control" @if($user->exists) value="{{ $user->perfil->ap_pa }}" @endif />
                  @if ($errors->has('ap_pa_usuario'))
                    <span class="help-block ">
                      <strong class="text-danger">{{ $errors->first('ap_pa_usuario') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="form-group">
                <label for="ap_ma_usuario" class="col-md-4 control-label">Apellido Materno del usuario *</label>
                <div class="col-md-9">
                  <input type="text" name="ap_ma_usuario" id="ap_ma_usuario" class="form-control" @if($user->exists) value="{{ $user->perfil->ap_ma }}" @endif />
                  @if ($errors->has('ap_ma_usuario'))
                    <span class="help-block ">
                      <strong class="text-danger">{{ $errors->first('ap_ma_usuario') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              @if (!($user->exists))
                  <div class="form-group">
                      <label for="email_usuario" class="col-md-4 control-label">Correo electrónico del usuario *</label>
                      <div class="col-md-9">
                          <input type="email" name="email_usuario" id="email_usuario" class="form-control" @if($user->exists) value="{{ $user->email }}" @endif />
                              @if ($errors->has('email_usuario'))
                                  <span class="help-block ">
                                      <strong class="text-danger">{{ $errors->first('email_usuario') }}</strong>
                                  </span>
                              @endif
                      </div>
                  </div>
              @endif

              <div class="form-group">
                <label for="fecha_nacimiento_usuario" class="col-md-4 control-label">Fecha de nacimiento del usuario *</label>
                <div class="col-md-9">
                  <input type="text" name="fecha_nacimiento_usuario" id="fecha_nacimiento_usuario" class="form-control" @if($user->exists) value="{{ $user->perfil->fecha_nacimiento }}" @endif/>
                  @if ($errors->has('fecha_nacimiento_usuario'))
                    <span class="help-block ">
                      <strong class="text-danger">{{ $errors->first('fecha_nacimiento_usuario') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="form-group">
                <label for="pais_usuario" class="col-md-4 control-label">País de origen del usuario *</label>
                <div class="col-md-9">
                  <input type="text" name="pais_usuario" id="pais_usuario" class="form-control" @if($user->exists) value="{{ $user->perfil->pais_origen }}" @endif />
                  @if ($errors->has('pais_usuario'))
                    <span class="help-block ">
                      <strong class="text-danger">{{ $errors->first('pais_usuario') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="form-group">
                <label for="estado_usuario" class="col-md-4 control-label">Estado de origen del usuario *</label>
                <div class="col-md-9">
                  <input type="text" name="estado_usuario" id="estado_usuario" class="form-control" @if($user->exists) value="{{ $user->perfil->estado }}" @endif />
                  @if ($errors->has('estado_usuario'))
                    <span class="help-block ">
                      <strong class="text-danger">{{ $errors->first('estado_usuario') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="form-group">
                <label for="ciudad_usuario" class="col-md-4 control-label">Ciudad de origen del usuario *</label>
                <div class="col-md-9">
                  <input type="text" name="ciudad_usuario" id="ciudad_usuario" class="form-control" @if($user->exists) value="{{ $user->perfil->ciudad }}" @endif />
                  @if ($errors->has('ciudad_usuario'))
                    <span class="help-block ">
                      <strong class="text-danger">{{ $errors->first('ciudad_usuario') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="form-group">
                <label for="direccion_usuario" class="col-md-4 control-label">Dirección del usuario *</label>
                <div class="col-md-9">
                  <input type="text" name="direccion_usuario" id="direccion_usuario" class="form-control" @if($user->exists) value="{{ $user->perfil->direccion }}" @endif />
                  @if ($errors->has('direccion_usuario'))
                    <span class="help-block ">
                      <strong class="text-danger">{{ $errors->first('direccion_usuario') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="form-group">
                <label for="telefono_usuario" class="col-md-4 control-label">Teléfono del usuario *</label>
                <div class="col-md-9">
                  <input type="text" name="telefono_usuario" id="telefono_usuario" class="form-control" @if($user->exists) value="{{ $user->perfil->telefono }}" @endif />
                  @if ($errors->has('telefono_usuario'))
                    <span class="help-block ">
                      <strong class="text-danger">{{ $errors->first('telefono_usuario') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="form-group">
                <label for="rol_usuario" class="col-md-4 control-label">Rol del usuario *</label>
                <div class="col-md-9">
                    <select class="form-control" name="rol_usuario">
                        <option disabled selected>Elige un rol</option>
                        @foreach ($roles as $rol)
                            <option value="{{ $rol->id }}" @if ($user->rol_id == $rol->id) selected @endif>{{ $rol->name }}</option>
                        @endforeach
                    </select>
                  @if ($errors->has('rol_usuario'))
                    <span class="help-block">
                      <strong class="text-danger">{{ $errors->first('rol_usuario') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="form-group">
                <label for="status_usuario" class="col-md-4 control-label">Activo *</label>
                <div class="col-md-9">
                    <select class="form-control" name="status_usuario">
                        <option value="0" selected>No activo</option>
                        <option value="1">Activo</option>
                    </select>
                  @if ($errors->has('status_usuario'))
                    <span class="help-block ">
                      <strong class="text-danger">{{ $errors->first('status_usuario') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="card-footer text-right">
                  <a href="{{ route('users.index') }}" class="btn btn-secondary btn-sm">Regresar</a>
                  @if (!($user->exists))
                      <button type="submit" class="btn btn-primary btn-sm">Crear usuario</button>
                  @else
                      <button type="submit" class="btn btn-primary btn-sm">Editar usuario</button>
                  @endif
              </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
