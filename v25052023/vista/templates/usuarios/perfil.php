
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
		<label class="subtitulo-subcontenedor">Perfil</label>
	</div>
</div>

<div class="row">
    <div class="form-group col-sm-6">
        <label><b>Número de Documento </b><span class="text-danger hint--top hint--primary" data-hint="Campo obligatotio" style="cursor: pointer;">(Campo Obligatorio)</span></label>
        <input readonly type="text" id="usuario-perfil-documento" onkeypress="return soloNumeros(event)" class="form-control" value="<?php echo $view_usuario->documento; ?>" placeholder="Digite su número de documento" minlength="4" maxlength="15" autocomplete="off">
    </div>
</div>

<div class="row">
    <div class="form-group col-sm-6">
        <label><b>Nombres </b><span class="text-danger hint--top hint--primary" data-hint="Campo obligatotio" style="cursor: pointer;">(Campo Obligatorio)</span></label>
        <input readonly type="text" id="usuario-perfil-nombres" class="form-control" value="<?php echo $view_usuario->nombres; ?>" placeholder="Digite su nombre" minlength="3" maxlength="90" autocomplete="off">
    </div>

    <div class="form-group col-sm-6">
        <label><b>Apellidos </b><span class="text-danger hint--top hint--primary" data-hint="Campo obligatotio" style="cursor: pointer;">(Campo Obligatorio)</span></label>
        <input readonly type="text" id="usuario-perfil-apellidos" class="form-control" value="<?php echo $view_usuario->apellidos; ?>" placeholder="Digite su apellidos" minlength="3" maxlength="90" autocomplete="off">
    </div>
</div>

<div class="row">
    <div class="form-group col-sm-6">
        <label><b>Telefono </b><span class="text-danger hint--top hint--primary" data-hint="Campo obligatotio" style="cursor: pointer;">(Campo Obligatorio)</span></label>
        <input readonly type="text" id="usuario-perfil-telefono" onkeypress="return soloNumeros(event)" class="form-control" value="<?php echo $view_usuario->telefono; ?>" placeholder="Digite su número de telefono" minlength="5" maxlength="15" autocomplete="off">
    </div>

    <div class="form-group col-sm-6">
        <label><b>Correo </b><span class="text-danger hint--top hint--primary" data-hint="Campo opcional" style="cursor: pointer;">(Campo Obligatorio)</span></label>
        <input readonly type="email" id="usuario-perfil-correo" class="form-control" value="<?php echo $view_usuario->correo; ?>" placeholder="Digite su correo electronico" minlength="5" autocomplete="off" maxlength="90">
    </div>
</div>

<div class="row">
    <div class="form-group col-sm-6">
        <label><b>Tipo de Usuario </b><span class="text-danger hint--top hint--primary" data-hint="Campo obligatotio" style="cursor: pointer;">(Campo Obligatorio)</span></label>
        <select disabled class="form-control" id="usuario-perfil-permisos">
            <option value="" disabled>Seleccione ...</option>
            <option <?php echo ($view_usuario->permisos == 1)?'selected':''; ?> value="1">Super Admin</option>
        </select>
    </div>

    <div class="form-group col-sm-6">
        <label><b>Estado </b><span class="text-danger hint--top hint--primary" data-hint="Campo obligatotio" style="cursor: pointer;">(Campo Obligatorio)</span></label>
        <select disabled class="form-control" id="usuario-perfil-estado">
            <option value="" disabled>Seleccione ...</option>
            <option <?php echo ($view_usuario->estado == 1)?'selected':''; ?> value="1">Activo</option>
            <option <?php echo ($view_usuario->estado == 2)?'selected':''; ?> value="2">Inactivo</option>
        </select>
    </div>
</div>
<br>

<?php 
	if(true)
	{
?>

<div class="row">
	<div class="col-sm-12">
		<label class="subtitulo-subcontenedor">Cambiar Contraseña</label>
	</div>
</div>

<div class="row">
	<div class="col-sm-12">

		<form action="javascript: perfil_editar_password_confirmar(<?php echo $view_usuario->id; ?>,'<?php echo strtoupper($view_usuario->nombres); ?>')">
			<div class="row">	
				<div class="form-group col-sm-6">
					<label for=""><b>Nueva Contraseña </b><span class="text-danger hint--top hint--primary" data-hint="Campo obligatotio" style="cursor: pointer;">&nbsp;&nbsp;(*)</span></label>
					<input type="password" class="form-control" id="usuario-perfil-password" placeholder="Digite la nueva contraseña" minlength="4" maxlength="15" autocomplete="off" required>
				</div>

				<div class="form-group col-sm-6">
					<label for=""><b>Condirmar Contraseña </b><span class="text-danger hint--top hint--primary" data-hint="Campo obligatotio" style="cursor: pointer;">&nbsp;&nbsp;(*)</span></label>
					<input type="password" class="form-control" id="usuario-perfil-password-2" placeholder="Digite la nueva contraseña" minlength="4" maxlength="15" autocomplete="off" required>
				</div>
			</div>

			<br>
			<div class="alert alert-success" id="usuario-perfil-password-notificacion" style="display: none;">aviso</div>

			<center>
				<button type="reset" class="btn btn-warning">
					<span class="glyphicon glyphicon-refresh"></span>&nbsp;&nbsp;Reset
				</button>

				<button class="btn btn-primary">
					<span class="glyphicon glyphicon-floppy-saved"></span>&nbsp;&nbsp;Guardar
				</button>
			</center>
		</form>
	</div>
</div>

<br>
<button type="button" class="btn btn-danger" onclick="inicio()" style="float: right">
	<span class="fas fa-times"></span>&nbsp;&nbsp;Cerrar
</button>
<br>

<?php 
	}
?>