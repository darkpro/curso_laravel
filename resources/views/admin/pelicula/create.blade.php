@extends('layouts.main')

@section('title','NUEVA PELICULA')

@section('content')
	@include('layouts.error')
	{!! Form::open(['route'=>'pelicula.store']) !!}
		<div class="form-group">
			{!! Form::label('titulo', 'Titulo:') !!}
			{!! Form::text('titulo', null, ['class' => 'form-control',
										  'placeholder' => 'Nombre de la pelicula',
										  'required']) !!}
		</div>
        <div class="form-group">
			{!! Form::label('costo', 'Costo:') !!}
			{!! Form::number('costo', null, ['class' => 'form-control',
										  'placeholder' => 'Costo de la pelicula',
										  'required']) !!}
		</div>
        <div class="form-group">
			{!! Form::label('resumen', 'Resumen:') !!}
			{!! Form::text('resumen', null, ['class' => 'form-control',
										  'placeholder' => 'Resumen de la pelicula',
										  'required']) !!}
		</div>
        <div class="form-group">
			{!! Form::label('estreno', 'Estreno:') !!}
			{!! Form::date('estreno', null, ['class' => 'form-control',
										  'placeholder' => 'Fecha de Estreno de la pelicula',
										  'required']) !!}
		</div>
		<div class="form-group">
			{!! Form::submit('Guardar', ['class'=>'btn btn-primary']) !!}
		</div>
	{!! Form::close() !!}
@endsection
