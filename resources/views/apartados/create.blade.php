<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<script type="text/javascript" src="http://code.jquery.com/jquery-3.5.1.js"></script>
	<title>Crear apartado</title>
</head>

<body>


	<script>
		function cargar_estandares(id_lenguaje) {
			

			$("#id_estandar").empty();
			

			var ruta = "{{ asset('buscar_estandar') }}/"+id_lenguaje;
			
			
			$.ajax({
				type:'GET',
				url:ruta,

				success:function(data){

					var estandares = data;
					

					for (var i = 0; i < estandares.length; i++) {

						$('#id_estandar').append('<option value="'+estandares[i].id+'">'
							+estandares[i].nombre+'</option>');
					}
					
				}
			});
		}

	</script>

	<h1>Crear un apartado</h1>

	{!! Form::label ('id_lenguaje','Lenguaje') !!}
	{!! Form::select ('id_lenguaje',$lenguajes->pluck('nombre','id')->all(),null,
	['placeholder'=>'Seleccionar','class'=>'form-control','onchange'=>
	'cargar_estandares(this.value);','required']) !!}

	<br>
	<br>

	{!! Form::open(['url'=>'/apartados']) !!}

	{!! Form::label ('id_estandar','Estandar') !!}
	{!! Form::select ('id_estandar',array(''=>'Seleccionar'),null
	,['class'=>'form-control','required']) !!}


	<br>
	<br>

	{!! Form::label ('nombre','Nombre') !!}
	{!! Form::text ('nombre',null,['placeholder'=>'Nombre','required']) !!}

	<br>
	<br>

	{!! Form::hidden ('status',1) !!}

	{!! Form::submit('Guardar apartado') !!}
	{!! Form::close() !!}

</body>

</html>
