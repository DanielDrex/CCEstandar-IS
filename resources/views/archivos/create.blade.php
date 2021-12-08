<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Insertar archivo</title>
</head>

<body>

	<h1>Insercion de un archivo</h1>

	{!! Form::open(['url'=>'/archivos','enctype'=>'multipart/form-data','class'=>'contactForm']) !!}


	{!! Form::label ('nombre','Nombre') !!}
	{!! Form::text ('nombre',null,['placeholder'=>'Nombre','required']) !!}

	{!! Form::hidden('ruta','defo') !!}

	<br>
	<br>

	{!! Form::label ('archiv','archivo: ',['class'=>'control-label']) !!}
	{!! Form::file ('archiv',null,['class'=>'form-control'],'required') !!}

	<br>
	<br>

	{!! Form::hidden ('status',1) !!}


	{!! Form::submit('Subir archivo') !!}
	{!! Form::close() !!}
</body>

</html>
