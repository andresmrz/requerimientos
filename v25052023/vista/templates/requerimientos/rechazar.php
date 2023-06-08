<?php
    include_once '../../modelo/fecha.php';

    $fecha = new Fecha();
?>

<div class="row">
	<div class="col-sm-12">
		<label class="subtitulo-subcontenedor">Rechazar Requerimiento</label>
	</div>
</div>

<div class="row">
    <div class="form-group col-sm-6">
        <label><b>Asunto </b></label>
        <input id="requerimientos-rechazar-asunto" type="text" value="<?php echo $view_requerimientos->asunto; ?>" class="form-control" placeholder="Digite el asunto" minlength="1" maxlength="49" readonly>
    </div>

    <div class="form-group col-sm-6">
        <label><b>Opción </b></label>
        <input id="requerimientos-ver-opcion" type="text" value="<?php echo $view_requerimientos->opcion; ?>" class="form-control" readonly>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <label><b>Descripción</b> </b></label>
        <textarea class="form-control" id="requerimientos-rechazar-descripcion" rows="4" placeholder="Descripción" style="height: auto !important;" readonly><?php echo $view_requerimientos->descripcion; ?></textarea>
    </div>
</div>

<form action="javascript: requerimientos_rechazar_confirmar(<?php echo $view_requerimientos->id; ?>)">
	<br>

	<div class="row">
        <div class="col-sm-12">
            <label><b>Observaciones</b> </b><span class="text-danger hint--top hint--primary" data-hint="Campo obligatotio" style="cursor: pointer;">(*)</span></label>
            <textarea class="form-control" id="requerimientos-rechazar-observaciones" rows="4" placeholder="Observaciones" style="height: auto !important;" required></textarea>
        </div>
    </div>

    <div class="alert alert-success" id="requerimientos-rechazar-notificacion" style="display: none;">aviso</div>

    <br>
    <center>
        <button type="reset" class="btn btn-warning">
            <span class="glyphicon glyphicon-refresh"></span>&nbsp;&nbsp;Reset
        </button>

        <button type="submit" class="btn btn-danger">
            <span class="fas fa-times"></span>&nbsp;&nbsp;Rechazar
        </button>
    </center>
</form>

<br>
<button type="button" class="btn btn-danger" onclick="cambiarSubcontenedor('requerimientos-contenedor', 2);" style="float: right">
	<span class="fas fa-times"></span>&nbsp;&nbsp;Cerrar
</button>
<br>