<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<script type="text/javascript" src="http://code.jquery.com/jquery-3.5.1.js"></script>
	<title>Editar apartado</title>
</head>

<body>


	<h1>Editar un apartado</h1>


	{!! Form::open(['method'=>'PATCH','url'=>'/apartados/'.$apartado->id]) !!}

	{!! Form::label ('id_estandar','Estandar') !!}
	{!! Form::select ('id_estandar', $estandares->pluck('nombre','id')->all(),$apartado->id_estandar) !!}

	<br>
	<br>

	{!! Form::label ('nombre','Nombre') !!}
	{!! Form::text ('nombre',$apartado->nombre,['placeholder'=>'Nombre','required']) !!}

	<br>
	<br>

	{!! Form::submit('Guardar editado de apartado') !!}
	{!! Form::close() !!}

</body>

</html>
