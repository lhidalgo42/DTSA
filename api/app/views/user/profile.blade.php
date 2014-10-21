@extends('layouts.master')

@section('content')
<div id="page-wrapper">
    <div class="row">
          <div class="col-lg-12">
               <h1 class="page-header">Editar Perfil </h1>
          </div>
                                 <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        {{ Form::open(array('url' => '/profile','role' => 'form')) }}
        <div class="col-lg-6">
          <div class="form-group">
            {{ Session::get('mensaje_error') }}
          </div>
          <div class="form-group">
            <label for="name">Nombre</label>
            {{ Form::text('name', $user->name, array('placeholder' => 'Nombre','class' => 'form-control','id' => 'name','style' => 'width:300px;')) }}
          </div>
          <div class="form-group">
            <label for="last_name">Apellido</label>
            {{ Form::text('last_name', $user->last_name, array('placeholder' => 'Apellido','class' => 'form-control','id' => 'last_name','style' => 'width:300px;')) }}
          </div>
          <div class="form-group">
            <label for="email">Direccion de Correo</label>
            {{ Form::email('email', $user->email, array('placeholder' => 'Direccion de Correo','class' => 'form-control','id' => 'email','style' => 'width:300px;')) }}
          </div>
          <div class="form-group">
           <label for="phone">Telefono</label>
            {{ Form::text('phone', $user->phone, array('placeholder' => 'Telefono Celular','class' => 'form-control','id' => 'phone','style' => 'width:300px;')) }}
          </div>
          </div>
          <div class="col-lg-6">
          <div class="form-group">
          <label for="password">Ingrese Contraseña</label>
            {{ Form::password('password', array('placeholder' => 'Ingrese Contraseña','class' => 'form-control','id' => 'password','style' => 'width:300px;','required')) }}
          </div>
          <div class="form-group">
          <label for="password1">Nueva Contraseña</label>
            {{ Form::password('password1', array('placeholder' => 'Ingrese Contraseña','class' => 'form-control','id' => 'password1','style' => 'width:300px;')) }}
          </div>
          <div class="form-group">
          <label for="password2">Reingrese Contraseña</label>
            {{ Form::password('password2', array('placeholder' => 'Reingrese Contraseña','class' => 'form-control','id' => 'password1','style' => 'width:300px;')) }}
          </div>
            {{ Form::submit('Guardar Cambios',array('class' => 'btn btn-lg btn-success','style' => 'width:300px;' )) }}
        {{Form::close()}}
    </div>

</div>
        <!-- /#page-wrapper -->

@stop