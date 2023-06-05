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

<!-- //////////////// Estilos /////////////// -->

<link rel="stylesheet" type="text/css" href="../css/usuarios.css">

<link href="../css/select2.min.css" rel="stylesheet" />

<script type="text/javascript" src="../js/functionOpcionesCampo.js"></script>
<script type="text/javascript" src="../lb/generarExcel/js/generarExcel.js"></script>
<script src="../js/select2.min.js"></script>

<div class="row">
	<div class="col-sm-12">
		<label class="titulo-subcontenedor">Administrar Opciones de Campo</label>
	</div>
</div>

<div class="btn-group btn-group-toggle" data-toggle="buttons">

	<label class="btn btn-default" onclick="opciones_campo_cargarIndex()">
    	<input type="radio" autocomplete="off"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;Inicio
  	</label>
	
	<?php 
		if($permisos == 1)
		{
	?>
  	<label class="btn btn-default" onclick="opciones_campo_cargar_crear()">
    	<input type="radio" autocomplete="off"><span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;Crear
  	</label>
  	<?php
  		}
  	?>

</div>
<br>
<br>

<span id="opciones-campo-contenedor-1">
	<div class="row">
		<div class="form-group col-sm-3">
			<div class="input-group">
				<span class="input-group-addon"><b>Cantidad registros</b></span>
				<input type="text" class="form-control text-center" value="0" id="opciones-campo-tabla-total" readonly>
			</div>
		</div>
		<div class="col-sm-5"></div>
		<div class="form-group col-sm-4">
			<div class="input-group">
				<span class="input-group-addon"><b>Buscar</b></span>
				<input type="text" class="form-control" onkeyup="filtrarTabla('opciones-campo-tabla',this.value)">
			</div>
		</div>
	</div>

	<div class="table-responsive">
		<table class="table table-bordered tablas" id="opciones-campo-tabla">
			<thead>
				<tr>
					<th class="text-center" colspan="4">
						<b>LISTADO DE OPCIONES DE CAMPO</b>
						<?php if($permisos == 1){ ?>
						<button title="Descargar Excel" class="generar-excel-boton-descargar" onclick="tablaToExcel('opciones-campo-tabla-descarga','Lista de opciones de campo','ListaOpcionesCampo','','ListaOpcionesCampo','calivirtual.net/inventario','../lb/generarExcel/php/generarExcel.php');"><img src="../img/excel.png"></button>
						<?php } ?>
					</th>
				</tr>
				<tr>
					<th class="text-center"><b>NOMBRE</b></th>
					<th class="text-center"><b>DESCRIPCIÓN</b></th>
					<th class="text-center"><b>ESTADO</b></th>
					<th class="text-center th-funciones-2"><b>FUNCIONES</b></th>
				</tr>
			</thead>
			<tbody>
				<?php
					if(is_array($view_opciones_campo->lista) || is_object($view_opciones_campo->lista))
					{
						foreach($view_opciones_campo->lista as $lista)
						{
							$id = $lista["id"];
							$contador = 0;

							$estado = '<span class="usuario-estado-activo">ACTIVO</span>';

							if(intval($lista["estado"]) == 2)
							{
								$estado = '<span class="usuario-estado-inactivo">INACTIVO</span>';
							}

							$mostrar = false;

							if($permisos == 1)
							{
								$mostrar = true;
							}

							if($mostrar)
							{	
				?>

				<tr>
					<td><?php echo $lista['nombre']; ?></td>
					<td><?php echo $lista['descripcion']; ?></td>
					<td class="text-center"><?php echo $estado; ?></td>
					<td class="text-center">
						<?php 
					  		if($permisos == 1)
					  		{
					  	?>
						<div class="btn-group">
							<button class="btn btn-default" title="Ver" onclick="opciones_campo_cargar_ver(<?php echo $id; ?>)">
								<span class="glyphicon glyphicon-search"></span>
							</button>

							<button class="btn btn-default" title="Editar" onclick="opciones_campo_cargar_editar(<?php echo $id; ?>)">
								<span class="glyphicon glyphicon-edit"></span>
							</button>

							<button class="btn btn-default" title="Eliminar" onclick="opciones_campo_eliminar_confirmar(<?php echo $id; ?>)">
								<span class="fas fa-trash"></span>
							</button>
						</div>
						<?php 
							}
							else
							{
								echo 'No disponible';
							}
						?>
					</td>
				</tr>

				<?php
							}
						}
					}
				?>
			</tbody>
		</table>

		<table id="opciones-campo-tabla-descarga" style="display: none;">
			<thead>
				<tr>
					<th colspan="3"><b>LISTADO DE OPCIONES EN CAMPO</b></th>
				</tr>
				<tr>
					<th><b>NOMBRE</b></th>
					<th><b>DESCRIPCIÓN</b></th>
					<th><b>ESTADO</b></th>
				</tr>
			</thead>
			<tbody>
				<?php
					if(is_array($view_opciones_campo->lista) || is_object($view_opciones_campo->lista))
					{
						foreach($view_opciones_campo->lista as $lista)
						{
							$id = $lista["id"];
							$contador = 0;

							$estado = 'ACTIVO';

							if(intval($lista["estado"]) == 2)
							{
								$estado = 'INACTIVO';
							}

							$mostrar = false;

							if($permisos == 1)
							{
								$mostrar = true;
							}

							if($mostrar)
							{	
				?>

				<tr>
					<td><?php echo $lista['nombre']; ?></td>
					<td><?php echo $lista['descripcion']; ?></td>
					<td><?php echo $estado; ?></td>
				</tr>

				<?php
							}
						}
					}
				?>
			</tbody>
		</table>
	</div>
</span>

<spna id="opciones-campo-contenedor-2" style="display: none"></spna>
