</html>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Archivos</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<link href="{{asset('estilo/css/base.css')}}" rel="stylesheet" />
</head>

<body>
	<div class="jumbotron-jumbotron-fluid">
		<div class="container">
			<h1 class="display-4">Control de calidad de estandares</h1>
			<p class="lead">Listado de archivos </p>
		</div>
		<section class="img-intro">
			<figure>
				<img src="https://www.itmastersmag.com/wp-content/uploads/2021/01/shutterstock_1078387013-2048x1024.jpg" alt="CCE">
			</figure>
		</section>
		<div class="listado">
			<table>
				<tr>

					<th>Nombre</th>
					<th>Archivo</th>
					<th>Opciones</th>
				</tr>
				@foreach($archivos as $archivo)
				<tr>

					<td>{!! $archivo->nombre !!}</td>
					<td>{!! $archivo->ruta !!}</td>
					<td class="opc">
						<a class="btn btn-primary" href="{!! asset('leer_archivo/'.$archivo->ruta) !!}" role="button">Contenido</a>
						<a class="btn btn-primary" href="{!! asset('lenguaje_compatible/'.$archivo->id) !!}" role="button">Evaluar</a>
						{!! Form::open(['method'=>'DELETE','url'=>'/archivos/'.$archivo->id]) !!}
						<input class="btn btn-primary" type="submit" value="Eliminar">
						{!! Form::close() !!}
					</td>
				</tr>
				@endforeach
			</table>
		</div>
		<div class="opcnuevas">
			<a class="btn btn-primary" href="archivos/create" role="button">Subir un archivo</a>
			<a class="btn btn-primary" href="{!! asset('home') !!}" role="button">Regresar al home</a>
		</div>
	</div>
</body>

</html>