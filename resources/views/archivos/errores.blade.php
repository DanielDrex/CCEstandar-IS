<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Error</title>
</head>
<body>
	<h1>NO SE PUDO REALIZAR la subida:</h1>
	<p>{!! $errores !!}</p>
	<a href="{!! asset('archivos') !!}">Regresar al listado de archivos</a>
	<a href="{!! asset('home') !!}">Regresar al home</a>
</body>
</html>