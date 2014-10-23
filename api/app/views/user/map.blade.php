@extends('layouts.master')

@section('content')
<div id="page-wrapper">
    <div class="row">
          <div class="col-lg-12">
               <h1 class="page-header">Mapa</h1>
          </div>
                                 <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <img src="/img/map.PNG" width="100%" id="map" class="img-responsive" style="position: relative;">
        <span style="position: absolute;">Hola</span>
    </div>
</div>
        <!-- /#page-wrapper -->

@stop
@section('scripts')
{{ HTML::script('js/plugins/WheelZoom.js')}}
<script>
$(document).ready(function(){
    wheelzoom($("#map"));
});
</script>
@stop
