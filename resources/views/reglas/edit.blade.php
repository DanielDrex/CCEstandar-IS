<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<script type="text/javascript" src="http://code.jquery.com/jquery-3.5.1.js"></script>
	<title>Editar regla</title>
</head>

<body>


	<h1>editar una regla</h1>


	{!! Form::open(['method'=>'PATCH','url'=>'/reglas/'.$regla->id]) !!}

	{!! Form::label ('id_apartado','Apartado') !!}
	{!! Form::select ('id_apartado', $apartados->pluck('nombre','id')->all(),$regla->id_apartado) !!}

	<br>
	<br>

	{!! Form::label ('nombre','Nombre') !!}
	{!! Form::text ('nombre',$regla->nombre,['placeholder'=>'Nombre','required']) !!}

	<br>
	<br>

	{!! Form::label ('posicion','Posicion') !!}
	{!!Form::selectRange('posicion', 1, 50,$regla->posicion)!!}

	<br>
	<br>


	{!! Form::submit('Guardar editado de regla') !!}
	{!! Form::close() !!}
</body>


</html>
