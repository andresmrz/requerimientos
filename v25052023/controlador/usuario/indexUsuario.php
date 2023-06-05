
<?php
	
	session_start();

	include_once '../../modelo/usuario.php';

	if(isset($_SESSION['requerimientos_usuario']))
	{
		if(isset($_POST['action']))
		{
			$action = trim($_POST['action']);
			$usuario = new Usuario();

			$view_usuario = new stdClass();
			$view_alert = new stdClass();
			$template = '';
			
			$permisos = intval($usuario->getPermisos($_SESSION['requerimientos_usuario']));

			switch($action)
			{
				case 'index':
				{
					if($permisos == 1)
					{
						$view_usuario->lista = $usuario->getUsuarios();
						
						$template = '../../vista/templates/usuarios/index.php';
					}

					break;
				}

				case 'crear':
				{	
					if($permisos == 1)
					{				
						$template = '../../vista/templates/usuarios/crear.php';
					}

					break;
				}

				case 'editar':
				{
					if($permisos == 1)
					{
						$view_usuario->id = trim($_POST['id']);
						$view_usuario->nombres = $usuario->getValorId($view_usuario->id,'nombres');
						$view_usuario->apellidos = $usuario->getValorId($view_usuario->id,'apellidos');
						$view_usuario->documento = $usuario->getValorId($view_usuario->id,'documento');
						$view_usuario->correo = $usuario->getValorId($view_usuario->id,'correo');
						$view_usuario->telefono = $usuario->getValorId($view_usuario->id,'telefono');
						$view_usuario->estado = intval($usuario->getValorId($view_usuario->id,'estado'));
						$view_usuario->permisos = intval($usuario->getValorId($view_usuario->id,'permisos'));

						$template = '../../vista/templates/usuarios/editar.php';
					}

					break;
				}

				case 'perfil':
				{
					$view_usuario->id = $_SESSION['requerimientos_usuario'];
					$view_usuario->nombres = $usuario->getValorId($view_usuario->id,'nombres');
					$view_usuario->apellidos = $usuario->getValorId($view_usuario->id,'apellidos');
					$view_usuario->documento = $usuario->getValorId($view_usuario->id,'documento');
					$view_usuario->correo = $usuario->getValorId($view_usuario->id,'correo');
					$view_usuario->telefono = $usuario->getValorId($view_usuario->id,'telefono');
					$view_usuario->estado = intval($usuario->getValorId($view_usuario->id,'estado'));
					$view_usuario->permisos = intval($usuario->getValorId($view_usuario->id,'permisos'));

					$template = '../../vista/templates/usuarios/perfil.php';

					break;
				}

				case 'permisos_index':
				{
					$view_usuario->data = $usuario->getListaUsuariosPermisos($permisos);

					$template = '../../vista/templates/usuarios/permisos/index.php';

					break;
				}

				default:
				{
					break;
				}
			}

			if($template != '')
			{
				include_once("$template");
			}
		}
	}
	else
	{
		include_once('../../vista/templates/inicio/metodoSalir.php');
	}

?>
