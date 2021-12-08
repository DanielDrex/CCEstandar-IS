<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Error en el registro</title>
</head>
<body>
	<h1>NO SE PUDO REALIZAR EL REGISTRO:</h1>
	<p>{!! $errores !!}</p>
	<a href="{!! asset('regla_valor/'.$id_regla) !!}">Regresar a los valores de la regla</a>
	<a href="{!! asset('home') !!}">Regresar al home</a>
</body>
</html>