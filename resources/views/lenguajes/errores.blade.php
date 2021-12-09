
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Error en el registro</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<link href="{{asset('estilo/css/base.css')}}" rel="stylesheet" />
</head>
<body>
	<h1>NO SE PUDO REALIZAR EL REGISTRO:</h1>
	<p>{!! $errores !!}</p>
	<div class="opcnuevas">
			<a class="btn btn-primary" href="lenguajes" role="button">Regresar al listado de lenguajes</a>
			<a class="btn btn-primary" href="{!! asset('home') !!}" role="button">Regresar al home</a>
	</div>
</body>
</html>