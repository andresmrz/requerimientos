
<?php
	
	session_start();

	include_once '../../modelo/usuario.php';
	include_once '../../modelo/articulos.php';
	include_once '../../modelo/requerimientos.php';
	include_once '../../modelo/fecha.php';

	if(isset($_SESSION['requerimientos_usuario']))
	{
		if(isset($_POST['action']) || isset($_GET['autocomplete']))
		{
			$action = (isset($_POST['action']))?trim($_POST['action']):trim($_GET['autocomplete']);
			$usuario = new Usuario();
			$articulos = new Articulos();
			$requerimientos = new Requerimientos();
			$fecha = new Fecha();

			$permisos = intval($usuario->getPermisos($_SESSION['requerimientos_usuario']));

			$view_requerimientos = new stdClass();

			switch($action)
			{
				case 'verificar_existencias':
				{
					$salida['modo'] = 0;
					$mensaje = '';
					$cantidad = intval($_POST['cantidad']);
					$existencias = intval($articulos->getValorId($_POST['articulo'], 'cantidad'));

					if($cantidad > $existencias)
					{
						$salida['modo'] = 1;

						$mensaje = 'Existencias: '.$existencias.'.';
					}

					$salida['mensaje'] = $mensaje;

					echo json_encode($salida);
					
					break;
				}

				case 'verificar_existencias_id':
				{
					$salida['modo'] = 0;
					$mensaje = '';
					$data_articulos = $requerimientos->getDataAlmacen($_POST['id']);

					foreach($data_articulos as $lista)
					{
						$cantidad = intval($lista['cantidad']);
						$existencias = intval($articulos->getValorId($lista['articulo'], 'cantidad'));
						$nombre = $articulos->getValorId($lista['articulo'], 'nombre');

						if($cantidad > $existencias)
						{
							$salida['modo'] = 1;

							$mensaje .= $nombre.': '.$existencias.' existencias.<br>';
						}
					}

					$salida['mensaje'] = $mensaje;

					echo json_encode($salida);
					
					break;
				}

				case 'crear':
				{
					$id_permiso = 0;

					if(trim($_POST['destinatario']) == 'admin')
					{
						$id_permiso = 1;
					}

					if(trim($_POST['destinatario']) == 'sistemas')
					{
						$id_permiso = 2;
					}

					if(trim($_POST['destinatario']) == 'campo')
					{
						$id_permiso = 3;
					}

					if(trim($_POST['destinatario']) == 'puntos_atencion')
					{
						$id_permiso = 4;
					}

					if(trim($_POST['destinatario']) == 'almacen')
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
					$modo = $requerimientos->getValorId($_POST['id'], 'destinatario');

					echo $requerimientos->update($_POST['id'], $_POST['opcion'], $_POST['cantidad'], $_POST['punto'], $_POST['descripcion'], $modo);
					
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
					$data_articulos = $requerimientos->getDataAlmacen($_POST['id']);

					echo $requerimientos->procesar($_POST['id'], $_POST['observaciones'], $data_articulos);
					
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
