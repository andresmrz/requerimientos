<?php
    include_once '../../modelo/fecha.php';

    $fecha = new Fecha();
?>

<div class="row">
	<div class="col-sm-12">
		<label class="subtitulo-subcontenedor">Editar Opción de Puntos de Atención</label>
	</div>
</div>

<form action="javascript: opciones_puntos_atencion_editar_confirmar(<?php echo $view_opciones_puntos_atencion->id; ?>, '<?php echo $view_opciones_puntos_atencion->nombre; ?>')">
	<br>

	<div class="row">
		<div class="form-group col-sm-6">
			<label><b>Nombre </b><span class="text-danger hint--top hint--primary" data-hint="Campo obligatotio" style="cursor: pointer;">(*)</span></label>
			<input id="opciones-puntos-atencion-editar-nombre" type="text" value="<?php echo $view_opciones_puntos_atencion->nombre; ?>" onkeyup="mayus(this)" class="form-control" minlength="1" maxlength="50" placeholder="Nombre de la opción" required>
		</div>

		<div class="form-group col-sm-6">
			<label><b>Estado </b><span class="text-danger hint--top hint--primary" data-hint="Campo obligatotio" style="cursor: pointer;">(*)</span></label>
			<select id="opciones-puntos-atencion-editar-estado" class="form-control" required>
				<option value="" disabled>Seleccione ...</option>
				<option <?php echo ($view_opciones_puntos_atencion->estado == 1)?'selected':''; ?> value="1">Activo</option>
				<option <?php echo ($view_opciones_puntos_atencion->estado == 2)?'selected':''; ?> value="2">Inactivo</option>
			</select>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-12">
			<label><b>Descripción </b><span class="text-danger hint--top hint--primary" data-hint="Campo obligatotio" style="cursor: pointer;">(*)</span></b></label>
			<textarea class="form-control" id="opciones-puntos-atencion-editar-descripcion" rows="4" placeholder="Descripción" style="height: auto !important;" required><?php echo $view_opciones_puntos_atencion->descripcion; ?></textarea>
		</div>
	</div>

    <div class="alert alert-success" id="opciones-puntos-atencion-editar-notificacion" style="display: none;">aviso</div>

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
<button type="button" class="btn btn-danger" onclick="cambiarSubcontenedor('opciones-puntos-atencion-contenedor', 1);" style="float: right">
	<span class="fas fa-times"></span>&nbsp;&nbsp;Cerrar
</button>
<br>

<script>
	$(document).ready(function() {
		$('.js-example-basic-single').select2();
	});
</script>