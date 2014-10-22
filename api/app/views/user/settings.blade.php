@extends('layouts.master')

@section('content')
<div id="page-wrapper">
    <div class="row">
          <div class="col-lg-12">
               <h1 class="page-header">Configuraciones</h1>
          </div>
                                 <!-- /.col-lg-12 -->
    </div>
    <div class="row">
    <small>*Nota : La data se envia en Hexadecimal</small>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <td colspan="3">Tipos de estandarizacion de los datos.</td>
                </tr>
                <tr>
                    <td>Nombre</td>
                    <td>Parametros de Envio</td>
                    <td>Ejemplo</td>
                </tr>
            </thead>
            <tbody>
                @foreach($types as $type)
                    <tr>
                        <td>{{$type->name}}</td>
                        <td>{{$type->parameter}}</td>
                        <td>{{$type->example}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
        <!-- /#page-wrapper -->
@stop