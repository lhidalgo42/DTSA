@extends('...layouts.master')

     @section('content')
     <div id="page-wrapper">
                 <div class="row">
                     <div class="col-lg-12">
                         <h1 class="page-header">Bienvenido  </h1>
                     </div>
                     <!-- /.col-lg-12 -->
                 </div>
                 <!-- /.row -->
                 @include('sensors.card')
                 <!-- /.row -->
                 @include('sensors.chart')
                 <div class="row">

                <table class="table table-bordered">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Valores</td>
                        <td>Fecha</td>
                    </tr>
                </thead>
                @foreach($values as $value)
                    <tr>
                        <td>{{$value->id}}</td>
                        <td>{{$value->value}}</td>
                        <td>{{$value->created_at}}</td>
                    </tr>
                @endforeach
                </table>
                 </div>
                 <!-- /.row -->
             </div>
             <!-- /#page-wrapper -->

     @stop
     @section('scripts')
     {{ HTML::script('http://code.highcharts.com/highcharts.js')}}
     @stop
