<?php
    include_once '../../modelo/fecha.php';

    $fecha = new Fecha();
?>

<div class="row">
	<div class="col-sm-12">
		<label class="subtitulo-subcontenedor">Crear Articulo</label>
	</div>
</div>

<form action="javascript: almacen_crear_confirmar()">
	<br>

	<div class="row">
		<div class="form-group col-sm-4">
			<label><b>Fecha</b></label>
			<input id="almacen-crear-fecha" type="date" value="<?php echo $fecha->formatoFecha('Y-m-d'); ?>" class="form-control" required>
		</div>

		<div class="form-group col-sm-4">
			<label><b>Referencia del articulo (opcional)</b></label>
			<input id="almacen-crear-referencia" type="number" value="" onkeypress="return soloNumeros(event)" class="form-control" minlength="1" maxlength="14" placeholder="Digita la referencia (opcional)">
		</div>

		<div class="form-group col-sm-4">
			<label><b>Articulo </b><span class="text-danger hint--top hint--primary" data-hint="Campo obligatotio" style="cursor: pointer;">(*)</span></label>
			<select id="almacen-crear-articulo" class="form-control js-example-basic-single" style="height: 46.5px" required>
				<option value="" selected disabled>Seleccione el articulo</option>
				<?php 
					foreach($view_almacen->articulos as $lista)
					{
				?>
				<option value="<?php echo $lista['id']; ?>"><?php echo $lista['nombre']; ?></option>
				<?php 
					}
				?>
			</select>
		</div>
	</div>

	<div class="row">
		<div class="form-group col-sm-4">
			<label><b>Cantidad </b><span class="text-danger hint--top hint--primary" data-hint="Campo obligatotio" style="cursor: pointer;">(*)</span></label>
			<input id="almacen-crear-cantidad" type="number" value="1" class="form-control text-center" min="1" max="9999999" placeholder="" required>
		</div>
		
		<div class="form-group col-sm-4">
			<label><b>Precio </b><span class="text-danger hint--top hint--primary" data-hint="Campo obligatotio" style="cursor: pointer;">(*)</span></label>
			<input id="almacen-crear-precio" type="text" value="" class="form-control text-center" onkeypress="return soloNumeros(event)" minlength="1" maxlength="49" required>
		</div>

		<div class="form-group col-sm-4">
			<label><b>Fecha de Vencimiento (opcional)</label>
			<input id="almacen-crear-fecha-vencimiento" type="date" value="" class="form-control" placeholder="">
		</div>
	</div>

	<div class="row">
		<div class="col-sm-12">
			<label><b>Observaciones</b> </b></label>
			<textarea class="form-control" id="almacen-crear-observaciones" rows="4" placeholder="Observaciones" style="height: auto !important;"></textarea>
		</div>
	</div>

	<button type="reset" id="almacen-crear-boton-reset" style="display: none"></button>
	<button type="submit" id="almacen-crear-boton-guardar" style="display: none"></button>
</form>

<div class="alert alert-success" id="almacen-crear-notificacion" style="display: none;">aviso</div>

<br>
<center>
	<button class="btn btn-warning" onclick="generarClick('almacen-crear-boton-reset')">
		<span class="glyphicon glyphicon-refresh"></span>&nbsp;&nbsp;Reset
	</button>

	<button class="btn btn-primary" onclick="generarClick('almacen-crear-boton-guardar')">
		<span class="glyphicon glyphicon-floppy-saved"></span>&nbsp;&nbsp;Guardar
	</button>
</center>

<br>
<button type="button" class="btn btn-danger" onclick="cambiarSubcontenedor('almacen-contenedor', 1);" style="float: right">
	<span class="fas fa-times"></span>&nbsp;&nbsp;Cerrar
</button>
<br>

<script>
	$(document).ready(function() {
		$('.js-example-basic-single').select2();
	});
</script>