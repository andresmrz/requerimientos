<?php
    include_once '../../modelo/fecha.php';

    $fecha = new Fecha();
?>

<div class="row">
	<div class="col-sm-12">
		<label class="subtitulo-subcontenedor">Editar Opción de Sistemas</label>
	</div>
</div>

<form action="javascript: opciones_sistemas_editar_confirmar(<?php echo $view_opciones_sistemas->id; ?>, '<?php echo $view_opciones_sistemas->nombre; ?>')">
	<br>

	<div class="row">
		<div class="form-group col-sm-6">
			<label><b>Nombre </b><span class="text-danger hint--top hint--primary" data-hint="Campo obligatotio" style="cursor: pointer;">(*)</span></label>
			<input id="opciones-sistemas-editar-nombre" type="text" value="<?php echo $view_opciones_sistemas->nombre; ?>" onkeyup="mayus(this)" class="form-control" minlength="1" maxlength="50" placeholder="Nombre de la opción" required>
		</div>

		<div class="form-group col-sm-6">
			<label><b>Estado </b><span class="text-danger hint--top hint--primary" data-hint="Campo obligatotio" style="cursor: pointer;">(*)</span></label>
			<select id="opciones-sistemas-editar-estado" class="form-control" required>
				<option value="" disabled>Seleccione ...</option>
				<option <?php echo ($view_opciones_sistemas->estado == 1)?'selected':''; ?> value="1">Activo</option>
				<option <?php echo ($view_opciones_sistemas->estado == 2)?'selected':''; ?> value="2">Inactivo</option>
			</select>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-12">
			<label><b>Descripción </b><span class="text-danger hint--top hint--primary" data-hint="Campo obligatotio" style="cursor: pointer;">(*)</span></b></label>
			<textarea class="form-control" id="opciones-sistemas-editar-descripcion" rows="4" placeholder="Descripción" style="height: auto !important;" required><?php echo $view_opciones_sistemas->descripcion; ?></textarea>
		</div>
	</div>

    <div class="alert alert-success" id="opciones-sistemas-editar-notificacion" style="display: none;">aviso</div>

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
<button type="button" class="btn btn-danger" onclick="cambiarSubcontenedor('opciones-sistemas-contenedor', 1);" style="float: right">
	<span class="fas fa-times"></span>&nbsp;&nbsp;Cerrar
</button>
<br>

<script>
	$(document).ready(function() {
		$('.js-example-basic-single').select2();
	});
</script>