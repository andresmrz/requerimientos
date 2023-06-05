
<?php 

include_once 'conexion/conexion.php';

date_default_timezone_set('America/Bogota');

class OpcionesSistemas
{
    private $conexion;
    private $id_usuario;
    private $fecha_actual;

    function __construct()
    {
        $this->conexion = new Conexion();
        $this->fecha_actual = date('Y-m-d H:i:s');

        if(isset($_SESSION['requerimientos_usuario']))
        {
            $this->id_usuario = $_SESSION['requerimientos_usuario'];
        }
    }

    function existe($nombre) // verifica la existencia del valor en la base de datos
    {
        $this->conexion->conectar();
        $result = $this->conexion->consultar("SELECT count(id) as cantidad FROM opciones_sistemas WHERE nombre = '$nombre'");
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
    
    function insert($nombre, $descripcion) // guarda en la bd un nuevo dato
    {
        $this->conexion->conectar();
        $this->conexion->ejecutar("INSERT INTO opciones_sistemas(nombre, descripcion, user_create, date_create, date_update) 
                                    VALUES('$nombre', '$descripcion', $this->id_usuario, '$this->fecha_actual', '$this->fecha_actual')");

        $id = $this->conexion->obtenerInsertId();

        $this->conexion->ejecutar("INSERT INTO historial_bd(usuario, detalle, fecha) VALUES($this->id_usuario,'creo la opcion de sistemas $id','$this->fecha_actual')");
        $this->conexion->desconectar();

        return '0';
    }

    function update($id, $nombre, $descripcion, $estado) // actualiza los valores del dato en la bd
    {                
        $this->conexion->conectar();
        $this->conexion->ejecutar("UPDATE opciones_sistemas SET nombre = '$nombre', descripcion = '$descripcion', estado = $estado, date_update = '$this->fecha_actual' WHERE id = $id limit 1");

        $this->conexion->ejecutar("INSERT INTO historial_bd(usuario,detalle,fecha) VALUES($this->id_usuario,'actualizo la opcion de sistemas $id','$this->fecha_actual')");

        $this->conexion->desconectar();

        return '0';
    }

    function drop($id) // elimina un dato de la bd
    {
        $this->conexion->conectar();
        $this->conexion->ejecutar("DELETE FROM opciones_sistemas WHERE id = $id limit 1");

        $this->conexion->ejecutar("INSERT INTO historial_bd(usuario,detalle,fecha) VALUES($this->id_usuario,'elimino la opcion de sistemas ($id)','$this->fecha_actual')");

        $this->conexion->desconectar();

        return '0';
    }

    ////////////// data individual //////////////////////

    function getData() // retorna todos los datos de la bd
    {
        $sql = "SELECT * FROM opciones_sistemas ORDER BY nombre ASC";

        $this->conexion->conectar();
        $result = $this->conexion->consultar($sql);
        $this->conexion->desconectar();

        return $result;
    }

    function getValorId($id, $valor) // retorna los valores de un dato
    {
        $this->conexion->conectar();
        $result = $this->conexion->consultar("SELECT $valor from opciones_sistemas WHERE id = '$id' limit 1");
        $row = mysqli_fetch_assoc($result);
        $this->conexion->desconectar();

        return $row[$valor];
    }

    function setValorId($id, $campo, $valor) // actualiza un valor de un dato
    {
        $this->conexion->conectar();
        $result = $this->conexion->consultar("update opciones_sistemas set $campo = $valor WHERE id = '$id' limit 1");
        $this->conexion->desconectar();

        return '';
    }
}

?>