
<?php
	
	session_start();

	if(isset($_POST['action']))
	{
		$action = trim($_POST['action']);

		$view_inicio = new stdClass();
		$template = '';

		switch($action)
		{
			case 'login':
			{
				$template = '../../vista/templates/inicio/login.php';

				break;
			}

			case 'vacio':
			{
				$template = '../../vista/templates/inicio/vacio.php';

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
