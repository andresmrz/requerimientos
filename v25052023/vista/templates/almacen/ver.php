<div class="row">
	<div class="col-sm-12">
		<label class="subtitulo-subcontenedor">Ver Articulo</label>
	</div>
</div>

<div class="row">
	<div class="form-group col-sm-3">
		<label><b>Fecha</label>
		<input id="almacen-ver-fecha" type="date" value="<?php echo $view_almacen->fecha; ?>" class="form-control" placeholder="" readonly>
	</div>

	<div class="form-group col-sm-3">
		<label><b>Referencia del articulo</b></label>
		<input id="almacen-ver-referencia" type="number" value="<?php echo $view_almacen->referencia; ?>" onkeypress="return soloNumeros(event)" class="form-control" minlength="1" maxlength="14" placeholder="Digita la referencia (opcional)" readonly>
	</div>

	<div class="form-group col-sm-3">
		<label><b>Articulo </b></label>
		<input id="almacen-ver-nombre" type="text" value="<?php echo $view_almacen->nombre; ?>" class="form-control" minlength="1" maxlength="49" placeholder="Ejemplo: Lapicero" onkeyup="mayus(this)" readonly>
	</div>
</div>

<div class="row">
	<div class="form-group col-sm-3">
		<label><b>Cantidad </b></label>
		<input id="almacen-ver-cantidad" type="number" value="<?php echo $view_almacen->cantidad; ?>" class="form-control text-center" min="1" max="9999999" placeholder="" readonly>
	</div>
	
	<div class="form-group col-sm-3">
		<label><b>Precio </b></label>
		<input id="almacen-ver-precio" type="text" value="<?php echo $view_almacen->precio; ?>" class="form-control text-center" onkeypress="return soloNumeros(event)" minlength="1" maxlength="49" readonly>
	</div>

	<div class="form-group col-sm-3">
		<label><b>Fecha de Vencimiento</label>
		<input id="almacen-ver-fecha-vencimiento" type="date" value="<?php echo $view_almacen->fecha_vencimiento; ?>" class="form-control" placeholder="" readonly>
	</div>

	<div class="form-group col-sm-3">
		<label><b>Estado </b></label>
		<select id="almacen-ver-estado" class="form-control" readonly>
			<option value="" disabled>Seleccione ...</option>
			<option <?php echo ($view_almacen->estado == 1)?'selected':''; ?> value="1">Activo</option>
			<option <?php echo ($view_almacen->estado == 2)?'selected':''; ?> value="2">Inactivo</option>
		</select>
	</div>
</div>

<div class="row">
	<div class="col-sm-12">
		<label><b>Observaciones</b> </b></label>
		<textarea class="form-control" id="almacen-ver-observaciones" rows="4" placeholder="Observaciones" style="height: auto !important;" readonly><?php echo $view_almacen->observaciones; ?></textarea>
	</div>
</div>
<br>

<div class="row">
	<div class="col-sm-12">
		<center>
			<button type="button" class="btn btn-danger" onclick="cambiarSubcontenedor('almacen-contenedor', 1)"><span class="fas fa-times"></span><b>&nbsp;&nbsp;Volver</b></button>
		</center>
	</div>
</div>
