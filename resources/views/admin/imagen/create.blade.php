@extends('layouts.main')

@section('title','NUEVA IMAGEN')

@section('content')
	@include('layouts.error')
	{!! Form::open(['route'=>'imagen.store']) !!}
		<div class="form-group">
			{!! Form::label('nombre', 'Nombre de la Imagen:') !!}
			{!! Form::text('nombre', null, ['class' => 'form-control',
										  'placeholder' => 'Nombre de la Imagen',
										  'required']) !!}
		</div>

		<div class="form-group">
			{!! Form::submit('Guardar', ['class'=>'btn btn-primary']) !!}
		</div>
	{!! Form::close() !!}
@endsection
