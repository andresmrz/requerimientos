<div class="row">
	<div class="col-sm-12">
		<label class="subtitulo-subcontenedor">Ver Opción de Puntos de Atención</label>
	</div>
</div>

<div class="row">
	<div class="form-group col-sm-6">
		<label><b>Nombre </b></label>
		<input id="opciones-puntos-atencion-ver-nombre" type="text" value="<?php echo $view_opciones_puntos_atencion->nombre; ?>" onkeyup="mayus(this)" class="form-control" minlength="1" maxlength="50" placeholder="Nombre de la opción" readonly>
	</div>

	<div class="form-group col-sm-6">
		<label><b>Estado </b></label>
		<select id="opciones-puntos-atencion-ver-estado" class="form-control" readonly>
			<option value="" disabled>Seleccione ...</option>
			<option <?php echo ($view_opciones_puntos_atencion->estado == 1)?'selected':''; ?> value="1">Activo</option>
			<option <?php echo ($view_opciones_puntos_atencion->estado == 2)?'selected':''; ?> value="2">Inactivo</option>
		</select>
	</div>
</div>

<div class="row">
	<div class="col-sm-12">
		<label><b>Descripción </b></b></label>
		<textarea class="form-control" id="opciones-puntos-atencion-ver-descripcion" rows="4" placeholder="Descripción" style="height: auto !important;" readonly><?php echo $view_opciones_puntos_atencion->descripcion; ?></textarea>
	</div>
</div>
<br>

<div class="row">
	<div class="col-sm-12">
		<center>
			<button type="button" class="btn btn-danger" onclick="cambiarSubcontenedor('opciones-puntos-atencion-contenedor', 1)"><span class="fas fa-times"></span><b>&nbsp;&nbsp;Volver</b></button>
		</center>
	</div>
</div>
