
<body>
	<h1>Listado de lenguajes</h1>
	<a href="lenguajes/create">Crear lenguaje</a>
	<table>
		<tr>
			<th>Nombre</th>
			<th>Extension</th>
		</tr>
		@foreach($lenguajes as $lenguaje)
		<tr>
			<td>{!! $lenguaje->nombre !!}</td>
			<td>{!! $lenguaje->extension !!}</td>
			<td style="background-color:white;">		
				<a href="{!! asset('lenguaje_estandar/'.$lenguaje->id) !!}">Ver estandares</a>
			</td>
		</tr>
		@endforeach
</table>
<br>

<a href="{!! asset('home') !!}">Regresar al home</a>


</body>
