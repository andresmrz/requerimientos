
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
					$salida['modo'] = 0;
					$mensaje = '';

					$result = $requerimientos->insert(strtoupper($_POST['asunto']), $_POST['destinatario'], $_POST['opcion'], $_POST['descripcion']);
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
					echo $requerimientos->update($_POST['id'], $_POST['asunto'], $_POST['opcion'], $_POST['descripcion']);
					
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
