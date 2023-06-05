
<?php
	
	session_start();

	include_once '../../modelo/usuario.php';

	if(isset($_SESSION['requerimientos_usuario']))
	{
		if(isset($_POST['action']) || $_GET['action'] || isset($_GET['autocomplete']))
		{
			$action = (isset($_POST['action']))?trim($_POST['action']):((isset($_GET['action']))?trim($_GET['action']):trim($_GET['autocomplete']));
			$usuario = new Usuario();

			$view_usuario = new stdClass();

			switch($action)
			{
				case 'filtro':
				{
					echo json_encode($usuario->filtro($_GET['term']));

					break;
				}

				case 'filtro_usuarios':
				{
					$permisos = null;

					if(isset($_GET['permisos']))
					{
						$permisos = intval($_GET['permisos']);
					}

					echo json_encode($usuario->filtro_usuarios($_GET['term'],$permisos));

					break;
				}

				case 'filtro_admin':
				{
					echo json_encode($usuario->filtro_admin($_GET['term']));

					break;
				}

				//////////////////////
				
				case 'crear':
				{
					echo $usuario->insert($_POST['documento'],strtoupper($_POST['nombres']),strtoupper($_POST['apellidos']),$_POST['correo'],$_POST['telefono'],$_POST['estado'],$_POST['permisos'],$_POST['documento']);

					break;
				}

				case 'editar':
				{
					echo $usuario->update($_POST['id'],$_POST['documento'],strtoupper($_POST['nombres']),strtoupper($_POST['apellidos']),$_POST['correo'],$_POST['telefono'],$_POST['estado'],$_POST['permisos']);

					break;
				}

				case 'editar_password':
				{
					echo $usuario->update_password($_POST['id'],$_POST['password']);

					break;
				}

				case 'eliminar':
				{
					$nombre_completo = $usuario->getValorId($_POST['id'],'nombres').' '.$usuario->getValorId($_POST['id'],'apellidos');
					
					echo $usuario->drop($_POST['id'],$nombre_completo);

					break;
				}

				case 'permisos':
				{
					$id_usuario = $_POST['id'];
					$permisos = $_POST['permisos'];

					if($usuario->existe_permisos($id_usuario))
					{
						echo $usuario->update_permisos($id_usuario, $permisos);
					}
					else
					{
						echo $usuario->insert_permisos($id_usuario, $permisos);
					}

					break;
				}

				//////////////////////

				case 'verificarUsuario':
				{
					if($usuario->existe($_POST['documento']))
					{
						echo '1';
					}
					else if($usuario->existe_correo($_POST['correo']))
					{
						echo '2';
					}
					else
					{
						echo '0';
					}

					break;
				}

				case 'verificarUsuarioEdit':
				{
					if($usuario->existe_edit($_POST['id'], $_POST['documento']))
					{
						echo '1';
					}
					else if($usuario->existe_correo_edit($_POST['id'], $_POST['correo']))
					{
						echo '2';
					}
					else
					{
						echo '0';
					}

					break;
				}

				///////////// get /////////////

				case 'get_datos_login':
				{
					$salida = [["nombre" => $usuario->getValorId($_POST['id'],'nombre')]];
					echo json_encode($salida);
					
					break;
				}

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
				case 'registrarse':
				{
					echo $usuario->insert($_POST['cedula'],$_POST['nombre'],$_POST['correo'],0,$_POST['cedula']);

					break;
				}

				case 'verificarUsuario':
				{
					if($usuario->existe($_POST['cedula']))
					{
						echo '1';
					}
					else if($usuario->existe_correo($_POST['correo']))
					{
						echo '2';
					}
					else
					{
						echo '0';
					}

					break;
				}

				case 'verificarUsuarioEdit':
				{
					if($usuario->existe_edit($_POST['id'], $_POST['documento']))
					{
						echo '1';
					}
					else if($usuario->existe_correo_edit($_POST['id'], $_POST['correo']))
					{
						echo '2';
					}
					else
					{
						echo '0';
					}

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
