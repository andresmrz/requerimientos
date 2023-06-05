<?php
    include_once '../../modelo/fecha.php';

    $fecha = new Fecha();
?>

<div class="row">
	<div class="col-sm-12">
		<label class="subtitulo-subcontenedor">Crear Opción de Sistemas</label>
	</div>
</div>

<form action="javascript: opciones_sistemas_crear_confirmar()">
	<br>

	<div class="row">
		<div class="form-group col-sm-12">
			<label><b>Nombre </b><span class="text-danger hint--top hint--primary" data-hint="Campo obligatotio" style="cursor: pointer;">(*)</span></label>
			<input id="opciones-sistemas-crear-nombre" type="text" value="" onkeyup="mayus(this)" class="form-control" minlength="1" maxlength="50" placeholder="Nombre de la opción" required>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-12">
			<label><b>Descripción </b><span class="text-danger hint--top hint--primary" data-hint="Campo obligatotio" style="cursor: pointer;">(*)</span></b></label>
			<textarea class="form-control" id="opciones-sistemas-crear-descripcion" rows="4" placeholder="Descripción" style="height: auto !important;" required></textarea>
		</div>
	</div>

	<button type="reset" id="opciones-sistemas-crear-boton-reset" style="display: none"></button>
	<button type="submit" id="opciones-sistemas-crear-boton-guardar" style="display: none"></button>
</form>

<div class="alert alert-success" id="opciones-sistemas-crear-notificacion" style="display: none;">aviso</div>

<br>
<center>
	<button class="btn btn-warning" onclick="generarClick('opciones-sistemas-crear-boton-reset')">
		<span class="glyphicon glyphicon-refresh"></span>&nbsp;&nbsp;Reset
	</button>

	<button class="btn btn-primary" onclick="generarClick('opciones-sistemas-crear-boton-guardar')">
		<span class="glyphicon glyphicon-floppy-saved"></span>&nbsp;&nbsp;Guardar
	</button>
</center>

<br>
<button type="button" class="btn btn-danger" onclick="cambiarSubcontenedor('opciones-sistemas-contenedor', 1);" style="float: right">
	<span class="fas fa-times"></span>&nbsp;&nbsp;Cerrar
</button>
<br>

<script>
	$(document).ready(function() {
		$('.js-example-basic-single').select2();
	});
</script>