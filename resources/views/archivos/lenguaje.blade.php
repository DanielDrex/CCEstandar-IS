<head>
	<meta charset="utf-8">
	<title>Lenguaje compatible</title>
</head>
<body>
	<h1>Lenguaje del archivo:</h1>
	<h2>{!! $archivo->ruta !!}</h2>
	<table>
		<tr>
			<th>Lenguaje</th>
			<th>Extension</th>
		</tr>
		@foreach($lenguajes as $lenguaje)
		<tr>
			<td>{!! $lenguaje->nombre !!}</td>
			<td>{!! $lenguaje->extension !!}</td>
			<td style="background-color:white;">		
				<a href="{!! asset('select_estandar/'.$lenguaje->id.'/'.$archivo->id) !!}">ver estandares</a>
			</td>
		</tr>
		@endforeach
</table>
<br>

<a href="{!! asset('home') !!}">Regresar al home</a>


</body>
