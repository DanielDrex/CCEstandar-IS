<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Archivos</title>
</head>
<body>
	<h1>Listado de archivos</h1>
	<a href="archivos/create">subir un archivo</a>
	<table>
		<tr>
			<th>Nombre</th>
			<th>Archivo</th>
		</tr>
		@foreach($archivos as $archivo)
		<tr>
			<td>{!! $archivo->nombre !!}</td>
			<td>{!! $archivo->ruta !!}</td>
			<td>
				<a href="{!! asset('leer_archivo/'.$archivo->ruta) !!}">Contenido</a>
				<a href="{!! asset('lenguaje_compatible/'.$archivo->id) !!}">Evaluar</a>
				{!! Form::open(['method'=>'DELETE','url'=>'/archivos/'.$archivo->id]) !!}
				{!! Form::submit('Eliminar') !!}
				{!! Form::close() !!}
			</td>
		</tr>
		@endforeach
</table>
<br>
<a href="{!! asset('home') !!}">Regresar al home</a>

</body>
</html>