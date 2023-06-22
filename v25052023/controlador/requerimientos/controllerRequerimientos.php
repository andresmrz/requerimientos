
<?php
	
	session_start();

	include_once '../../modelo/usuario.php';
	include_once '../../modelo/requerimientos.php';
	include_once '../../modelo/fecha.php';

	if(isset($_SESSION['requerimientos_usuario']))
	{
		if(isset($_POST['action']) || isset($_GET['autocomplete']))
		{
			$action = (isset($_POST['action']))?trim($_POST['action']):trim($_GET['autocomplete']);
			$usuario = new Usuario();
			$requerimientos = new Requerimientos();
			$fecha = new Fecha();

			$permisos = intval($usuario->getPermisos($_SESSION['requerimientos_usuario']));

			$view_requerimientos = new stdClass();

			switch($action)
			{
				case 'verificar_existe':
				{
					$salida['modo'] = 0;
					$mensaje = '';

					if($requerimientos->existe($_POST['nombre']))
					{
						$salida['modo'] = 1;

						$mensaje = $_POST['nombre'].' ya existe.';
					}

					$salida['mensaje'] = $mensaje;

					echo json_encode($salida);
					
					break;
				}

				case 'crear':
				{
					$id_permiso = 0;

					if($permisos == 1)
					{
						$id_permiso = 1;
					}

					if($permisos == 2 || $permisos == 21)
					{
						$id_permiso = 2;
					}

					if($permisos == 3 || $permisos == 31)
					{
						$id_permiso = 3;
					}

					if($permisos == 4 || $permisos == 41)
					{
						$id_permiso = 4;
					}

					if($permisos == 5 || $permisos == 51)
					{
						$id_permiso = 5;
					}

					$correo = trim($usuario->getCorreo($id_permiso));

					$salida['modo'] = 0;
					$mensaje = '';

					$result = $requerimientos->insert($_POST['destinatario'], $_POST['opcion'], $_POST['cantidad'], $_POST['punto'], $_POST['descripcion'], $correo);
					$salida['mensaje'] = $mensaje;

					if(trim($result) != '0')
					{
						$salida['modo'] = 1;
						$salida['mensaje'] = $result;
					}

					echo json_encode($salida);
					
					break;
				}

				case 'editar':
				{
					echo $requerimientos->update($_POST['id'], $_POST['opcion'], $_POST['cantidad'], $_POST['punto'], $_POST['descripcion']);
					
					break;
				}

				case 'eliminar':
				{
					echo $requerimientos->drop($_POST['id']);
					
					break;
				}

				case 'en_proceso':
				{
					echo $requerimientos->enProceso($_POST['id']);
					
					break;
				}

				case 'procesar':
				{
					echo $requerimientos->procesar($_POST['id'], $_POST['observaciones']);
					
					break;
				}

				case 'rechazar':
				{
					echo $requerimientos->rechazar($_POST['id'], $_POST['observaciones']);
					
					break;
				}

				//////////////////////	

				default:
				{
					break;
				}
			}
		}
	}
	else
	{
		if(isset($_POST['action']))
		{
			$action = trim($_POST['action']);
			$usuario = new Usuario();

			switch($action)
			{
				case 'jj':
				{
					echo 'jj';

					break;
				}
			}
		}
		else
		{
			echo 'No se han encontrado tus datos de inicio de sesión, por favor recarga la pagina.';
		}
	}

?>
