
<?php 

include_once 'conexion/conexion_p3.php';

date_default_timezone_set('America/Bogota');

class Articulos
{
    private $conexion;
    private $id_usuario;
    private $fecha_actual;

    function __construct()
    {
        $this->conexion = new Conexion_p3();
        $this->fecha_actual = date('Y-m-d H:i:s');

        if(isset($_SESSION['requerimientos_usuario']))
        {
            $this->id_usuario = $_SESSION['requerimientos_usuario'];
        }
    }

    function existe($nombre) // verifica la existencia del valor en la base de datos
    {
        $this->conexion->conectar();
        $result = $this->conexion->consultar("SELECT count(id) as cantidad FROM articulos WHERE nombre = '$nombre'");
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

    ////////////// data individual //////////////////////

    function getData() // retorna todos los datos de la bd
    {
        $sql = "SELECT * from articulos ORDER BY nombre ASC";

        $this->conexion->conectar();
        $result = $this->conexion->consultar($sql);
        $this->conexion->desconectar();

        return $result;
    }

    function getDataToArray()
    {
        $this->conexion->conectar();
        $result = $this->conexion->consultar("SELECT * from articulos ORDER BY nombre ASC");
        $this->conexion->desconectar();

        $salida = array();

        foreach($result as $lista)
        {
            $id = trim($lista['id']);

            $pivot = 
            [
                "id" => $id,
                'nombre' => $lista['nombre']
            ];

            $salida = array_merge($salida, ["id_$id" => $pivot]);
        }

        return $salida;
    }

    function getValorId($id, $valor) // retorna los valores de un dato
    {
        $this->conexion->conectar();
        $result = $this->conexion->consultar("SELECT $valor from articulos WHERE id = '$id' limit 1");
        $row = mysqli_fetch_assoc($result);
        $this->conexion->desconectar();

        return $row[$valor];
    }
}

?>