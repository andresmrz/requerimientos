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
		<label class="subtitulo-subcontenedor">Ver Requerimiento</label>
	</div>
</div>

<div class="row">
	<div class="form-group col-sm-6">
		<label><b>Fecha de creación </b></label>
		<input id="requerimientos-ver-fecha" type="text" value="<?php echo $fecha->fechaAndHora($view_requerimientos->fecha); ?>" class="form-control" readonly>
	</div>

	<div class="form-group col-sm-6">
		<label><b>Usuario que creo el requerimiento </b></label>
		<input id="requerimientos-ver-user-create" type="text" value="<?php echo $view_requerimientos->usuarios['id_'.$view_requerimientos->user_create]['nombre']; ?>" class="form-control" readonly>
	</div>
</div>

<div class="row">
	<div class="form-group col-sm-6">
		<label><b>Destinatario</b></label>
		<input id="requerimientos-ver-destinatario" type="text" value="<?php echo $view_requerimientos->modo; ?>" class="form-control" readonly>
	</div>

	<div class="form-group col-sm-6">
		<label><b>Asunto </b></label>
		<input id="requerimientos-ver-opcion" type="text" value="<?php echo $view_requerimientos->opcion; ?>" class="form-control" readonly>
	</div>
</div>

<?php
	if($view_requerimientos->opcion == 'COMPUTADOR' || $view_requerimientos->opcion == 'IMPRESORA')
	{
?>
<div class="row">
	<div class="form-group col-sm-6">
		<label><b>Cantidad</b></label>
		<input id="requerimientos-ver-cantidad" type="text" value="<?php echo $view_requerimientos->cantidad; ?>" class="form-control" readonly>
	</div>

	<div class="form-group col-sm-6">
		<label><b>Punto </b></label>
		<input id="requerimientos-ver-punto" type="text" value="<?php echo $view_requerimientos->punto; ?>" class="form-control" readonly>
	</div>
</div>
<?php
	}
?>

<div class="row">
	<div class="col-sm-12">
		<label><b>Descripción</b> </b></label>
		<textarea class="form-control" id="requerimientos-ver-descripcion" rows="4" style="height: auto !important;" readonly><?php echo $view_requerimientos->descripcion; ?></textarea>
	</div>
</div>

<br>
<center>
<?php
	if(($permisos == 1 && $view_requerimientos->estado == 0) || ($permisos == 2 && $view_requerimientos->estado == 0))
	{
?>
	<button class="btn btn-danger" onclick="requerimientos_cargar_rechazar(<?php echo $view_requerimientos->id; ?>)">
		<span class="fas fa-times"></span>&nbsp;&nbsp;Rechazar
	</button>
<?php
	}
	if(($permisos == 1 && $view_requerimientos->estado == 0) || ($permisos == 2 && $view_requerimientos->estado == 0))
	{
?>
	<button class="btn btn-primary" onclick="requerimientos_en_proceso_confirmar(<?php echo $view_requerimientos->id; ?>)">
		<span class="fas fa-spinner"></span>&nbsp;&nbsp;En Proceso
	</button>
<?php
	}
	if(($permisos == 1 && $view_requerimientos->estado == 0) || ($permisos == 1 && $view_requerimientos->estado == 3) || ($permisos == 2 && $view_requerimientos->estado == 0)
		|| ($permisos == 2 && $view_requerimientos->estado == 3))
	{
?>
	<button class="btn btn-success" onclick="requerimientos_cargar_procesar(<?php echo $view_requerimientos->id; ?>)">
		<span class="fas fa-check"></span>&nbsp;&nbsp;Procesar
	</button>
<?php
	}
?>
</center>
<br>

<div class="row">
	<div class="col-sm-12">
		<label class="subtitulo-subcontenedor">Seguimiento</label>
	</div>
</div>

<div class="row">
	<div class="form-group col-sm-6">
		<label><b>Fecha de actualización </b></label>
		<input id="requerimientos-ver-fecha-actualizacion" type="text" value="<?php echo ($view_requerimientos->fecha_solucion == '')?'No Aplica':$fecha->fechaAndHora($view_requerimientos->fecha_solucion); ?>" class="form-control" readonly>
	</div>

	<div class="form-group col-sm-6">
		<label><b>Estado</b></label>
		<input id="requerimientos-ver-estado" type="text" value="<?php echo (($view_requerimientos->estado == 3)?'En proceso':(($view_requerimientos->estado == 2)?'Rechazado':(($view_requerimientos->estado == 1)?'Procesado':'Registrado'))); ?>" class="form-control" readonly>
	</div>
</div>

<div class="row">
	<div class="col-sm-12">
		<label><b>Observaciones</b> </b></label>
		<textarea class="form-control" id="requerimientos-ver-observaciones" rows="4" style="height: auto !important;" readonly><?php echo ($view_requerimientos->observaciones_solucion == '')?'No Aplica':$view_requerimientos->observaciones_solucion; ?></textarea>
	</div>
</div>

<br>

<div class="row">
	<div class="col-sm-12">
		<center>
			<button type="button" class="btn btn-danger" onclick="cambiarSubcontenedor('requerimientos-contenedor', 1)"><span class="fas fa-times"></span><b>&nbsp;&nbsp;Volver</b></button>
		</center>
	</div>
</div>
