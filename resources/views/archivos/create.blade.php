<!DOCTYPE html>
<html><head>
<meta charset="utf-8">
<title>Insertar archivo</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<link href="{{asset('estilo/css/base.css')}}" rel="stylesheet" />
<link href="{{asset('estilo/css/base_form.css')}}" rel="stylesheet" />
</head><body>
<div class="jumbotron-jumbotron-fluid">
<div class="container">
<h1 class="display-4">Control de calidad de estandares</h1>
<p class="lead">Subir un archivo </p>
</div>
<section class="img-intro">
<figure>
<img src="https://www.itmastersmag.com/wp-content/uploads/2021/01/shutterstock_1078387013-2048x1024.jpg" alt="CCE">
</figure>
</section>
<div >
{!! Form::open(['url'=>'/archivos','enctype'=>'multipart/form-data','class'=>'contactForm']) !!}
<div class="opciones">
<div class="input-group mb-3">
<span class="input-group-text" id="basic-addon1">Nombre</span>
<input type="text" class="form-control" placeholder="Nombre de registro" aria-label="Username" aria-describedby="basic-addon1" name="nombre" id="validationCustom01" required>
</div>
</div>
{!! Form::hidden('ruta','defo') !!}
<div class="opciones">
<div class="input-group mb-3">
<input type="file" class="form-control" id="inputGroupFile02" required name="archiv">
<label class="input-group-text" for="inputGroupFile02">Archivo</label>
</div>
</div>
{!! Form::hidden ('status',1) !!}
</div> <div class="opcnuevas">
<input class="btn btn-primary" type="submit" value="Subir archivo">
{!! Form::close() !!}
</div>
</div>
</body>
</html>

