
<?php
	
	session_start();

	include_once '../../modelo/usuario.php';

	if(isset($_POST['action']))
	{
		$action = trim($_POST['action']);
		$usuario = new Usuario();

		$view_usuario = new stdClass();

		switch($action)
		{
			case 'iniciar_sesion':
			{
				$salida = '-1';
				$loginUsuario = $_POST['usuario'];
				$loginPassword = $_POST['password'];

				if($usuario->login($loginUsuario, $loginPassword) > 0)
				{
					if(false)//intval($usuario->getValor($loginUsuario,'estado')) == 2)
					{
						$salida = '-2';
					}
					else
					{
						$_SESSION['requerimientos_usuario'] = intval($usuario->getIdLogin($loginUsuario, $loginPassword));
						$salida = '0';
					}
				}

				echo $salida;//.' - '.$usuario->login2($loginUsuario,$loginPassword);

				break;
			}

			default:
			{
				break;
			}
		}
	}

?>
