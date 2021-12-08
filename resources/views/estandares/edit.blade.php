<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Editar un estandar</title>
</head>

<body>

	<h1>Editar estandar</h1>

	{!! Form::open(['method'=>'PATCH','url'=>'/estandares/'.$estandar->id]) !!}

	{!! Form::label ('id_lenguaje','Lenguaje') !!}
	{!! Form::select ('id_lenguaje', $lenguajes->pluck('nombre','id')->all(),$estandar->id_lenguaje) !!}

	<br>
	<br>

	{!! Form::label ('nombre','Nombre') !!}
	{!! Form::text ('nombre',$estandar->nombre,['placeholder'=>'Nombre de la estandar','required']) !!}

	<br>
	<br>

	{!! Form::submit('Guardar editado') !!}
	{!! Form::close() !!}
</body>

</html>
