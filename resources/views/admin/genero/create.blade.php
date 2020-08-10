@extends('layouts.main')

@section('title','NUEVO GENERO')

@section('content')
	@include('layouts.error')
	{!! Form::open(['route'=>'genero.store']) !!}
		<div class="form-group">
			{!! Form::label('genero', 'Nombre de Genero:') !!}
			{!! Form::text('genero', null, ['class' => 'form-control',
										  'placeholder' => 'Nombre del Genero',
										  'required']) !!}
		</div>

		<div class="form-group">
			{!! Form::submit('Guardar', ['class'=>'btn btn-primary']) !!}
		</div>
	{!! Form::close() !!}
@endsection
