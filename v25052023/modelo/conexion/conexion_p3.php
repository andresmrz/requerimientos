<?php 

	include_once '../../../config/config_p3.php';

	class Conexion_p3
	{
	    private $consulta; //aquí se guarda las consultas que se realizan
	    private $conexion; //aquí se almacena la conexión con la bd, sí se ha producido
	    private $resultado; //aquí se guardan los datos que se generen de una consulta
	     
	    //constructor, donde se inicializan las variables
	     
	    function __construct()
	    {
	        
	    }
	     
	    //conectamos con la base de datos
	    function conectar()
	    {
	        //se realiza la conexión a la base de datos
	        if($this->conexion = mysqli_connect(HOST_P3, USER_P3, PASS_P3, DBNAME_P3))
	        {
	        	mysqli_set_charset($this->conexion,'utf8');
                //Sí es correcta muestra mensaje (sí quieres lo quitas, sólo sirve para ver si funciona).
                return true;
	        }
	        else
	        {
	            //Si falla la conexión con la base de datos se muestra el mensaje
	            echo "No se ha podido conectar a la BD, <b>ERROR:</b> ".mysqli_connect_error();
	        }                 
	    }

	    function obtenerConexion()
	    {
	    	return $this->conexion;
	    }

	    function obtenerInsertId()
	    {
	    	return mysqli_insert_id($this->conexion);
	    }
	     
	    //function consultas a la bd
	    function consultar($sql)
	    {
	        //aquí se realizan las consultas a la base de datos
	        $query = $this->consulta = mysqli_query($this->conexion,$sql);
	        return $query;
	    }
	     
	    //obtener resultados de la consulta
	    function obtenerConsulta()
	    {
	        //aquí se obtienen los datos de la consulta
	        $this->resultado = mysqli_fetch_array($this->consulta);
	        return $this->resultado;
	    }

	    function ejecutar($sql)
	    {
	    	//aqui se ejecutan sentencias
	    	mysqli_query($this->conexion,$sql);
	    }
	     
	    //cerramos la conexión con la base de datos
	    function desconectar()
	    {
	        mysqli_close($this->conexion);
	    }
	}

 ?>