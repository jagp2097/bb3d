@extends('layouts.app')
@section('content')

    @section('scripts')
        <script src="{{  asset('js/stl-viewer/stl_viewer.min.js')  }}"></script>
    @endsection

    <script type="text/javascript">
        $(document).ready(function() {
            var stl_viewer = new StlViewer(document.getElementById('stl_cont'), {
                load_three_files: "{{ asset('js/stl-viewer') }}/",
                // loading_progress_callback: model_progress,
                zoom: 180,
                bgcolor: '#F2F5F8',
                models: [
                    {
                        id: 0,
                        filename: "{{ asset('images/') }}/{{ $model->referencia }}",
                    }
                ],
                model_loaded_callback: model_info,

            });

            // console.log(.keys(load_status));

            function model_info(model_id) {

                console.log(stl_viewer.get_model_info(model_id));

                $('#model_info').append(`

                    <p> Nombre: `+"{{ $model->nombre_archivo }}"+`</p>
                    <p>Área: `+stl_viewer.get_model_info(model_id).area+` mm2</p>
                    <p>Dimensiones</p>
                    <p>X = `+stl_viewer.get_model_info(model_id).dims.x+` mm</p>
                    <p>Y = `+stl_viewer.get_model_info(model_id).dims.y+` mm</p>
                    <p>Z = `+stl_viewer.get_model_info(model_id).dims.z+` mm</p>
                    <p>Volúmen: `+stl_viewer.get_model_info(model_id).volume+` mm3</p>

                    <div class="justify-content-center text-center">
                        <a role="button" class="btn btn-secondary btn-sm m-3" href="`+"{{ URL::previous() }}"+`">Regresar a archivos</a>
                    </div>


                `);
            }

            // function model_progress(load_status, load_session) {
            //     // load_status: array de los modelos que se estan cargando con dos campos: loaded, total
            //     // load_session: numero, representa el progresso actual
            //     var loaded = 0;
            //     var total = 0;
            //
            //     Object.keys(load_status).forEach(function(model_id) {
            //         if ((load_status[model_id].load_session == load_session)) {
            //             loaded = loaded + load_status[model_id].loaded;
            //
            //             // console.log(loaded);
            //             document.getElementById("pb"+model_id).value = load_status[model_id].loaded/load_status[model_id].total;
            //         }
            //     });
            //
            //
            //
            // }

        });
    </script>
    
    
    <section id="clients">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 justify-content-center box">
                    <div class="section-header text-center">
                        <h4>STL Viewer</h4>
                    </div>

                    <div class="row container">
                        <div class="col-lg-7 justify-content-center">
                            <div id="stl_cont" style="height: 75%"></div>
                        </div>
                        <div class="col-lg-5 justify-content-center">
                            <div class="section-header text-center">
                                <h5>Información</h5>
                            </div>
                            <div id="model_info" class="container"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


{{--     <div class="container">
        <div class="row">
            <div class="col-md-1"></div>
            </div>
        </div>
    </div>
 --}}
    {{-- <progress id="pb0" value="0" max="1"></progress> --}}

  @endsection
