<?php
    include_once '../../modelo/fecha.php';

    $fecha = new Fecha();
?>

<div class="row">
	<div class="col-sm-12">
		<label class="subtitulo-subcontenedor">Editar Articulos de Almacen</label>
	</div>
</div>

<form action="javascript: almacen_editar_confirmar(<?php echo $view_almacen->id; ?>)">
	<br>

	<div class="row">
		<div class="form-group col-sm-4">
			<label><b>Fecha</b></label>
			<input id="almacen-editar-fecha" type="date" value="<?php echo $view_almacen->fecha; ?>" class="form-control" required>
		</div>

		<div class="form-group col-sm-4">
			<label><b>Referencia del articulo (opcional)</b></label>
			<input id="almacen-editar-referencia" type="number" value="<?php echo $view_almacen->referencia; ?>" onkeypress="return soloNumeros(event)" class="form-control" minlength="1" maxlength="14" placeholder="Digita la referencia (opcional)">
		</div>

		<div class="form-group col-sm-4">
			<label><b>Articulo </b><span class="text-danger hint--top hint--primary" data-hint="Campo obligatotio" style="cursor: pointer;">(*)</span></label>
			<input id="almacen-editar-nombre" type="text" value="<?php echo $view_almacen->nombre; ?>" class="form-control" readonly>
			<input id="almacen-editar-articulo" type="text" value="<?php echo $view_almacen->articulo; ?>" style="display: none">
		</div>
	</div>

	<div class="row">
		<div class="form-group col-sm-3">
			<label><b>Cantidad </b><span class="text-danger hint--top hint--primary" data-hint="Campo obligatotio" style="cursor: pointer;">(*)</span></label>
			<input id="almacen-editar-cantidad" type="number" value="<?php echo $view_almacen->cantidad; ?>" class="form-control text-center" min="1" max="999999999" placeholder="" required>
		</div>

		<div class="form-group col-sm-3">
			<label><b>Precio </b><span class="text-danger hint--top hint--primary" data-hint="Campo obligatotio" style="cursor: pointer;">(*)</span></label>
			<input id="almacen-editar-precio" type="text" value="<?php echo $view_almacen->precio; ?>" class="form-control text-center" onkeypress="return soloNumeros(event)" minlength="1" maxlength="49" required>
		</div>

		<div class="form-group col-sm-3">
			<label><b>Fecha de Vencimiento (opcional)</label>
			<input id="almacen-editar-fecha-vencimiento" type="date" value="<?php echo $view_almacen->fecha_vencimiento; ?>" class="form-control" placeholder="">
		</div>

		<div class="form-group col-sm-3">
			<label><b>Estado </b><span class="text-danger hint--top hint--primary" data-hint="Campo obligatotio" style="cursor: pointer;">(*)</span></label>
			<select id="almacen-editar-estado" class="form-control" required>
				<option value="" disabled>Seleccione ...</option>
				<option <?php echo ($view_almacen->estado == 1)?'selected':''; ?> value="1">Activo</option>
				<option <?php echo ($view_almacen->estado == 2)?'selected':''; ?> value="2">Inactivo</option>
			</select>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-12">
			<label><b>Observaciones</b> </b></label>
			<textarea class="form-control" id="almacen-editar-observaciones" rows="4" placeholder="Observaciones" style="height: auto !important;"><?php echo $view_almacen->observaciones; ?></textarea>
		</div>
	</div>

    <div class="alert alert-success" id="almacen-editar-notificacion" style="display: none;">aviso</div>

    <br>
    <center>
        <button type="reset" class="btn btn-warning">
            <span class="glyphicon glyphicon-refresh"></span>&nbsp;&nbsp;Reset
        </button>

        <button type="submit" class="btn btn-primary">
            <span class="glyphicon glyphicon-floppy-saved"></span>&nbsp;&nbsp;Guardar
        </button>
    </center>
</form>

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