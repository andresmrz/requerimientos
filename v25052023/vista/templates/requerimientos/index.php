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

<script type="text/javascript" src="../js/functionRequerimientos.js"></script>
<script type="text/javascript" src="../lb/generarExcel/js/generarExcel.js"></script>
<script src="../js/select2.min.js"></script>

<div class="row">
	<div class="col-sm-12">
		<label class="titulo-subcontenedor">Administrar Requerimientos</label>
	</div>
</div>

<div class="btn-group btn-group-toggle" data-toggle="buttons">

	<label class="btn btn-default" onclick="requerimientos_cargarIndex()">
    	<input type="radio" autocomplete="off"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;Inicio
  	</label>
	
	<?php 
		if($permisos == 1 || $permisos == 2 || $permisos == 3 || $permisos == 4)
		{
	?>
  	<label class="btn btn-default" onclick="requerimientos_cargar_crear()">
    	<input type="radio" autocomplete="off"><span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;Generar requerimiento
  	</label>
  	<?php
  		}
  	?>

</div>
<br>
<br>

<span id="requerimientos-contenedor-1">
	<div class="row">
		<div class="form-group col-sm-3">
			<div class="input-group">
				<span class="input-group-addon"><b>Cantidad registros</b></span>
				<input type="text" class="form-control text-center" value="0" id="requerimientos-tabla-total" readonly>
			</div>
		</div>
		<div class="col-sm-5"></div>
		<div class="form-group col-sm-4">
			<div class="input-group">
				<span class="input-group-addon"><b>Buscar</b></span>
				<input type="text" class="form-control" onkeyup="filtrarTabla('requerimientos-tabla',this.value)">
			</div>
		</div>
	</div>

	<div class="table-responsive">
		<table class="table table-bordered tablas" id="requerimientos-tabla">
			<thead>
				<tr>
					<th class="text-center" colspan="7">
						<b>LISTADO DE REQUERIMIENTOS</b>
						<?php if($permisos == 1){ ?>
						<button title="Descargar Excel" class="generar-excel-boton-descargar" onclick="tablaToExcel('requerimientos-tabla-descarga','Lista de requerimientos','ListaRequerimientos','','ListaRequerimientos','calivirtual.net/requerimientos','../lb/generarExcel/php/generarExcel.php');"><img src="../img/excel.png"></button>
						<?php } ?>
					</th>
				</tr>
				<tr>
					<th class="text-center"><b>FECHA</b></th>
					<th class="text-center"><b>ASUNTO</b></th>
					<th class="text-center"><b>DESCRIPCIÓN</b></th>
					<th class="text-center"><b>SOLICITANTE</b></th>
					<th class="text-center"><b>DESTINATARIO</b></th>
					<th class="text-center"><b>ESTADO</b></th>
					<th class="text-center th-funciones-2"><b>FUNCIONES</b></th>
				</tr>
			</thead>
			<tbody>
				<?php
					if(is_array($view_requerimientos->lista) || is_object($view_requerimientos->lista))
					{
						foreach($view_requerimientos->lista as $lista)
						{
							$id = $lista["id"];
							$contador = 0;

							$estado = 'Registrado';

							if(intval($lista["estado"]) == 1)
							{
								$estado = '<span class="usuario-estado-activo">Procesado</span>';
							}

							if(intval($lista["estado"]) == 2)
							{
								$estado = '<span class="usuario-estado-inactivo">Rechazado</span>';
							}

							if(intval($lista["estado"]) == 3)
							{
								$estado = '<span class="usuario-estado-enproceso">En Proceso</span>';
							}

							$mostrar = false;

							if($permisos == 1)
							{
								$mostrar = true;
							}

							if($permisos == 2)
							{
								if($lista['destinatario'] == 'sistemas' || $lista['user_create'] == $_SESSION['requerimientos_usuario'])
								{
									$mostrar = true;
								}
							}

							if($permisos == 3)
							{
								if($lista['destinatario'] == 'campo' || $lista['user_create'] == $_SESSION['requerimientos_usuario'])
								{
									$mostrar = true;
								}
							}

							if($permisos == 4)
							{
								if($lista['destinatario'] == 'puntos_atencion' || $lista['user_create'] == $_SESSION['requerimientos_usuario'])
								{
									$mostrar = true;
								}
							}

							if($permisos == 5)
							{
								if($lista['destinatario'] == 'almacen' || $lista['user_create'] == $_SESSION['requerimientos_usuario'])
								{
									$mostrar = true;
								}
							}

							if($mostrar)
							{	
				?>

				<tr>
					<td><?php echo $fecha->soloFecha($lista['date_create']); ?></td>
					<td><?php echo $lista['opcion']; ?></td>
					<td><?php echo $lista['descripcion']; ?></td>
					<td><?php echo $view_requerimientos->usuarios['id_'.$lista['user_create']]['nombre']; ?></td>
					<td><?php echo $lista['destinatario']; ?></td>
					<td><?php echo $estado; ?></td>
					<td class="text-center">
						<?php 
					  		if($permisos == 1)
					  		{
					  	?>
						<div class="btn-group">
							<button class="btn btn-default" title="Ver" onclick="requerimientos_cargar_ver(<?php echo $id; ?>)">
								<span class="fas fa-eye"></span>
							</button>

							<button class="btn btn-default" title="Editar" onclick="requerimientos_cargar_editar(<?php echo $id; ?>)">
								<span class="glyphicon glyphicon-edit"></span>
							</button>

							<button class="btn btn-default" title="Eliminar" onclick="requerimientos_eliminar_confirmar(<?php echo $id; ?>)">
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

		<table id="requerimientos-tabla-descarga" style="display: none;">
			<thead>
				<tr>
					<th colspan="6"><b>LISTADO DE REQUERIMIENTOS</b></th>
				</tr>
				<tr>
					<th><b>FECHA</b></th>
					<th><b>ASUNTO</b></th>
					<th><b>DESCRIPCIÓN</b></th>
					<th><b>SOLICITANTE</b></th>
					<th><b>DESTINATARIO</b></th>
					<th><b>ESTADO</b></th>
				</tr>
			</thead>
			<tbody>
				<?php
					if(is_array($view_requerimientos->lista) || is_object($view_requerimientos->lista))
					{
						foreach($view_requerimientos->lista as $lista)
						{
							$id = $lista["id"];
							$contador = 0;

							$estado = 'Registrado';

							if(intval($lista["estado"]) == 1)
							{
								$estado = 'Procesado';
							}

							if(intval($lista["estado"]) == 2)
							{
								$estado = 'Rechazado';
							}

							if(intval($lista["estado"]) == 3)
							{
								$estado = 'En Proceso';
							}

							$mostrar = false;

							if($permisos == 1)
							{
								$mostrar = true;
							}

							if($permisos == 2)
							{
								if($lista['destinatario'] == 'sistemas' || $lista['user_create'] == $_SESSION['requerimientos_usuario'])
								{
									$mostrar = true;
								}
							}

							if($permisos == 3)
							{
								if($lista['destinatario'] == 'campo' || $lista['user_create'] == $_SESSION['requerimientos_usuario'])
								{
									$mostrar = true;
								}
							}

							if($permisos == 4)
							{
								if($lista['destinatario'] == 'puntos_atencion' || $lista['user_create'] == $_SESSION['requerimientos_usuario'])
								{
									$mostrar = true;
								}
							}

							if($permisos == 5)
							{
								if($lista['destinatario'] == 'almacen' || $lista['user_create'] == $_SESSION['requerimientos_usuario'])
								{
									$mostrar = true;
								}
							}

							if($mostrar)
							{	
				?>

				<tr>
					<td><?php echo $fecha->soloFecha($lista['date_create']); ?></td>
					<td><?php echo $lista['opcion']; ?></td>
					<td><?php echo $lista['descripcion']; ?></td>
					<td><?php echo $view_requerimientos->usuarios['id_'.$lista['user_create']]['nombre']; ?></td>
					<td><?php echo $lista['destinatario']; ?></td>
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

<span id="requerimientos-contenedor-2" style="display: none"></span>

<span id="requerimientos-contenedor-3" style="display: none"></span>
