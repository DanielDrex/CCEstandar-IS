<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<script type="text/javascript" src="http://code.jquery.com/jquery-3.5.1.js"></script>
	<title>Crear regla</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<link href="{{asset('estilo/css/base.css')}}" rel="stylesheet" />
	<link href="{{asset('estilo/css/base_form.css')}}" rel="stylesheet" />
</head>

<body>
	<script>
		function cargar_estandares(id_lenguaje) {
			$("#id_estandar").empty();
			$("#id_apartado").empty();
			var ruta = "{{ asset('buscar_estandar') }}/" + id_lenguaje;
			$.ajax({
				type: 'GET',
				url: ruta,
				success: function(data) {
					var estandares = data;
					$('#id_estandar').append('<option>Seleccionar estandar</option>');
					for (var i = 0; i < estandares.length; i++) {
						$('#id_estandar').append('<option value="' + estandares[i].id + '">' +
							estandares[i].nombre + '</option>');
					}
				}
			});
		}
	</script>
	<script>
		function cargar_apartados(id_estandar) {
			$("#id_apartado").empty();
			var ruta = "{{ asset('buscar_apartado') }}/" + id_estandar;
			$.ajax({
				type: 'GET',
				url: ruta,
				success: function(data) {
					var apartados = data;
					for (var i = 0; i < apartados.length; i++) {
						$('#id_apartado').append('<option value="' + apartados[i].id + '">' +
							apartados[i].nombre + '</option>');
					}
				}
			});
		}
	</script>

	<div class="jumbotron-jumbotron-fluid">
		<div class="container">
			<h1 class="display-4">Control de calidad de estandares</h1>
			<p class="lead">Crear una regla </p>
		</div>
		<section class="img-intro">
			<figure>
				<img src="https://www.itmastersmag.com/wp-content/uploads/2021/01/shutterstock_1078387013-2048x1024.jpg" alt="CCE">
			</figure>
		</section>
		<div>
			<div class="opciones">
				<span class="input-group-text" id="basic-addon1">Lenguaje</span> &nbsp;
				<div class="opc_apartado">
					{!! Form::select ('id_lenguaje',$lenguajes->pluck('nombre','id')->all(),null,
					['placeholder'=>'Seleccionar','class'=>'form-control','onchange'=>
					'cargar_estandares(this.value);','required']) !!}
				</div>
			</div>
			<div class="opciones">
				<span class="input-group-text" id="basic-addon1">{!! Form::label ('id_estandar','Estandar') !!}</span> &nbsp;
				<div class="opc_apartado">
					{!! Form::select ('id_estandar',array(''=>''),'null'
					,['class'=>'form-control','onchange'=>
					'cargar_apartados(this.value);','required']) !!}
				</div>
			</div>
			{!! Form::open(['url'=>'/reglas']) !!}
			<div class="opciones">
				<span class="input-group-text" id="basic-addon1">{!! Form::label ('id_apartado','Apartado') !!}</span> &nbsp;
				<div class="opc_apartado">
					{!! Form::select ('id_apartado',array(''=>''),null
					,['class'=>'form-control','required']) !!}
				</div>
			</div>
			<div class="opciones">
				<div class="input-group mb-3">
					<span class="input-group-text" id="basic-addon1">Nombre</span> &nbsp;
					<input type="text" class="form-control" placeholder="Nombre" aria-label="Username" aria-describedby="basic-addon1" name="nombre" id="validationCustom01" required>
				</div>
			</div>

			<div class="opciones">
				<span class="input-group-text" id="basic-addon1">Tipo de valores</span> &nbsp;
				{!! Form::select ('tipo_regla',array('0'=>'Constantes','1'=>'Variables'),null) !!}
			</div>
			<div class="opciones">
				<span class="input-group-text" id="basic-addon1">Posicion</span> &nbsp;
				{!!Form::selectRange('posicion', 1, 50)!!}
			</div>
			{!! Form::hidden ('status',1) !!}
		</div>
	</div>
	<div class="opcnuevas">
		<input class="btn btn-primary" type="submit" value="Guardar regla">
		{!! Form::close() !!}
		<div class="input">
			<a class="btn btn-primary" href="{!! asset('home') !!}" role="button">Regresar al home</a>
		</div>
	</div>
	</div>
</body>
</html>