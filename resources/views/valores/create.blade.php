<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<script type="text/javascript" src="http://code.jquery.com/jquery-3.5.1.js"></script>
	<title>Crear valor variable</title>
</head>

<body>


	<h1>Crear un valor</h1>

	{!! Form::open(['url'=>'/valores']) !!}

	{!! Form::hidden ('id_regla',$regla->id) !!}

	@if( $regla->tipo_regla  == 0)

	{!! Form::hidden ('nombre','1CONSTANTE1') !!}


	{!! Form::hidden ('caracteres',99) !!}


	{!! Form::label ('valor','Valor') !!}
	{!! Form::text ('valor',null,['placeholder'=>'Valor','required']) !!}

	<br>
	<br>

	{!! Form::hidden ('tipo_valor',0) !!}

         
    @else

	{!! Form::label ('caracteres','Caracteres permitidos') !!}
	{!! Form::select ('caracteres',array('0'=>'Espacio','1'=>'Letras','2'=>'Numeros','3'=>'Letras y numeros','4'=>'Llaves {}','5'=>'Parentesis ()','6'=>'Corchetes []','7'=>'Todos los caracteres')) !!}


	{!! Form::hidden ('valor','1VARIABLE1') !!}


	{!! Form::hidden ('tipo_valor', 1) !!}

	<br>
	<br>    
         
    @endif

    {!! Form::hidden ('status',1) !!}


	{!! Form::submit('Guardar valor') !!}
	{!! Form::close() !!}
	<a href="{!! asset('home') !!}">Regresar al home</a>
</body>

</html>
