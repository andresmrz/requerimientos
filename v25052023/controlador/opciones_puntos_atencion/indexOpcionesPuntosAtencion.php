
<?php
	
	session_start();

	include_once '../../modelo/usuario.php';
	include_once '../../modelo/opciones_puntos_atencion.php';

	if(isset($_SESSION['requerimientos_usuario']))
	{
		if(isset($_POST['action']))
		{
			$action = trim($_POST['action']);
			$usuario = new Usuario();
			$opciones_puntos_atencion = new OpcionesPuntosAtencion();

			$view_opciones_puntos_atencion = new stdClass();
			$view_alert = new stdClass();
			$template = '';
			
			$permisos = intval($usuario->getPermisos($_SESSION['requerimientos_usuario']));

			switch($action)
			{
				case 'index':
				{
					if($permisos == 1)
					{
						$view_opciones_puntos_atencion->lista = $opciones_puntos_atencion->getData();

						$template = '../../vista/templates/opciones/puntos_atencion/index.php';
					}

					break;
				}

				case 'ver':
				{
					if($permisos == 1) 
					{
						$view_opciones_puntos_atencion->id = $_POST['id'];

						$view_opciones_puntos_atencion->nombre = $opciones_puntos_atencion->getValorId($view_opciones_puntos_atencion->id, 'nombre');
						$view_opciones_puntos_atencion->descripcion = $opciones_puntos_atencion->getValorId($view_opciones_puntos_atencion->id, 'descripcion');
						$view_opciones_puntos_atencion->estado = intval($opciones_puntos_atencion->getValorId($view_opciones_puntos_atencion->id, 'estado'));

						$template = '../../vista/templates/opciones/puntos_atencion/ver.php';
					}

					break;
				}

				case 'crear':
				{
					if($permisos == 1)
					{
						$template = '../../vista/templates/opciones/puntos_atencion/crear.php';
					}

					break;
				}

				case 'editar':
				{
					if($permisos == 1) 
					{
						$view_opciones_puntos_atencion->id = $_POST['id'];

						$view_opciones_puntos_atencion->nombre = $opciones_puntos_atencion->getValorId($view_opciones_puntos_atencion->id, 'nombre');
						$view_opciones_puntos_atencion->descripcion = $opciones_puntos_atencion->getValorId($view_opciones_puntos_atencion->id, 'descripcion');
						$view_opciones_puntos_atencion->estado = intval($opciones_puntos_atencion->getValorId($view_opciones_puntos_atencion->id, 'estado'));

						$template = '../../vista/templates/opciones/puntos_atencion/editar.php';
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
