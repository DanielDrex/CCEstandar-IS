<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<script type="text/javascript" src="http://code.jquery.com/jquery-3.5.1.js"></script>
	<title>Crear valor variable</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<link href="{{asset('estilo/css/base.css')}}" rel="stylesheet" />
	<link href="{{asset('estilo/css/base_form.css')}}" rel="stylesheet" />
</head>

<body>
	<div class="jumbotron-jumbotron-fluid">
		<div class="container">
			<h1 class="display-4">Control de calidad de estandares</h1>
			<p class="lead">Crear un valor </p>
		</div>
		<section class="img-intro">
			<figure>
				<img src="https://www.itmastersmag.com/wp-content/uploads/2021/01/shutterstock_1078387013-2048x1024.jpg" alt="CCE">
			</figure>
		</section>
		<div>
			{!! Form::open(['url'=>'/valores']) !!}

			{!! Form::hidden ('id_regla',$regla->id) !!}

			@if( $regla->tipo_regla == 0)

			{!! Form::hidden ('nombre','1CONSTANTE1') !!}

			{!! Form::hidden ('caracteres',99) !!}

			<div class="opciones">
				<div class="input-group mb-3">
					<span class="input-group-text" id="basic-addon1">Valor</span> &nbsp;
					<input type="text" class="form-control" placeholder="Valor" aria-label="Username" aria-describedby="basic-addon1" name="valor" id="validationCustom01" required>
				</div>
			</div>
			{!! Form::hidden ('tipo_valor',0) !!}
			@else
			<div class="opciones">
				<span class="input-group-text" id="basic-addon1">{!! Form::label ('caracteres','Caracteres permitidos') !!}</span> &nbsp;
				{!! Form::select ('caracteres',array('0'=>'Espacio','1'=>'Letras','2'=>'Numeros','3'=>'Letras y numeros','4'=>'Llaves {}','5'=>'Parentesis ()','6'=>'Corchetes []','7'=>'Todos los caracteres')) !!}
			</div>
			{!! Form::hidden ('valor','1VARIABLE1') !!}
			{!! Form::hidden ('tipo_valor', 1) !!}
			@endif
			{!! Form::hidden ('status',1) !!}

		</div>
	</div>
	<div class="opcnuevas">
		<input class="btn btn-primary" type="submit" value="Guardar valor">
		{!! Form::close() !!}
		<div class="input">
			<a class="btn btn-primary" href="{!! asset('home') !!}" role="button">Regresar al home</a>
		</div>
	</div>
	</div>
</body>
</html>