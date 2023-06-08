
<?php
	
	session_start();

	include_once '../../modelo/usuario.php';
	include_once '../../modelo/opciones_sistemas.php';

	if(isset($_SESSION['requerimientos_usuario']))
	{
		if(isset($_POST['action']))
		{
			$action = trim($_POST['action']);
			$usuario = new Usuario();
			$opciones_sistemas = new OpcionesSistemas();

			$view_opciones_sistemas = new stdClass();
			$view_alert = new stdClass();
			$template = '';
			
			$permisos = intval($usuario->getPermisos($_SESSION['requerimientos_usuario']));

			switch($action)
			{
				case 'index':
				{
					if($permisos == 1 || $permisos == 2)
					{
						$view_opciones_sistemas->lista = $opciones_sistemas->getData();

						$template = '../../vista/templates/opciones/sistemas/index.php';
					}

					break;
				}

				case 'ver':
				{
					if($permisos == 1 || $permisos == 2) 
					{
						$view_opciones_sistemas->id = $_POST['id'];

						$view_opciones_sistemas->nombre = $opciones_sistemas->getValorId($view_opciones_sistemas->id, 'nombre');
						$view_opciones_sistemas->descripcion = $opciones_sistemas->getValorId($view_opciones_sistemas->id, 'descripcion');
						$view_opciones_sistemas->estado = intval($opciones_sistemas->getValorId($view_opciones_sistemas->id, 'estado'));

						$template = '../../vista/templates/opciones/sistemas/ver.php';
					}

					break;
				}

				case 'crear':
				{
					if($permisos == 1 || $permisos == 2)
					{
						$template = '../../vista/templates/opciones/sistemas/crear.php';
					}

					break;
				}

				case 'editar':
				{
					if($permisos == 1 || $permisos == 2) 
					{
						$view_opciones_sistemas->id = $_POST['id'];

						$view_opciones_sistemas->nombre = $opciones_sistemas->getValorId($view_opciones_sistemas->id, 'nombre');
						$view_opciones_sistemas->descripcion = $opciones_sistemas->getValorId($view_opciones_sistemas->id, 'descripcion');
						$view_opciones_sistemas->estado = intval($opciones_sistemas->getValorId($view_opciones_sistemas->id, 'estado'));

						$template = '../../vista/templates/opciones/sistemas/editar.php';
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
