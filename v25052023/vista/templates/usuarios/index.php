
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
        $permisos = intval($claseUsuario->getValorId($usuario,'permisos'));
    }

?>

<!-- //////////////// Estilos /////////////// -->

<link rel="stylesheet" type="text/css" href="../css/usuarios.css">

<!-- ///////////////// Scripts ///////////// -->

<script type="text/javascript" src="../js/functionUsuarios.js"></script>
<script type="text/javascript" src="../lb/generarExcel/js/generarExcel.js"></script>

<link href="../css/select2.min.css" rel="stylesheet" />
<script src="../js/select2.min.js"></script>
<!--- //////////////////////////////////////////// -->

<div class="row">
	<div class="col-sm-12">
		<label class="titulo-subcontenedor">Administrar Usuarios</label>
	</div>
</div>

<div class="btn-group btn-group-toggle" data-toggle="buttons">

	<label class="btn btn-default" onclick="usuarios_cargarIndex()">
    	<input type="radio" autocomplete="off"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;Inicio
  	</label>
	
	<?php 
		if($permisos == 100 || $permisos == 1 || $permisos == 2)
		{
	?>
  	<label class="btn btn-default" onclick="usuarios_ventana_crear()">
    	<input type="radio" autocomplete="off"><span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;Crear
  	</label>
  	<?php
  		}
  	?>

</div>
<br>
<br>

<span id="usuarios-contenedor-1">

	<div class="row">
		<div class="form-group col-sm-3">
			<div class="input-group">
				<span class="input-group-addon"><b>Cantidad registros</b></span>
				<input type="text" class="form-control text-center" value="0" id="usuario-tabla-total" readonly>
			</div>
		</div>
		<div class="col-sm-5"></div>
		<div class="form-group col-sm-4">
			<div class="input-group">
				<span class="input-group-addon"><b>Buscar</b></span>
				<input type="text" class="form-control" onkeyup="filtrarTabla('usuario-tabla',this.value)">
			</div>
		</div>
	</div>

	<div class="table-responsive">
		<table class="table table-bordered tablas" id="usuario-tabla">
			<thead>
				<tr>
					<th class="text-center" colspan="8">
						<b>LISTA DE USUARIOS</b>
						<?php if($permisos == 1){ ?>
						<button title="Descargar Excel" class="generar-excel-boton-descargar" onclick="tablaToExcel('usuario-tabla-descarga','Lista de usuarios','ListaUsuarios','','ListaUsuarios','calivirtual.net/calidad','../lb/generarExcel/php/generarExcel.php');"><img src="../img/excel.png"></button>
						<?php } ?>
					</th>
				</tr>
				<tr>
					<th class="text-center"><b>NOMBRES</b></th>
					<th class="text-center"><b>APELLIDOS</b></th>
					<th class="text-center"><b>NÚMERO DE DOCUMENTO</b></th>
					<th class="text-center"><b>CORREO</b></th>
					<th class="text-center"><b>TIPO DE USUARIO</b></th>
					<th class="text-center"><b>ESTADO</b></th>
					<th class="text-center th-funciones-2"><b>FUNCIONES</b></th>
				</tr>
			</thead>
			<tbody>
				<?php
					if(is_array($view_usuario->lista) || is_object($view_usuario->lista))
					{
						foreach($view_usuario->lista as $lista)
						{
							$id = $lista["id"];
							$listaPermisos = intval($lista['permisos']);

							$estado = '<span class="usuario-estado-activo">ACTIVO</span>';

							if($lista["estado"] == 2)
							{
								$estado = '<span class="usuario-estado-inactivo">INACTIVO</span>';
							}

							$lista_permisos = array
							(
								"1" => 'SUPER ADMIN',
								"2" => 'COORDINADOR',
								"3" => 'LIDER',
								"4" => 'COLABORADOR',
								"10" => 'DIGITADOR'
							);							

							$contador = 0;

							$mostrar = false;

							if($permisos == 1)
							{
								$mostrar = true;
							}

							if($mostrar)
							{	
				?>

				<tr>
					<td><?php echo strtoupper($lista["nombres"]); ?></td>
					<td><?php echo strtoupper($lista["apellidos"]); ?></td>
					<td><?php echo $lista["documento"]; ?></td>
					<td><?php echo $lista["correo"]; ?></td>
					<td><?php echo $lista_permisos["$listaPermisos"]; ?></td>
					<td class="text-center"><?php echo $estado; ?></td>
					<td class="text-center">
						<?php 
					  		if($permisos == 1)
					  		{
					  	?>
						<div class="btn-group">
							<button class="btn btn-default" title="Editar" onclick="usuarios_ventana_editar(<?php echo $id; ?>)">
								<span class="glyphicon glyphicon-edit"></span>
							</button>

							<button class="btn btn-default" title="Eliminar" onclick="usuarios_eliminar_confirmar(<?php echo $id; ?>)">
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

		<table id="usuario-tabla-descarga" style="display: none;">
			<thead>
				<tr>
					<th colspan="7"><b>LISTA DE USUARIOS</b></th>
				</tr>
				<tr>
					<th><b>NOMBRES</b></th>
					<th><b>APELLIDOS</b></th>
					<th><b>NÚMERO DE DOCUMENTO</b></th>
					<th><b>TELEFONO</b></th>
					<th><b>CORREO</b></th>
					<th><b>TIPO DE USUARIO</b></th>
					<th><b>ESTADO</b></th>
				</tr>
			</thead>
			<tbody>
				<?php
					if(is_array($view_usuario->lista) || is_object($view_usuario->lista))
					{
						foreach($view_usuario->lista as $lista)
						{
							$id = $lista["id"];
							$listaPermisos = intval($lista['permisos']);

							$estado = 'ACTIVO';

							if($lista["estado"] == 2)
							{
								$estado = 'INACTIVO';
							}

							$lista_permisos = array
							(
								"1" => 'SUPER ADMIN',
								"2" => 'COORDINADOR',
								"3" => 'LIDER',
								"4" => 'COLABORADOR',
								"10" => 'DIGITADOR'
							);	

							$contador = 0;

							$mostrar = false;

							if($permisos == 1)
							{
								$mostrar = true;
							}

							if($mostrar)
							{	
				?>

				<tr>
					<td><?php echo $lista["nombres"]; ?></td>
					<td><?php echo $lista["apellidos"]; ?></td>
					<td><?php echo $lista["documento"]; ?></td>
					<td><?php echo $lista["correo"]; ?></td>
					<td><?php echo $lista["telefono"]; ?></td>
					<td><?php echo $lista_permisos["$listaPermisos"]; ?></td>
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

<spna id="usuarios-contenedor-2" style="display: none"></spna>
