@extends('layouts.main')

@section('title','EDITAR USUARIO')

@section('content')
	{!! Form::open(['route'=>['pelicula.update', $pelicula], 'method'=>'PUT']) !!}
    <div class="form-group">
			{!! Form::label('titulo', 'Titulo:') !!}
			{!! Form::text('titulo', $pelicula->titulo, ['class' => 'form-control',
										  'placeholder' => 'Nombre de la pelicula',
										  'required']) !!}
		</div>
        <div class="form-group">
			{!! Form::label('costo', 'Costo:') !!}
			{!! Form::number('costo', $pelicula->costo, ['class' => 'form-control',
										  'placeholder' => 'Costo de la pelicula',
										  'required']) !!}
		</div>
        <div class="form-group">
			{!! Form::label('resumen', 'Resumen:') !!}
			{!! Form::text('resumen', $pelicula->resumen, ['class' => 'form-control',
										  'placeholder' => 'Resumen de la pelicula',
										  'required']) !!}
		</div>
        <div class="form-group">
			{!! Form::label('estreno', 'Estreno:') !!}
			{!! Form::date('estreno', $pelicula->estreno, ['class' => 'form-control',
										  'placeholder' => 'Fecha de Estreno de la pelicula',
										  'required']) !!}
		</div>

		<div class="form-group">
			{!! Form::submit('Guardar', ['class'=>'btn btn-primary']) !!}
		</div>
	{!! Form::close() !!}
@endsection
