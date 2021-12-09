<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title> Editar_estandar </title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<link href="{{asset('estilo/css/base.css')}}" rel="stylesheet" />
	<link href="{{asset('estilo/css/base_form.css')}}" rel="stylesheet" />
</head>

<body>
	<div class="jumbotron-jumbotron-fluid">
		<div class="container">
			<h1 class="display-4">Control de calidad de estandares</h1>
			<p class="lead">Edicion de estandares </p>
		</div>
		<section class="img-intro">
			<figure>
				<img src="https://www.itmastersmag.com/wp-content/uploads/2021/01/shutterstock_1078387013-2048x1024.jpg" alt="CCE">
			</figure>
		</section>
		<div>
			{!! Form::open(['method'=>'PATCH','url'=>'/estandares/'.$estandar->id]) !!}

			<div class="opciones">
				<span class="input-group-text" id="basic-addon1">Lenguaje</span> &nbsp; &nbsp;
				{!! Form::select ('id_lenguaje', $lenguajes->pluck('nombre','id')->all(),$estandar->id_lenguaje) !!}
			</div>
			{!! Form::open(['method'=>'PATCH','url'=>'/estandares/'.$estandar->id]) !!}
			<div class="opciones">
				<div class="input-group mb-3">
					<span class="input-group-text" id="basic-addon1">Nombre</span>
					<input type="text" class="form-control" placeholder="Nombre del estandar" aria-label="Username" aria-describedby="basic-addon1" name="nombre" id="validationCustom01" required value="{!! $estandar->nombre!!}">
				</div>
			</div>
		</div>
		<div class="opcnuevas">
			<input class="btn btn-primary" type="submit" value="Guardar editado">
			{!! Form::close() !!}
			<div class="input">
				<a class="btn btn-primary" href="{!! asset('home') !!}" role="button">Regresar al home</a>
			</div>
		</div>
	</div>
</body>
</html>