
<?php
	
	session_start();

	include_once '../../modelo/usuario.php';
	include_once '../../modelo/articulos.php';
	include_once '../../modelo/requerimientos.php';
	include_once '../../modelo/opciones_sistemas.php';
	include_once '../../modelo/opciones_campo.php';
	include_once '../../modelo/opciones_puntos_atencion.php';

	if(isset($_SESSION['requerimientos_usuario']))
	{
		if(isset($_POST['action']))
		{
			$action = trim($_POST['action']);
			$usuario = new Usuario();
			$articulos = new Articulos();
			$requerimientos = new Requerimientos();
			$opciones_sistemas = new OpcionesSistemas();
			$opciones_campo = new OpcionesCampo();
			$opciones_puntos_atencion = new OpcionesPuntosAtencion();

			$view_requerimientos = new stdClass();
			$view_alert = new stdClass();
			$template = '';
			
			$permisos = intval($usuario->getPermisos($_SESSION['requerimientos_usuario']));

			switch($action)
			{
				case 'index':
				{
					if($permisos == 1 || $permisos == 2 || $permisos == 3 || $permisos == 4 || $permisos == 5)
					{
						$view_requerimientos->lista = $requerimientos->getData();
						$view_requerimientos->usuarios = $usuario->getAuxiliaresToArray();

						$template = '../../vista/templates/requerimientos/index.php';
					}

					break;
				}

				case 'ver':
				{
					$view_requerimientos->usuarios = $usuario->getAuxiliaresToArray();

					$view_requerimientos->id = $_POST['id'];
					$view_requerimientos->modo = $requerimientos->getValorId($_POST['id'], 'destinatario');
					$view_requerimientos->opcion = $requerimientos->getValorId($_POST['id'], 'opcion');
					$view_requerimientos->cantidad = $requerimientos->getValorId($_POST['id'], 'cantidad');
					$view_requerimientos->punto = $requerimientos->getValorId($_POST['id'], 'punto');
					$view_requerimientos->descripcion = $requerimientos->getValorId($_POST['id'], 'descripcion');
					$view_requerimientos->estado = intval($requerimientos->getValorId($_POST['id'], 'estado'));
					$view_requerimientos->observaciones_solucion = $requerimientos->getValorId($_POST['id'], 'observaciones_solucion');
					$view_requerimientos->fecha_solucion = $requerimientos->getValorId($_POST['id'], 'date_solucion');
					$view_requerimientos->user_create = $requerimientos->getValorId($_POST['id'], 'user_create');
					$view_requerimientos->fecha = $requerimientos->getValorId($_POST['id'], 'date_create');

					if($permisos == 1 || $permisos == 2 || $permisos == 3 || $permisos == 4 || $permisos == 5)
					{
						switch($view_requerimientos->modo)
						{
							case 'sistemas':
							{
								$template = '../../vista/templates/requerimientos/sistemas/ver.php';

								break;
							}

							case 'campo':
							{
								$template = '../../vista/templates/requerimientos/campo/ver.php';

								break;
							}

							case 'puntos_atencion':
							{
								$template = '../../vista/templates/requerimientos/puntos_atencion/ver.php';

								break;
							}

							case 'almacen':
							{
								$view_requerimientos->almacen = $requerimientos->getDataAlmacen($view_requerimientos->id);
								$view_requerimientos->articulos = $articulos->getDataToArray();

								$template = '../../vista/templates/requerimientos/almacen/ver.php';

								break;
							}

							default:
							{
								break;
							}
						}
					}

					break;
				}

				case 'crear':
				{
					if($permisos == 1 || $permisos == 2 || $permisos == 3 || $permisos == 4 || $permisos == 5)
					{
						$template = '../../vista/templates/requerimientos/crear.php';
					}

					break;
				}

				case 'editar':
				{
					$view_requerimientos->id = $_POST['id'];
					$view_requerimientos->modo = $requerimientos->getValorId($_POST['id'], 'destinatario');
					$view_requerimientos->opcion = $requerimientos->getValorId($_POST['id'], 'opcion');
					$view_requerimientos->cantidad = $requerimientos->getValorId($_POST['id'], 'cantidad');
					$view_requerimientos->punto = $requerimientos->getValorId($_POST['id'], 'punto');
					$view_requerimientos->descripcion = $requerimientos->getValorId($_POST['id'], 'descripcion');

					$view_requerimientos->list_opciones = [];
					$view_requerimientos->list_puntos = [];

					if($permisos == 1 || $permisos == 2 || $permisos == 3 || $permisos == 4 || $permisos == 5)
					{
						switch($view_requerimientos->modo)
						{
							case 'sistemas':
							{
								$view_requerimientos->list_opciones = $opciones_sistemas->getData();
								$view_requerimientos->list_puntos = $usuario->getPuntosCali();
								$template = '../../vista/templates/requerimientos/sistemas/editar.php';

								break;
							}

							case 'campo':
							{
								$view_requerimientos->list_opciones = $opciones_campo->getData();
								$view_requerimientos->list_puntos = $usuario->getPuntosCali();
								$template = '../../vista/templates/requerimientos/campo/editar.php';

								break;
							}

							case 'puntos_atencion':
							{
								$view_requerimientos->list_opciones = $opciones_puntos_atencion->getData();
								$view_requerimientos->list_puntos = $usuario->getPuntosCali();
								$template = '../../vista/templates/requerimientos/puntos_atencion/editar.php';

								break;
							}

							case 'almacen':
							{
								$view_requerimientos->list_opciones = $articulos->getDataToArray();
								$view_requerimientos->list_puntos = $usuario->getPuntosCali();
								$view_requerimientos->data_articulos = $requerimientos->getDataArrayAlmacen($view_requerimientos->id);
								$template = '../../vista/templates/requerimientos/almacen/editar.php';

								break;
							}

							default:
							{
								break;
							}
						}
					}

					break;
				}

				case 'datos':
				{
					$view_requerimientos->list_opciones = [];
					$view_requerimientos->list_puntos = [];
					$view_requerimientos->modo = $_POST['modo'];

					if($permisos == 1 || $permisos == 2 || $permisos == 3 || $permisos == 4 || $permisos == 5)
					{
						switch($_POST['modo'])
						{
							case 'sistemas':
							{
								$view_requerimientos->list_opciones = $opciones_sistemas->getData();
								$view_requerimientos->list_puntos = $usuario->getPuntosCali();
								$template = '../../vista/templates/requerimientos/sistemas/crear.php';

								break;
							}

							case 'campo':
							{
								$view_requerimientos->list_opciones = $opciones_campo->getData();
								$view_requerimientos->list_puntos = $usuario->getPuntosCali();
								$template = '../../vista/templates/requerimientos/campo/crear.php';

								break;
							}

							case 'puntos_atencion':
							{
								$view_requerimientos->list_opciones = $opciones_puntos_atencion->getData();
								$view_requerimientos->list_puntos = $usuario->getPuntosCali();
								$template = '../../vista/templates/requerimientos/puntos_atencion/crear.php';

								break;
							}

							case 'almacen':
							{
								$view_requerimientos->list_opciones = $articulos->getData();
								$view_requerimientos->list_puntos = $usuario->getPuntosCali();
								$template = '../../vista/templates/requerimientos/almacen/crear.php';

								break;
							}

							default:
							{
								break;
							}
						}
					}

					break;
				}

				case 'procesar':
				{
					if($permisos == 1 || $permisos == 2 || $permisos == 3 || $permisos == 4 || $permisos == 5)
					{
						$view_requerimientos->id = $_POST['id'];
						$view_requerimientos->modo = $requerimientos->getValorId($_POST['id'], 'destinatario');
						$view_requerimientos->opcion = $requerimientos->getValorId($_POST['id'], 'opcion');
						$view_requerimientos->cantidad = $requerimientos->getValorId($_POST['id'], 'cantidad');
						$view_requerimientos->punto = $requerimientos->getValorId($_POST['id'], 'punto');
						$view_requerimientos->descripcion = $requerimientos->getValorId($_POST['id'], 'descripcion');

						$view_requerimientos->almacen = $requerimientos->getDataAlmacen($view_requerimientos->id);
						$view_requerimientos->articulos = $articulos->getDataToArray();

						$template = '../../vista/templates/requerimientos/procesar.php';
					}

					break;
				}

				case 'rechazar':
				{
					if($permisos == 1 || $permisos == 2 || $permisos == 3 || $permisos == 4 || $permisos == 5)
					{
						$view_requerimientos->id = $_POST['id'];
						$view_requerimientos->modo = $requerimientos->getValorId($_POST['id'], 'destinatario');
						$view_requerimientos->opcion = $requerimientos->getValorId($_POST['id'], 'opcion');
						$view_requerimientos->cantidad = $requerimientos->getValorId($_POST['id'], 'cantidad');
						$view_requerimientos->punto = $requerimientos->getValorId($_POST['id'], 'punto');
						$view_requerimientos->descripcion = $requerimientos->getValorId($_POST['id'], 'descripcion');

						$view_requerimientos->almacen = $requerimientos->getDataAlmacen($view_requerimientos->id);
						$view_requerimientos->articulos = $articulos->getDataToArray();

						$template = '../../vista/templates/requerimientos/rechazar.php';
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
