@extends('layouts.main')

@section('title','EDITAR PELICULA')

@section('content')
	{!! Form::open(['route'=>['pelicula.update', $pelicula], 'method'=>'PUT', 'files'=>true]) !!}
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
			{!! Form::textarea('resumen', $pelicula->resumen, ['class' => 'form-control',
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
			{!! Form::label('genero_id', 'Genero:') !!}
            {!! Form::select('genero_id', $generos,
                $pelicula->genero_id, ['class' => 'form-control',
									'placeholder' => 'Seleccione una opcion',
									'required']) !!}
		</div>
        <div class="form-group">
			{!! Form::label('directores', 'Directores:') !!}
            {!! Form::select('directores[]', $directores,
                $pelicula->directores, ['class' => 'form-control',
									'required','multiple']) !!}
		</div>
        <div class="form-group">
			{!! Form::label('imagen', 'Imagenes:') !!}
            {!! Form::file('imagen')!!}

            <img id="img-pelicula" src="{{ url('imagenes/pelicula/'.$imagensel) }}"
            alt="Imagen de la pelicula" width="70%">
		<div class="form-group">
			{!! Form::submit('Guardar', ['class'=>'btn btn-primary']) !!}
		</div>


	{!! Form::close() !!}
@endsection
@section('javascript')
<script>
		function readURL(input) {
		  if (input.files && input.files[0]) {
		  	var img = document.getElementById('img-pelicula');
		  	img.style.visibility = 'visible';
		    var reader = new FileReader();
		    reader.onload = function(e) {
		      $('#img-pelicula').attr('src', e.target.result);
		    }
		    reader.readAsDataURL(input.files[0]); // convert to base64 string
		  }
		}
		$("#imagen").change(function() {
		  readURL(this);
		});
	</script>
@endsection
