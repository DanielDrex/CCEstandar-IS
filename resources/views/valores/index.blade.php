<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Valores</title>
</head>
<body>
	<h1>Listado de valores</h1>

	@if($tipo == 0)
	         
	  <table>
		<tr>
			<th>--valor--</th>
			<th>--tipo de valor--</th>
			<th>--regla--</th>
		</tr>
		@foreach($valores as $valor)
		<tr>
			<td>{!! $valor->valor !!}</td>
			<td> Constante </td>
			<td>{!! $valor->reglas->nombre !!}</td>
			<td>
				{!! Form::open(['method'=>'DELETE','url'=>'/valores/'.$valor->id]) !!}
				{!! Form::submit('Eliminar') !!}
				{!! Form::close() !!}
			</td>
		</tr>
		@endforeach
	</table>         
	         
	@else
	    <table>
		<tr>
			<th>--caracteres--</th>
			<th>--tipo_valor--</th>
			<th>--regla--</th>
		</tr>
		@foreach($valores as $valor)
		<tr>
			@switch($valor->caracteres)
			    @case(0)
			        <td>espacio</td>
			        @break
			    @case(1)
			        <td>Letras</td>
			        @break
			    @case(2)
			        <td>Numeros</td>
			        @break
			    @case(3)
			        <td>Letras y numeros</td>
			        @break
			    @case(4)
			        <td>Llaves</td>
			        @break
			    @case(5)
			        <td>Parentesis</td>
			    @case(6)
			        <td>Corchetes</td>
			        @break
			    @case(7)
			        <td>Todos</td>
			        @break
			@endswitch
			<td> Variable </td>
			<td>{!! $valor->reglas->nombre !!}</td>
			<td>
				{!! Form::open(['method'=>'DELETE','url'=>'/valores/'.$valor->id]) !!}
				{!! Form::submit('Eliminar') !!}
				{!! Form::close() !!}
			</td>
		</tr>
		@endforeach
		</table>      
	         
	@endif

<br>
<a href="{!! asset('apartado_reglas/'.$id_apartado) !!}">Regresar a las reglas del apartado</a>
<a href="{!! asset('home') !!}">Regresar al home</a>

</body>
</html>