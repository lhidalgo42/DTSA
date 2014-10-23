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
        <section id="focal">
              <div class="parent">
                <div class="panzoom">
                  <img src="/img/map.PNG" width="1500">
                </div>
              </div>
              <script>
                (function() {
                  var $section = $('#focal');
                  var $panzoom = $section.find('.panzoom').panzoom();
                  $panzoom.parent().on('mousewheel.focal', function( e ) {
                    e.preventDefault();
                    var delta = e.delta || e.originalEvent.wheelDelta;
                    var zoomOut = delta ? delta < 0 : e.originalEvent.deltaY > 0;
                    $panzoom.panzoom('zoom', zoomOut, {
                      increment: 0.1,
                      animate: false,
                      focal: e
                    });
                  });
                })();
              </script>
            </section>

</div>
        <!-- /#page-wrapper -->
@stop
@section('scripts')
{{ HTML::script('/js/jquery.panzoom.js')}}
{{ HTML::script('/js/jquery.mousewheel.js')}}
@stop