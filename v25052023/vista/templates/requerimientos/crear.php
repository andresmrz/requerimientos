<?php
    include_once '../../modelo/fecha.php';
	include_once '../../modelo/usuario.php';

	$fecha = new Fecha();
	$claseUsuario = new Usuario();
	$usuario = '';
	$permisos = '';

    if(isset($_SESSION['requerimientos_usuario']))
    {
        $usuario = $_SESSION['requerimientos_usuario'];
        $permisos = intval($claseUsuario->getPermisos($usuario));
    }
?>

<div class="row">
	<div class="col-sm-12">
		<label class="subtitulo-subcontenedor">Generar Requerimiento</label>
	</div>
</div>

<form action="javascript: requerimientos_crear_confirmar()">
	<br>

	<div class="row">
		<div class="form-group col-sm-12">
			<label><b>Destinatario </b><span class="text-danger hint--top hint--primary" data-hint="Campo obligatotio" style="cursor: pointer;">(*)</span></label>
			<select id="requerimientos-crear-destinatario" class="form-control" style="height: 46.5px" onchange="requerimientos_destinatario(this.value)" required>
				<option value="" selected disabled>Seleccione el destinatario</option>
				<option <?php echo ($permisos == 2)?'style="display: none"':''; ?> value="sistemas">Sistemas</option>
				<!--<option <?php echo ($permisos == 3)?'style="display: none"':''; ?> value="campo">Campo</option>
				<option <?php echo ($permisos == 4)?'style="display: none"':''; ?> value="puntos_atencion">Puntos de atención</option>-->
				<option <?php echo ($permisos == 5)?'style="display: none"':''; ?> value="almacen">Almacen</option>
			</select>
		</div>
	</div>

	<span id="requerimientos-crear-datos"></span>

	<button type="reset" id="requerimientos-crear-boton-reset" style="display: none"></button>
	<button type="submit" id="requerimientos-crear-boton-guardar" style="display: none"></button>
</form>

<div class="alert alert-success" id="requerimientos-crear-notificacion" style="display: none;">aviso</div>

<br>
<center>
	<button class="btn btn-warning" onclick="generarClick('requerimientos-crear-boton-reset')">
		<span class="glyphicon glyphicon-refresh"></span>&nbsp;&nbsp;Reset
	</button>

	<button class="btn btn-primary" onclick="generarClick('requerimientos-crear-boton-guardar')">
		<span class="glyphicon glyphicon-floppy-saved"></span>&nbsp;&nbsp;Guardar
	</button>
</center>

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