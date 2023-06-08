
<?php
	
	session_start();

	include_once '../../modelo/usuario.php';
	include_once '../../modelo/opciones_campo.php';

	if(isset($_SESSION['requerimientos_usuario']))
	{
		if(isset($_POST['action']))
		{
			$action = trim($_POST['action']);
			$usuario = new Usuario();
			$opciones_campo = new OpcionesCampo();

			$view_opciones_campo = new stdClass();
			$view_alert = new stdClass();
			$template = '';
			
			$permisos = intval($usuario->getPermisos($_SESSION['requerimientos_usuario']));

			switch($action)
			{
				case 'index':
				{
					if($permisos == 1 || $permisos == 3)
					{
						$view_opciones_campo->lista = $opciones_campo->getData();

						$template = '../../vista/templates/opciones/campo/index.php';
					}

					break;
				}

				case 'ver':
				{
					if($permisos == 1 || $permisos == 3) 
					{
						$view_opciones_campo->id = $_POST['id'];

						$view_opciones_campo->nombre = $opciones_campo->getValorId($view_opciones_campo->id, 'nombre');
						$view_opciones_campo->descripcion = $opciones_campo->getValorId($view_opciones_campo->id, 'descripcion');
						$view_opciones_campo->estado = intval($opciones_campo->getValorId($view_opciones_campo->id, 'estado'));

						$template = '../../vista/templates/opciones/campo/ver.php';
					}

					break;
				}

				case 'crear':
				{
					if($permisos == 1 || $permisos == 3)
					{
						$template = '../../vista/templates/opciones/campo/crear.php';
					}

					break;
				}

				case 'editar':
				{
					if($permisos == 1 || $permisos == 3) 
					{
						$view_opciones_campo->id = $_POST['id'];

						$view_opciones_campo->nombre = $opciones_campo->getValorId($view_opciones_campo->id, 'nombre');
						$view_opciones_campo->descripcion = $opciones_campo->getValorId($view_opciones_campo->id, 'descripcion');
						$view_opciones_campo->estado = intval($opciones_campo->getValorId($view_opciones_campo->id, 'estado'));

						$template = '../../vista/templates/opciones/campo/editar.php';
					}

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
