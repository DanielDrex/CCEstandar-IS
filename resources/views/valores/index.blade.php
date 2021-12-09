</body>

</html>

<html>

<head>
	<meta charset="utf-8">
	<title> Valores</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<link href="{{asset('estilo/css/base.css')}}" rel="stylesheet" />
</head>

<body>
	<div class="jumbotron-jumbotron-fluid">
		<div class="container">
			<h1 class="display-4">Control de calidad de estandares</h1>
			<p class="lead">Listado de valores </p>
		</div>
		<section class="img-intro">
			<figure>
				<img src="https://www.itmastersmag.com/wp-content/uploads/2021/01/shutterstock_1078387013-2048x1024.jpg" alt="CCE">
			</figure>
		</section>
		<div class="listado">
			@if($tipo == 0)
			<table>
				<tr>
					<th>Valor</th>
					<th>Tipo de valor</th>
					<th>Regla</th>
					<th>Opciones</th>
				</tr>
				@foreach($valores as $valor)
				<tr>
					<td>{!! $valor->valor !!}</td>
					<td> Constante </td>
					<td>{!! $valor->reglas->nombre !!}</td>
					<td class="opc">
						{!! Form::open(['method'=>'DELETE','url'=>'/valores/'.$valor->id]) !!}
						<input class="btn btn-primary" type="submit" value="Eliminar">
						{!! Form::close() !!}
					</td>
				</tr>
				@endforeach
			</table>
			@else
			<table>
				<tr>
					<th>Caracteres</th>
					<th>Tipo de valor</th>
					<th>Regla</th>
					<th>Opciones</th>
				</tr>
				@foreach($valores as $valor)
				<tr>
					@switch($valor->caracteres)
					@case(0)
					<td>Espacio</td>
					@break
					@case(1)
					<td>Letras</td>
					@break
					@case(2)
					<td>Numeros</td>
					@break
					@case(3)
					<td>Letras y numeros</td>
					@break
					@case(4)
					<td>Llaves</td>
					@break
					@case(5)
					<td>Parentesis</td>
					@case(6)
					<td>Corchetes</td>
					@break
					@case(7)
					<td>Todos</td>
					@break
					@endswitch
					<td> Variable </td>
					<td>{!! $valor->reglas->nombre !!}</td>
					<td class="opc">
						{!! Form::open(['method'=>'DELETE','url'=>'/valores/'.$valor->id]) !!}
						<input class="btn btn-primary" type="submit" value="Eliminar">
						{!! Form::close() !!}
					</td>
				</tr>
				@endforeach
			</table>
			@endif
		</div>
		<div class="opcnuevas">
			<a class="btn btn-primary" href="{!! asset('apartado_reglas/'.$id_apartado) !!}" role="button">Regresar a las reglas</a>
			<a class="btn btn-primary" href="{!! asset('home') !!}" role="button">Regresar al home</a>
		</div>
	</div>
</body>

</html>