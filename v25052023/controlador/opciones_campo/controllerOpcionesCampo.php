
<?php
	
	session_start();

	include_once '../../modelo/usuario.php';
	include_once '../../modelo/opciones_campo.php';
	include_once '../../modelo/fecha.php';

	if(isset($_SESSION['requerimientos_usuario']))
	{
		if(isset($_POST['action']) || isset($_GET['autocomplete']))
		{
			$action = (isset($_POST['action']))?trim($_POST['action']):trim($_GET['autocomplete']);
			$usuario = new Usuario();
			$opciones_campo = new OpcionesCampo();
			$fecha = new Fecha();

			$view_opciones_campo = new stdClass();

			switch($action)
			{
				case 'verificar_existe':
				{
					$salida['modo'] = 0;
					$mensaje = '';

					if($opciones_campo->existe($_POST['nombre']))
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
					$salida['modo'] = 0;
					$mensaje = '';

					$result = $opciones_campo->insert(strtoupper($_POST['nombre']), $_POST['descripcion']);
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
					echo $opciones_campo->update($_POST['id'], $_POST['nombre'], $_POST['descripcion'], $_POST['estado']);
					
					break;
				}

				case 'eliminar':
				{
					echo $opciones_campo->drop($_POST['id']);
					
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
