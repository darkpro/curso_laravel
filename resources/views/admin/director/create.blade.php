@extends('layouts.main')

@section('title','NUEVO DIRECTOR')

@section('content')
	@include('layouts.error')
	{!! Form::open(['route'=>'director.store']) !!}
		<div class="form-group">
			{!! Form::label('nombre', 'Nombre del Director:') !!}
			{!! Form::text('nombre', null, ['class' => 'form-control',
										  'placeholder' => 'Nombre del Director',
										  'required']) !!}
		</div>

		<div class="form-group">
			{!! Form::submit('Guardar', ['class'=>'btn btn-primary']) !!}
		</div>
	{!! Form::close() !!}
@endsection
