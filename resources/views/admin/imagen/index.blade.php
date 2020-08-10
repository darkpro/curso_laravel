@extends('layouts.main')

@section('title','LISTA DE IMAGENES')

@section('content')
	@include('flash::message')
	<a href="{{ route('imagen.create') }}" class="btn btn-primary">Nueva Imagen</a>
	<table class="table">
		<tr>
			<th>ID</th>
			<th>Nombre</th>
			<th>Accion</th>
		</tr>
		@foreach($imagenes as $imagen)
		<tr>
			<td>{{ $imagen->id }}</td>
			<td>{{ $imagen->nombre }}</td>
			<td>
				<a href="{{ route('imagen.destroy', $imagen->id) }}"
				   onclick="eliminarRegistro(event, this.href)"
				   class="btn btn-danger btn-xs" title="Eliminar">
					<span class="glyphicon glyphicon-trash"></span>
				</a>
				<a href="{{ route('imagen.edit', $imagen->id) }}"
				   class="btn btn-success btn-xs" title="Editar">
					<span class="glyphicon glyphicon-pencil"></span>
				</a>
			</td>
		</tr>
		@endforeach
	</table>
	{{ $imagenes->links() }}
@endsection

@section('javascript')
	<script>
		function eliminarRegistro(event, url){
			event.preventDefault();
			if(confirm("Esta seguro de eliminar el registro?")){
				window.location.href = url;
			}
		}
	</script>
@endsection
