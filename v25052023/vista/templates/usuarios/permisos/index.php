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

<!-- ///////////////// Scripts ///////////// -->

<script type="text/javascript" src="../js/functionUsuarios.js"></script>
<script type="text/javascript" src="../lb/generarExcel/js/generarExcel.js"></script>

<link href="../css/select2.min.css" rel="stylesheet" />
<script src="../js/select2.min.js"></script>
<!--- //////////////////////////////////////////// -->

<div class="row">
	<div class="col-sm-12">
		<label class="titulo-subcontenedor">Administrar Permisos</label>
	</div>
</div>

<div class="btn-group btn-group-toggle" data-toggle="buttons">

	<label class="btn btn-default" onclick="usuarios_permisos_cargarIndex()">
    	<input type="radio" autocomplete="off"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;Inicio
  	</label>

</div>
<br>
<br>

<span id="usuario-permisos-contenedor-1">

	<div class="row">
		<div class="form-group col-sm-3">
			<div class="input-group">
				<span class="input-group-addon"><b>Cantidad registros</b></span>
				<input type="text" class="form-control text-center" value="0" id="usuario-permisos-tabla-total" readonly>
			</div>
		</div>
		<div class="col-sm-5"></div>
		<div class="form-group col-sm-4">
			<div class="input-group">
				<span class="input-group-addon"><b>Buscar</b></span>
				<input type="text" class="form-control" onkeyup="filtrarTabla('usuario-permisos-tabla',this.value)">
			</div>
		</div>
	</div>

	<div class="table-responsive">
		<table class="table table-bordered tablas" id="usuario-permisos-tabla">
			<thead>
				<tr>
					<th class="text-center" colspan="5">
						<b>LISTA DE PERMISOS</b>
						<?php if(false){ ?>
						<button title="Descargar Excel" class="generar-excel-boton-descargar" onclick="tablaToExcel('usuario-permisos-tabla-descarga','Lista de devoluciones a campo','ListaDatosCampo','','ListaDatosCampo','calivirtual.net/calidad','../lb/generarExcel/php/generarExcel.php');"><img src="../img/excel.png"></button>
						<?php } ?>
					</th>
				</tr>
				<tr>
					<th class="text-center"><b>USUARIO</b></th>
					<th class="text-center"><b>NOMBRE</b></th>
					<th class="text-center"><b>AREA</b></th>
					<th class="text-center th-funciones-2"><b>PERMISOS</b></th>
				</tr>
			</thead>
			<tbody>
				<?php
					if(is_array($view_usuario->data['data_usuarios']) || is_object($view_usuario->data['data_usuarios']))
					{
						foreach($view_usuario->data['data_usuarios'] as $lista)
						{
							$id = $lista["id"];

							$lista_permisos= array
							(
								"1" => 'Administardor',
								"2" => 'Supervisor Sistemas',
                                //"21" => 'Auxiliar Sistemas',
								"3" => 'Supervisor Campo',
                                //"31" => 'Auxiliar Campo',
                                "4" => 'Supervisor Puntos de Atención',
                                //"41" => 'Auxiliar Puntos de Atención',
								"5" => 'Supervisor Almacen',
                                //"51" => 'Auxiliar Almacen'								
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
					<td><?php echo trim($lista["login"]); ?></td>
					<td><?php echo trim($lista["nomb_us"]); ?></td>
					<td><?php echo trim($lista["area"]); ?></td>
					<td class="text-center">
						<?php 
					  		if($permisos == 1)
					  		{
					  	?>
								<select class="form-control" onchange="usuarios_permisos_confirmar(<?php echo $id; ?>, this.value)">
									<option value="" selected disabled>Seleccione ...</option>
						<?php 
					  			foreach($lista_permisos as $clave => $valor)
								{
									$selected = (array_key_exists("id_$id", $view_usuario->data['data_permisos']))?((intval($view_usuario->data['data_permisos']["id_$id"]) == intval($clave))?'selected':''):'';
						?>
									<option <?php echo $selected; ?> value="<?php echo $clave; ?>"><?php echo $valor; ?></option>
						<?php
								}
					  	?>	
								</select>
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
	</div>
</span>

<spna id="usuario-permisos-contenedor-2" style="display: none"></spna>