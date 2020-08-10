@extends('layouts.main')

@section('title','EDITAR GENERO')

@section('content')
	{!! Form::open(['route'=>['genero.update', $genero], 'method'=>'PUT']) !!}
		<div class="form-group">
			{!! Form::label('genero', 'Nombre de Genero:') !!}
			{!! Form::text('genero', $genero->genero, ['class' => 'form-control',
										  'placeholder' => 'Nombre del Genero',
										  'required']) !!}
		</div>

		<div class="form-group">
			{!! Form::submit('Guardar', ['class'=>'btn btn-primary']) !!}
		</div>
	{!! Form::close() !!}
@endsection
