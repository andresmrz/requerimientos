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
	<div class="row">
		<div class="form-group col-sm-6">
			<label><b>Articulo </b><span class="text-danger hint--top hint--primary" data-hint="Campo obligatotio" style="cursor: pointer;">(*)</span></label>
			<select id="requerimientos-editar-articulo" class="form-control js-example-basic-single" style="height: 46.5px">
				<option value="" selected disabled>Seleccione la opción</option>
				<?php 
					foreach($view_requerimientos->list_opciones as $lista)
					{
				?>
				<option value="<?php echo $lista['id']; ?>" title="<?php echo $lista['nombre']; ?>"><?php echo $lista['nombre']; ?></option>
				<?php 
					}
				?>
			</select>
		</div>

		<div class="form-group col-sm-6">
			<label><b>Cantidad </b><span class="text-danger hint--top hint--primary" data-hint="Campo obligatotio" style="cursor: pointer;">(*)</span></label>
			<input id="requerimientos-editar-articulo-cantidad" type="number" value="1" class="form-control text-center" min="1" max="9999999" placeholder="">
		</div>
	</div>

	<div class="row">
		<div class="form-group col-sm-12">
			<label><b>Lista de Articulos </b><span class="text-danger hint--top hint--primary" data-hint="Campo obligatotio" style="cursor: pointer;">(*)</span></label>
			<div class="alert alert-danger" style="background: white;" id="requerimientos-editar-articulo-contenedor-lista">No se han agregado articulos.<br></div>
			<input type="text" value="" id="requerimientos-editar-articulo-lista" style="display: none">
		</div>
	</div>

	<center>
		<button type="button" class="btn btn-danger" onclick="requerimientos_eliminar_articulo('editar')">
			<span class="glyphicon glyphicon-trash"></span>&nbsp;&nbsp;Eliminar Ultimo
		</button>

		<button type="button" class="btn btn-primary" onclick="requerimientos_agregar_articulo('editar')">
			<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;Agregar Articulo
		</button>
	</center>

	<hr>

	<div class="row">
		<div class="col-sm-12">
			<label><b>Descripción</b> </b><span class="text-danger hint--top hint--primary" data-hint="Campo obligatotio" style="cursor: pointer;">(*)</span></label>
			<textarea class="form-control" id="requerimientos-editar-descripcion" rows="4" placeholder="Descripción" style="height: auto !important;" required><?php echo $view_requerimientos->descripcion; ?></textarea>
		</div>
	</div>

	<input id="requerimientos-editar-modo" type="text" value="<?php echo $view_requerimientos->modo; ?>" style="display: none">

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

	requerimientos_actualizar_articulo('<?php echo $view_requerimientos->data_articulos; ?>');
</script>