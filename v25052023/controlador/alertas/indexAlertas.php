
<?php
	
	session_start();

	include_once '../../modelo/usuario.php';

	if(isset($_POST['action']))
	{
		$action = trim($_POST['action']);

		$usuario = new Usuario();

		$view_alert = new stdClass();
		$view_alert->inicio = false;
		$template = '';

		switch($action)
		{
			////// inicio ////////

			case 'ventanaAlertasInicio':
			{
				$view_alert->mensaje = $_POST['mensaje'];
				$view_alert->modo = $_POST['modo'];
				$view_alert->inicio = true;
				
				$template = '../../vista/templates/alertas/principal.php';

				break;
			}
			
			////////////////////////

			case 'ventana_bienvenida':
			{
				$view_alert->nombre = $_POST['nombre'];
				
				$template = '../../vista/templates/alertas/bienvenida.php';

				break;
			}

			case 'ventanaConfirmacion':
			{
				$view_alert->titulo = $_POST['titulo'];
				$view_alert->funcion = $_POST['funcion'];
				
				$template = '../../vista/templates/alertas/ventanaConfirmacion.php';

				break;
			}

			case 'ventanaAlertas':
			{
				$view_alert->mensaje = $_POST['mensaje'];
				$view_alert->modo = $_POST['modo'];
				
				$template = '../../vista/templates/alertas/principal.php';

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

?>
