@extends('layouts.app')
@section('content')

    @section('scripts')
      <script src="{!! asset('js/stl-viewer/stl_viewer_demo.js') !!}"></script>
      <script src="{!! asset('js/stl-viewer/stl_viewer.min.js') !!}"></script>
    @endsection
{{-- 
    <script type="text/javascript">
    $(document).ready(function() {
        var stl_viewer = new StlViewer(document.getElementById('stl_cont'), {
            load_three_files: "{{ asset('js/stl-viewer') }}/",
            bgcolor: '#2e333a',
            models: [
                { id: 0, filename: 'banner.stl' }
            ],
        });
    });
    </script>


    <div style="height:100vh" id="stl_cont">
    </div> --}}


    <div class="container text-center">
        <a href="{!! route('stl.model', 'banner') !!}">Banner</a><br>
        <a href="{!! route('stl.model', 'Hat') !!}">Hat</a><br>
        <a href="{!! route('stl.model', 'Body') !!}">Body</a><br>
    </div>






  {{-- <a href="{!! route('stl.model') !!}">Model</a> --}}

  {{-- <div class="container row">

    <div class="col-md-4" id="stl_info">
    </div>

    <div class="col-md-4">
      <select id="stl_files" class="" size="2" name="">
        {{-- @foreach ($files as $file)
          <option value="{!! asset('js/stl-viewer/stl-files/') !!}/{{ $file }}">{{ $file }}</option>
        @endforeach --}
        <option value="{!! asset('js/stl-viewer/stl-files') !!}/banner.stl">banner.stl</option>
        <option value="{!! asset('js/stl-viewer/stl-files') !!}/Hat.stl">Hat.stl</option>
        <option value="{!! asset('js/stl-viewer/stl-files') !!}/body.stl">body.stl</option>
      </select>
    </div>

    <div class="col-md-4" id="stl_ctrs">
      {{-- <button class="btn btn-success" onclick="uploadModel('banner.stl')" type="button">Cargar modelo</button> -}}
      <button id="quitar" class="btn btn-info" onclick="" type="button">Quitar modelo</button>
    </div>

  </div> --}}
{{--

  <a href="{!! route('stl.model', 'banner.stl') !!}">Banner</a><br>
  <a href="{!! route('stl.model', 'Hat.stl') !!}">Hat</a><br>
  <a href="{!! route('stl.model', 'Body.stl') !!}">Body</a><br> --}}
{{--
  {{-- @foreach ($models as $model)
    <a href="{!! route('stl.model', $model->name) !!}">{{  }}</a>
  @endforeach --}}


@endsection
