
<?php 

	include_once 'conexion/conexion.php';
	include_once 'conexion/conexion_p2.php';

	date_default_timezone_set('America/Bogota');

	class Usuario
	{
		private $conexion;
		private $conexion_p2;
		private $id_usuario;
		private $fecha_actual;

		function __construct()
		{
			$this->conexion = new Conexion();
			$this->conexion_p2 = new Conexion_p2();
			$this->fecha_actual = date('Y-m-d H:i:s');

			if(isset($_SESSION['requerimientos_usuario']))
			{
				$this->id_usuario = $_SESSION['requerimientos_usuario'];
			}
		}

		////////////////////

		function existe_permisos($usuario)
		{
			$this->conexion->conectar();
			$result = $this->conexion->consultar("SELECT count(id) as cantidad FROM permisos WHERE usuario = $usuario");
			$row = mysqli_fetch_assoc($result);
			$this->conexion->desconectar();

			if(intval($row['cantidad']) > 0)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		 
		/////////////////////////
		
		function filtro($texto)
		{
			$salida = array();

			if(strlen($texto) >= 3)
			{
				$this->conexion->conectar();
				$result = $this->conexion->consultar("SELECT usuario.id, usuario.cedula, usuario.nombre, usuario.estado, ciudad.nombre as ciudad FROM usuario inner join ciudad on usuario.ciudad = ciudad.id WHERE (usuario.nombre like '%$texto%' or usuario.cedula like '$texto%') and usuario.permisos = 0 ORDER BY usuario.nombre ASC limit 10");

				foreach($result as $lista)
				{
					$result_solicitud = $this->conexion->consultar("SELECT COUNT(id) as cantidad from solicitudes where usuario = ".$lista['id']." and (estado = 0 or estado = 3)");
					$row = mysqli_fetch_assoc($result_solicitud);	

					$salida[] = array("value" => strtoupper($lista['nombre']).' ('.trim($lista['cedula']).')', "id" => trim($lista['id']), "nombre" => strtoupper($lista['nombre']), "estado" => $lista['estado'], "ciudad" => $lista['ciudad'], "solicitudes" => $row['cantidad']);
				}

				$this->conexion->desconectar();
			}

			return $salida;
		}

		function filtro_usuario($texto, $permisos = null)
		{
			$permisos = (($permisos == null)?'':" and usuario.permisos = $permisos");
			$salida = array();

			if(strlen($texto) >= 3)
			{
				$this->conexion->conectar();
				$result = $this->conexion->consultar("SELECT usuario.id, usuario.cedula, usuario.nombre, usuario.estado, ciudad.nombre as ciudad FROM usuario inner join ciudad on usuario.ciudad = ciudad.id WHERE (usuario.nombre like '%$texto%' or usuario.cedula like '$texto%') $permisos ORDER BY usuario.nombre ASC limit 10");

				foreach($result as $lista)
				{
					$salida[] = array("value" => strtoupper($lista['nombre']).' ('.trim($lista['cedula']).')', "id" => trim($lista['id']), "nombre" => strtoupper($lista['nombre']), "estado" => $lista['estado'], "ciudad" => $lista['ciudad']);
				}

				$this->conexion->desconectar();
			}

			return $salida;
		}

		function filtro_admin($texto)
		{
			$salida = array();

			if(strlen($texto) >= 2)
			{
				$this->conexion->conectar();
				$result = $this->conexion->consultar("SELECT usuario.id, usuario.cedula, usuario.nombre, usuario.estado FROM usuario WHERE (usuario.nombre like '%$texto%' or usuario.cedula like '$texto%') and usuario.permisos = 1 ORDER BY usuario.nombre ASC limit 10");

				foreach($result as $lista)
				{
					$salida[] = array("value" => strtoupper($lista['nombre']).' ('.trim($lista['cedula']).')', "id" => trim($lista['id']), "nombre" => strtoupper($lista['nombre']), "estado" => $lista['estado']);
				}

				$this->conexion->desconectar();
			}

			return $salida;
		}
		
		function getUsuario()
		{
			$this->conexion->conectar();
			$result = $this->conexion->consultar("SELECT usuario.id, usuario.documento, usuario.nombres, usuario.apellidos,usuario.correo, usuario.estado, usuario.permisos FROM usuario ORDER BY concat(usuario.nombres,' ',usuario.apellidos) ASC");
			$this->conexion->desconectar();

			return $result;
		}

		function getAuxiliares()
		{
			$this->conexion_p2->conectar();
			$result = $this->conexion_p2->consultar("SELECT id, nomb_us, cod_usu FROM usuario ORDER BY nomb_us ASC");
			$this->conexion_p2->desconectar();

			return $result;
		}

		function getAuxiliaresToArray()
		{
			$this->conexion_p2->conectar();
			$result = $this->conexion_p2->consultar("SELECT id, nomb_us, cod_usu FROM usuario ORDER BY nomb_us ASC");
			$this->conexion_p2->desconectar();

			$salida = array();

			foreach($result as $lista)
			{
				$id = trim($lista['id']);

				$pivot = 
				[
					"id" => $id,
					'nombre' => $lista['nomb_us']
				];

				$salida = array_merge($salida, ["id_$id" => $pivot]);
			}

			return $salida;
		}

		function getEstados()
		{
			return ["1" => 'Activo', "0" => 'Inactivo'];
		}

		function login($usuario, $password)
		{
			$password = utf8_decode($password);
    		$password = crypt($password, 'S1sb8nPr0c3s0sC4l1*+/#!');
			
			$this->conexion_p2->conectar();
			$this->conexion->conectar();
			$result = $this->conexion_p2->consultar("SELECT COUNT(id) as cantidad from usuario WHERE login = '$usuario' and pass = '$password'");
			$row = mysqli_fetch_assoc($result);

			if(intval($row['cantidad']) > 0)
			{
				$resultId = mysqli_fetch_assoc($this->conexion_p2->consultar("SELECT id from usuario WHERE login = '$usuario' and pass = '$password' limit 1"));
				$rowId = $resultId['id'];
				$this->conexion->ejecutar("INSERT INTO historial_bd(usuario,detalle,fecha) VALUES($rowId,'inicio sesion','$this->fecha_actual')");
			}

			$this->conexion->desconectar();
			$this->conexion_p2->desconectar();

			return intval($row['cantidad']);
		}

		function login2($usuario, $password)
		{
			$password = md5("Apu3st45".$password."App");
			
			$this->conexion->conectar();
			$result = $this->conexion->consultar("SELECT COUNT(id) as cantidad from usuario WHERE (documento = '$usuario' or correo = '$usuario') and password = '$password'");
			$row = mysqli_fetch_assoc($result);

			if(intval($row['cantidad']) > 0)
			{
				$resultId = mysqli_fetch_assoc($this->conexion->consultar("SELECT id from usuario WHERE documento = '$usuario' limit 1"));
				$rowId = $resultId['id'];
				$this->conexion->ejecutar("INSERT INTO historial_bd(usuario,detalle,fecha) VALUES($rowId,'inicio sesion','$this->fecha_actual')");
			}

			$this->conexion->desconectar();

			return "SELECT COUNT(id) as cantidad from usuario WHERE (documento = '$usuario' or correo = '$usuario') and password = '$password'";
		}

		function getIdLogin($usuario, $password)
		{
			$password = utf8_decode($password);
    		$password = crypt($password, 'S1sb8nPr0c3s0sC4l1*+/#!');

			$this->conexion_p2->conectar();
			$result = $this->conexion_p2->consultar("SELECT id from usuario WHERE login = '$usuario' and pass = '$password' limit 1");
			$row = mysqli_fetch_assoc($result);
			$this->conexion_p2->desconectar();

			return $row['id'];
		}

		function getPermisos($usuario)
		{
			$this->conexion->conectar();
			$result = $this->conexion->consultar("SELECT valor from permisos WHERE usuario = '$usuario' limit 1");
			$row = mysqli_fetch_assoc($result);
			$this->conexion->desconectar();

			return $row['valor'];
		}

		function getValor($usuario, $valor)
		{
			$this->conexion_p2->conectar();
			$result = $this->conexion_p2->consultar("SELECT $valor from usuario WHERE cod_usu = '$usuario' limit 1");
			$row = mysqli_fetch_assoc($result);
			$this->conexion_p2->desconectar();

			return $row[$valor];
		}

		function getValorId($id, $valor)
		{
			$this->conexion_p2->conectar();
			$result = $this->conexion_p2->consultar("SELECT $valor from usuario WHERE id = '$id' limit 1");
			$row = mysqli_fetch_assoc($result);
			$this->conexion_p2->desconectar();

			return $row[$valor];
		}

		function getPerfil($id)
		{
			$this->conexion->conectar();
			$result = $this->conexion->consultar("SELECT cedula,nombre,entidad,correo,estado from usuario WHERE id = '$id' limit 1");
			$row = mysqli_fetch_assoc($result);
			$this->conexion->desconectar();

			return $row;
		}

		function getListaUsuariosPermisos($permiso)
		{
			$this->conexion->conectar();
			$this->conexion_p2->conectar();

			$result = $this->conexion_p2->consultar("SELECT id, nomb_us, login, area FROM usuario ORDER BY nomb_us ASC");

			$result_permisos = $this->conexion->consultar("SELECT usuario, valor FROM permisos");
			$data_permisos = array();

			foreach($result_permisos as $lista)
			{
				$data_permisos = array_merge($data_permisos, ['id_'.$lista['usuario'] => $lista['valor']]);
			}

			$this->conexion->desconectar();
			$this->conexion_p2->desconectar();

			return 
			[
				'data_usuarios' => $result,
				'data_permisos' => $data_permisos
			];
		}

		function getListaPermisos()
		{
			$this->conexion->conectar();

			$result_permisos = $this->conexion->consultar("SELECT usuario, valor FROM permisos");
			$data_permisos = array();

			foreach($result_permisos as $lista)
			{
				$data_permisos = array_merge($data_permisos, ['id_'.$lista['usuario'] => $lista['valor']]);
			}

			$this->conexion->desconectar();

			return  $data_permisos;
		}

		function getListaUsuarios()
		{
			$this->conexion_p2->conectar();

			$result = $this->conexion_p2->consultar("SELECT id, nomb_us, login, area FROM usuario");
			$data_usuarios = array();

			foreach($result as $lista)
			{
				$pivot = 
				[
					'id_'.$lista['id'] => 
					[
						'id' => $lista['id'],
						'nombre' => $lista['nomb_us'],
						'login' => $lista['login'],
						'area' => $lista['area']
					]
				];

				$data_usuarios = array_merge($data_usuarios, $pivot);
			}

			$this->conexion_p2->desconectar();

			return $data_usuarios;
		}

		function getPuntosCali()
		{
			$this->conexion_p2->conectar();
			$result = $this->conexion_p2->consultar("SELECT * from puntos_cali ORDER BY nombre ASC");
			$this->conexion_p2->desconectar();

			return $result;
		}

		function getCorreo($permiso)
		{
			$salida = '';

			$this->conexion->conectar();
			$this->conexion_p2->conectar();

			$result = $this->conexion->consultar("SELECT count(id) as cantidad FROM permisos WHERE valor = $permiso");
			$row = mysqli_fetch_assoc($result);

			if(intval($row['cantidad']) > 0)
			{
				$result = $this->conexion->consultar("SELECT usuario FROM permisos WHERE valor = $permiso limit 1");
				$row = mysqli_fetch_assoc($result);
				$id = $row['usuario'];

				$result2 = $this->conexion_p2->consultar("SELECT correo FROM usuario WHERE id = $id limit 1");
				$row2 = mysqli_fetch_assoc($result2);

				$salida = $row2['correo'];
			}

			$this->conexion->desconectar();
			$this->conexion_p2->desconectar();

			return $salida;
		}

		///////////// permisos ///////////////////

		function insert_permisos($usuario, $permisos)
		{
			$this->conexion->conectar();
			$this->conexion->ejecutar("INSERT INTO permisos(usuario, valor, user_create, date_create, date_update) 
										VALUES($usuario, $permisos, $this->id_usuario, '$this->fecha_actual', '$this->fecha_actual')");

			$id = $this->conexion->obtenerInsertId();

			$this->conexion->ejecutar("INSERT INTO historial_bd(usuario, detalle, fecha) VALUES($this->id_usuario,'asigno el permiso $usuario','$this->fecha_actual')");
			$this->conexion->desconectar();

			return '0';
		}

		function update_permisos($usuario, $permisos)
		{        
			$this->conexion->conectar();
			$this->conexion->ejecutar("UPDATE permisos SET valor = $permisos, user_create = $this->id_usuario, date_update = '$this->fecha_actual' WHERE usuario = $usuario limit 1");

			$this->conexion->ejecutar("INSERT INTO historial_bd(usuario,detalle,fecha) VALUES($this->id_usuario,'actualizo el permiso $usuario','$this->fecha_actual')");

			$this->conexion->desconectar();

			return '0';
		}

		///////// historial //////////

		function generarHistorial($detalle)
		{
			$this->conexion->conectar();
			$this->conexion->ejecutar("INSERT INTO historial_bd(usuario,detalle,fecha) VALUES($this->id_usuario,'$detalle','$this->fecha_actual')");
			$this->conexion->desconectar();
		}
	}
?>