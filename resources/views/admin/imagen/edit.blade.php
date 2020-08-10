@extends('layouts.main')

@section('title','EDITAR IMAGEN')

@section('content')
	{!! Form::open(['route'=>['imagen.update', $imagen], 'method'=>'PUT']) !!}
		<div class="form-group">
			{!! Form::label('nombre', 'Nombre de la Imagen:') !!}
			{!! Form::text('nombre', $imagen->nombre, ['class' => 'form-control',
										  'placeholder' => 'Nombre de  la Imagen',
										  'required']) !!}
		</div>

		<div class="form-group">
			{!! Form::submit('Guardar', ['class'=>'btn btn-primary']) !!}
		</div>
	{!! Form::close() !!}
@endsection
