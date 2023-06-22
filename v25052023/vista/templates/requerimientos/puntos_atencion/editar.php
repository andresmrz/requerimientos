<?php
    include_once '../../modelo/fecha.php';

    $fecha = new Fecha();
?>

<div class="row">
	<div class="col-sm-12">
		<label class="subtitulo-subcontenedor">Editar Requerimiento</label>
	</div>
</div>

<form action="javascript: requerimientos_editar_confirmar(<?php echo $view_requerimientos->id; ?>)">
	<br>

	<div class="row">
		<div class="form-group col-sm-12">
			<label><b>Asunto </b><span class="text-danger hint--top hint--primary" data-hint="Campo obligatotio" style="cursor: pointer;">(*)</span></label>
			<select id="requerimientos-editar-opcion" class="form-control js-example-basic-single" style="height: 46.5px" required>
				<option value="" selected disabled>Seleccione el asunto</option>
				<?php 
					foreach($view_requerimientos->list_opciones as $lista)
					{
				?>
				<option <?php echo ($view_requerimientos->opcion == $lista['nombre'])?'selected':''; ?> value="<?php echo $lista['nombre']; ?>" title="<?php echo $lista['descripcion']; ?>"><?php echo $lista['nombre']; ?></option>
				<?php 
					}
				?>
			</select>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-12">
			<label><b>Descripción</b> </b><span class="text-danger hint--top hint--primary" data-hint="Campo obligatotio" style="cursor: pointer;">(*)</span></label>
			<textarea class="form-control" id="requerimientos-editar-descripcion" rows="4" placeholder="Descripción" style="height: auto !important;" required><?php echo $view_requerimientos->descripcion; ?></textarea>
		</div>
	</div>

    <div class="alert alert-success" id="requerimientos-editar-notificacion" style="display: none;">aviso</div>

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
<button type="button" class="btn btn-danger" onclick="cambiarSubcontenedor('requerimientos-contenedor', 1);" style="float: right">
	<span class="fas fa-times"></span>&nbsp;&nbsp;Cerrar
</button>
<br>

<script>
	$(document).ready(function() {
		$('.js-example-basic-single').select2();
	});
</script>