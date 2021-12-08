<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Error en el registro</title>
</head>
<body>
	<h1>NO SE PUDO REALIZAR EL REGISTRO:</h1>
	<p>{!! $errores !!}</p>
	<a class="nav-link" href="lenguajes">Regresar al listado de lenguajes</a>
	<a href="{!! asset('home') !!}">Regresar al home</a>
</body>
</html>