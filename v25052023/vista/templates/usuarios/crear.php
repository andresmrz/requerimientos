
<?php 
	
	include_once '../../modelo/usuario.php';

	$claseUsuario = new Usuario();
	$usuario = '';
	$permisos = '';

    if(isset($_SESSION['requerimientos_usuario']))
    {
        $usuario = $_SESSION['requerimientos_usuario'];
        $permisos = intval($claseUsuario->getValorId($usuario,'permisos'));
    }

?>

<div class="row">
	<div class="col-sm-12">
		<label class="subtitulo-subcontenedor">Crear Usuario</label>
	</div>
</div>

<form action="javascript: usuarios_crear_confirmar()">
	<br>
	<div class="row">
		<div class="form-group col-sm-6">
			<label><b>Número de Documento </b><span class="text-danger hint--top hint--primary" data-hint="Campo obligatotio" style="cursor: pointer;">(Campo Obligatorio)</span></label>
			<input type="text" id="usuario-crear-documento" onkeypress="return soloNumeros(event)" class="form-control" value="" placeholder="Digite su número de documento" minlength="4" maxlength="15" autocomplete="off" required>
		</div>
	</div>

	<div class="row">
		<div class="form-group col-sm-6">
			<label><b>Nombres </b><span class="text-danger hint--top hint--primary" data-hint="Campo obligatotio" style="cursor: pointer;">(Campo Obligatorio)</span></label>
			<input type="text" id="usuario-crear-nombres" class="form-control" value="" placeholder="Digite su nombre" minlength="3" maxlength="90" autocomplete="off" required>
		</div>

		<div class="form-group col-sm-6">
			<label><b>Apellidos </b><span class="text-danger hint--top hint--primary" data-hint="Campo obligatotio" style="cursor: pointer;">(Campo Obligatorio)</span></label>
			<input type="text" id="usuario-crear-apellidos" class="form-control" value="" placeholder="Digite su apellidos" minlength="3" maxlength="90" autocomplete="off" required>
		</div>
	</div>

	<div class="row">
		<div class="form-group col-sm-6">
			<label><b>Telefono </b><span class="text-danger hint--top hint--primary" data-hint="Campo obligatotio" style="cursor: pointer;">(Campo Obligatorio)</span></label>
			<input type="text" id="usuario-crear-telefono" onkeypress="return soloNumeros(event)" class="form-control" value="" placeholder="Digite su número de telefono" minlength="5" maxlength="15" autocomplete="off" required>
		</div>

		<div class="form-group col-sm-6">
			<label><b>Correo </b><span class="text-danger hint--top hint--primary" data-hint="Campo opcional" style="cursor: pointer;">(Campo Obligatorio)</span></label>
			<input type="email" id="usuario-crear-correo" class="form-control" value="" placeholder="Digite su correo electronico" minlength="5" autocomplete="off" maxlength="90" required>
		</div>
	</div>

	<div class="row">
		<div class="form-group col-sm-6">
			<label><b>Tipo de Usuario </b><span class="text-danger hint--top hint--primary" data-hint="Campo obligatotio" style="cursor: pointer;">(Campo Obligatorio)</span></label>
			<select class="form-control" id="usuario-crear-permisos" required>
				<option value="" selected disabled>Seleccione ...</option>
				<?php 
					if($permisos == 1)
					{
				?>
				<option value="10">Digitador</option>
				<option value="1">Super Admin</option>
				<?php 
					}
				?>
			</select>
		</div>

		<div class="form-group col-sm-6">
			<label><b>Estado </b><span class="text-danger hint--top hint--primary" data-hint="Campo obligatotio" style="cursor: pointer;">(Campo Obligatorio)</span></label>
			<select class="form-control" id="usuario-crear-estado" required>
				<option value="" selected disabled>Seleccione ...</option>
				<option value="1">Activo</option>
				<option value="2">Inactivo</option>
			</select>
		</div>
	</div>
	<br>

	<div class="alert alert-success" id="usuario-crear-notificacion" style="display: none;">aviso</div>

	<center>
		<button type="reset" class="btn btn-warning">
			<span class="glyphicon glyphicon-refresh"></span>&nbsp;&nbsp;Reset
		</button>

		<button class="btn btn-primary">
			<span class="glyphicon glyphicon-floppy-saved"></span>&nbsp;&nbsp;Guardar
		</button>
	</center>
</form>

<br>
<button type="button" class="btn btn-danger" onclick="usuarios_cargarIndex()" style="float: right">
	<span class="fas fa-times"></span>&nbsp;&nbsp;Cerrar
</button>
<br>
