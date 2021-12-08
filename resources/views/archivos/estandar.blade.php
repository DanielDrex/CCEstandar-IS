<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Estandares</title>
</head>
<body>
	<h1>Selecciona un estandar para evaluar en el lenguaje:</h1>
	<h2>{!! $lenguaje->nombre !!}</h2>
	<table>
		<tr>
			<th>Estandar</th>
		</tr>
		@foreach($estandares as $estandar)
		<tr>
			<td>{!! $estandar->nombre !!}</td>
			<td>
				<a href="{!! asset('evaluar/'.$estandar->id.'/'.$archivo->id) !!}">Seleccionar estandar y evaluar</a>
			</td>
		</tr>
		@endforeach
</table>
<br>
<a href="{!! asset('home') !!}">Regresar al home</a>

</body>
</html>