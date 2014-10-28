@extends('layouts.master')

@section('content')
<div id="page-wrapper">
    <div class="row">
          <div class="col-lg-12">
               <h1 class="page-header">Mapa</h1>
          </div>
                                 <!-- /.col-lg-12 -->
    </div>
    <div class="row" id="site">
        <img src="/img/map.PNG" width="100%" id="map">
                <div id="text1">
                    <strong><button class="btn btn-success"></button></strong> @{{ status 1 }}
                </div>
                <div id="text2">
                    <strong><button class="btn btn-warning"></button></strong> @{{ status 2 }}
                </div>
                <div id="text3">
                    <strong><button class="btn btn-danger"></button></strong> @{{ status 3 }}
                </div>
                <div id="text4">
                    <strong><button class="btn btn-success"></button></strong> @{{ status 4 }}
                </div>
                <div id="text5">
                    <strong><button class="btn btn-warning"></button></strong> @{{ status 5 }}
                </div>
                <div id="text6">
                    <strong><button class="btn btn-danger"></button></strong> @{{ status 6 }}
                </div>
    </div>
</div>
        		<script src="/js/plugins/zoom.js"></script>
        		<script>
        			$("#site").children("div").click(function(e){
        			e.preventDefault();
        			zoom.to({ element: e.target,
        			          scale: 2});
        			})
        		</script>


        		<!-- Everything below this point is unrelated to the library -->

@stop
@section('css')
<style>
.cycle-slideshow {
position: relative;
z-index:1;

}
#text1 {
    position: absolute;
    top: 335px;
    left: 800px;;
    z-index:2;

}
#text2 {
    position: absolute;
    top: 350px;
    left: 800px;;
    z-index:2;

}
#text3 {
    position: absolute;
    top: 365px;
    left: 800px;;
    z-index:2;

}
#text4 {
    position: absolute;
    top: 400px;
    left: 400px;;
    z-index:2;

}
#text5 {
    position: absolute;
    top: 415px;
    left: 400px;;
    z-index:2;

}
#text6 {
    position: absolute;
    top: 430px;
    left: 400px;;
    z-index:2;

}
</style>
@stop
