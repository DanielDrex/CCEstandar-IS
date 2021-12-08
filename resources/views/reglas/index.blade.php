<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Reglas</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<link href="{{asset('estilo/css/base.css')}}" rel="stylesheet" />
</head>

<body>
	<div class="jumbotron-jumbotron-fluid">
		<div class="container">
			<h1 class="display-4">Control de calidad de estandares</h1>
			<p class="lead">Listado de reglas </p>
		</div>
		<section class="img-intro">
			<figure>
				<img src="https://www.itmastersmag.com/wp-content/uploads/2021/01/shutterstock_1078387013-2048x1024.jpg" alt="CCE">
			</figure>
		</section>
		<div class="listado">
			<table>
				<tr>
					<th>Regla</th>
					<th>Apartado</th>
					<th>Tipo de regla</th>
					<th>Posicion</th>
					<th colspan="2">Opciones</th>
				</tr>
				@foreach($reglas as $regla)
				<tr>
					<td>{!! $regla->nombre !!}</td>
					<td>{!! $regla->apartados->nombre !!}</td>
					@if($regla->tipo_regla == 0)

					<td>Constante</td>
					
					@else
					
					<td>Variable</td>
					
					@endif
					<td>{!! $regla->posicion !!}</td>
					<td class="opc">
						<div class="col-6 col-sm-3">
							<a class="btn btn-primary" href="{!! asset('reglas/'.$regla->id.'/edit') !!}" role="button">Editar</a>
						</div>
						<div class="w-100"></div>
						<div class="col-6 col-sm-3">
							<a class="btn btn-primary" href="{!! asset('regla_valor/'.$regla->id) !!}" role="button">Ver valores</a>
						</div>
					</td>

					<td class="opc">
						<div class="col-6 col-sm-3">
							<a class="btn btn-primary" href="{!! asset('especifico/'.$regla->id) !!}" role="button">Agregar valor</a>
						</div>
						<div class="w-100"></div>
						<div class="col-6 col-sm-3">
							{!! Form::open(['method'=>'DELETE','url'=>'/reglas/'.$regla->id]) !!}
							<input class="btn btn-primary" type="submit" value="Eliminar">
							{!! Form::close() !!}
						</div>
					</td>
				</tr>
				@endforeach
			</table>
		</div>
		<div class="opcnuevas">
			<a class="btn btn-primary" href="{!! asset('reglas/create') !!}" role="button">Crear una regla</a>
			<!-- <a class="btn btn-primary" {!! asset('usuarios_eliminados') !!}" role="button">ver eliminados</a> -->
			<a class="btn btn-primary" href="{!! asset('home') !!}" role="button">Regresar al home</a>
		</div>
	</div>
</body>

</html>