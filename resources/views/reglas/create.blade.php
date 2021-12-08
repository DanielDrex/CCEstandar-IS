<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<script type="text/javascript" src="http://code.jquery.com/jquery-3.5.1.js"></script>
	<title>Crear regla</title>
</head>

<body>

	<script>
		function cargar_estandares(id_lenguaje) {
			
			$("#id_estandar").empty();
			$("#id_apartado").empty();
			
			var ruta = "{{ asset('buscar_estandar') }}/"+id_lenguaje;
			
			
			$.ajax({
				type:'GET',
				url:ruta,

				success:function(data){

					var estandares = data;
					
					$('#id_estandar').append('<option>Seleccionar estandar</option>');

					for (var i = 0; i < estandares.length; i++) {

						$('#id_estandar').append('<option value="'+estandares[i].id+'">'
							+estandares[i].nombre+'</option>');
					}
					
				}
			});


		}

	</script>

	<script>
		function cargar_apartados(id_estandar) {
			
			

			$("#id_apartado").empty();
			

			var ruta = "{{ asset('buscar_apartado') }}/"+id_estandar;
			

			
			$.ajax({
				type:'GET',
				url:ruta,

				success:function(data){

					var apartados = data;
					

					for (var i = 0; i < apartados.length; i++) {

						$('#id_apartado').append('<option value="'+apartados[i].id+'">'
							+apartados[i].nombre+'</option>');

					}
					
				}
			});
		}

	</script>

	<h1>Crear una regla</h1>


	{!! Form::label ('id_lenguaje','Lenguaje') !!}
	{!! Form::select ('id_lenguaje',$lenguajes->pluck('nombre','id')->all(),null,
	['placeholder'=>'Seleccionar','class'=>'form-control','onchange'=>
	'cargar_estandares(this.value);','required']) !!}

	<br>
	<br>

	{!! Form::label ('id_estandar','Estandar') !!}
	{!! Form::select ('id_estandar',array(''=>''),'null'
	,['class'=>'form-control','onchange'=>
	'cargar_apartados(this.value);','required']) !!}

	<br>
	<br>

	{!! Form::open(['url'=>'/reglas']) !!}

	{!! Form::label ('id_apartado','Apartado') !!}
	{!! Form::select ('id_apartado',array(''=>''),null
	,['class'=>'form-control','required']) !!}

	<br>
	<br>

	{!! Form::label ('nombre','Nombre') !!}
	{!! Form::text ('nombre',null,['placeholder'=>'Nombre','required']) !!}

	<br>
	<br>

	{!! Form::label ('tipo_regla','Tipo de los valores') !!}
	{!! Form::select ('tipo_regla',array('0'=>'Constantes','1'=>'Variables'),null) !!}

	<br>
	<br>

	{!! Form::label ('posicion','Posicion') !!}
	{!!Form::selectRange('posicion', 1, 50)!!}

	<br>
	<br>

	{!! Form::hidden ('status',1) !!}

	{!! Form::submit('Guardar regla') !!}
	{!! Form::close() !!}
	<a href="{!! asset('home') !!}">Regresar al home</a>
</body>

</html>
