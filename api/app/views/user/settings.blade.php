@extends('layouts.master')

@section('content')
<div id="page-wrapper">
    <div class="row">
          <div class="col-lg-12">
               <h1 class="page-header">Configuraciones<span class="pull-right"><a href="/1/map"><i class="fa fa-file-image-o"></i> Ver mapa</span></a></h1>
               <h1 class=" right"></h1>
          </div>
                                 <!-- /.col-lg-12 -->
    </div>
    <div class="row">
    <small>*Nota : La data se envia en Hexadecimal</small>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th colspan="4" style="text-align: center;">Tipos de estandarizacion de los datos.</th>
                </tr>
                <tr>
                    <td>ID</td>
                    <td>Nombre</td>
                    <td>Parametros de Envio</td>
                    <td>Ejemplo</td>
                </tr>
            </thead>
            <tbody>
                @foreach($types as $type)
                    <tr>
                        <td>{{$type->id}}</td>
                        <td>{{$type->name}}</td>
                        <td>{{$type->parameter}}</td>
                        <td>{{$type->example}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="row">
    <table class="table table-bordered">
    <thead>
        <tr>
            <th rowspan="2">ID</th>
            <th rowspan="2">Nombre</th>
            <th colspan="3" style="text-align: center;">Inventario</th>
        </tr>
        <tr>
        <th>Nombre</th>
        <th>Sitio</th>
        <th>Cantidad</th>
        </tr>
    </thead>
    <tbody>
        @foreach($receptors as $receptor)
            <tr>
                <td rowspan="{{InventoryReceptor::where('receptors_id',$receptor->id)->sum('count')}}">{{$receptor->id}}</td>
                <td rowspan="{{InventoryReceptor::where('receptors_id',$receptor->id)->sum('count')}}">{{$receptor->name}} ({{$receptor->mac}})</td>

                @for($i=0;$i< count(Inventory::join('inventory_receptors','inventory_receptors.inventory_id','=','inventory.id')->where('inventory_receptors.receptors_id','=',$receptor->id)->select('inventory.name','inventory.url')->get());$i++)
                    @if($i==0)
                        <td>{{Inventory::join('inventory_receptors','inventory_receptors.inventory_id','=','inventory.id')->where('inventory_receptors.receptors_id','=',$receptor->id)->select('inventory.name')->get()[$i]->name}}</td>
                        <td><a href="{{Inventory::join('inventory_receptors','inventory_receptors.inventory_id','=','inventory.id')->where('inventory_receptors.receptors_id','=',$receptor->id)->select('inventory.url')->get()[$i]->url}}">Visitar Sitio</a></td>
                        <td>{{Inventory::join('inventory_receptors','inventory_receptors.inventory_id','=','inventory.id')->where('inventory_receptors.receptors_id','=',$receptor->id)->select('inventory_receptors.count')->get()[$i]->count}}</td>
                    @endif
                    @if($i!=0)
                    <tr>
                    <td>{{Inventory::join('inventory_receptors','inventory_receptors.inventory_id','=','inventory.id')->where('inventory_receptors.receptors_id','=',$receptor->id)->select('inventory.name')->get()[$i]->name}}</td>
                    <td><a href="{{Inventory::join('inventory_receptors','inventory_receptors.inventory_id','=','inventory.id')->where('inventory_receptors.receptors_id','=',$receptor->id)->select('inventory.url')->get()[$i]->url}}">Visitar Sitio</a></td>
                    <td>{{Inventory::join('inventory_receptors','inventory_receptors.inventory_id','=','inventory.id')->where('inventory_receptors.receptors_id','=',$receptor->id)->select('inventory_receptors.count')->get()[$i]->count}}</td>
                    </tr>
                    @endif
                @endfor
        @endforeach
    </tbody>
    </table>
    </div>

</div>
        <!-- /#page-wrapper -->
@stop