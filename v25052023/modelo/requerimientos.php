
<?php 

include_once 'conexion/conexion.php';

date_default_timezone_set('America/Bogota');

class Requerimientos
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
        $result = $this->conexion->consultar("SELECT count(id) as cantidad FROM datos WHERE nombre = '$nombre'");
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
    
    function insert($asunto, $destinatario, $opcion, $descripcion) // guarda en la bd un nuevo dato
    {
        $this->conexion->conectar();
        $this->conexion->ejecutar("INSERT INTO datos(asunto, destinatario, opcion, descripcion, user_create, date_create, date_update) 
                                    VALUES('$asunto', '$destinatario', '$opcion', '$descripcion', $this->id_usuario, '$this->fecha_actual', '$this->fecha_actual')");

        $id = $this->conexion->obtenerInsertId();

        $this->conexion->ejecutar("INSERT INTO historial_bd(usuario, detalle, fecha) VALUES($this->id_usuario,'genero el requerimiento $id','$this->fecha_actual')");
        $this->conexion->desconectar();

        return '0';
    }

    function update($id, $asunto, $opcion, $descripcion) // actualiza los valores del dato en la bd
    {                
        $this->conexion->conectar();
        $this->conexion->ejecutar("UPDATE datos SET asunto = '$asunto', opcion = '$opcion', descripcion = '$descripcion', date_update = '$this->fecha_actual' WHERE id = $id limit 1");

        $this->conexion->ejecutar("INSERT INTO historial_bd(usuario,detalle,fecha) VALUES($this->id_usuario,'actualizo el requerimiento $id','$this->fecha_actual')");

        $this->conexion->desconectar();

        return '0';
    }

    function drop($id) // elimina un dato de la bd
    {
        $this->conexion->conectar();
        $this->conexion->ejecutar("DELETE FROM datos WHERE id = $id limit 1");

        $this->conexion->ejecutar("INSERT INTO historial_bd(usuario,detalle,fecha) VALUES($this->id_usuario,'elimino el requerimiento ($id)','$this->fecha_actual')");

        $this->conexion->desconectar();

        return '0';
    }

    function enProceso($id) // actualiza un dato de la bd
    {
        $this->conexion->conectar();
        $this->conexion->ejecutar("UPDATE datos set estado = 3, date_solucion = '$this->fecha_actual' WHERE id = $id limit 1");

        $this->conexion->ejecutar("INSERT INTO historial_bd(usuario,detalle,fecha) VALUES($this->id_usuario,'actualizo el estado del requerimiento ($id)','$this->fecha_actual')");

        $this->conexion->desconectar();

        return '0';
    }

    function procesar($id, $observaciones) // actualiza un dato de la bd
    {
        $this->conexion->conectar();
        $this->conexion->ejecutar("UPDATE datos set estado = 1, observaciones_solucion = '$observaciones', date_solucion = '$this->fecha_actual' WHERE id = $id limit 1");

        $this->conexion->ejecutar("INSERT INTO historial_bd(usuario,detalle,fecha) VALUES($this->id_usuario,'proceso requerimiento ($id)','$this->fecha_actual')");

        $this->conexion->desconectar();

        return '0';
    }

    function rechazar($id, $observaciones) // actualiza un dato de la bd
    {
        $this->conexion->conectar();
        $this->conexion->ejecutar("UPDATE datos set estado = 2, observaciones_solucion = '$observaciones', date_solucion = '$this->fecha_actual' WHERE id = $id limit 1");

        $this->conexion->ejecutar("INSERT INTO historial_bd(usuario,detalle,fecha) VALUES($this->id_usuario,'rechazo el requerimiento ($id)','$this->fecha_actual')");

        $this->conexion->desconectar();

        return '0';
    }

    ////////////// data individual //////////////////////

    function getData() // retorna todos los datos de la bd
    {
        $sql = "SELECT * FROM datos ORDER BY date_create ASC";

        $this->conexion->conectar();
        $result = $this->conexion->consultar($sql);
        $this->conexion->desconectar();

        return $result;
    }

    function getValorId($id, $valor) // retorna los valores de un dato
    {
        $this->conexion->conectar();
        $result = $this->conexion->consultar("SELECT $valor from datos WHERE id = '$id' limit 1");
        $row = mysqli_fetch_assoc($result);
        $this->conexion->desconectar();

        return $row[$valor];
    }

    function setValorId($id, $campo, $valor) // actualiza un valor de un dato
    {
        $this->conexion->conectar();
        $result = $this->conexion->consultar("update datos set $campo = $valor WHERE id = '$id' limit 1");
        $this->conexion->desconectar();

        return '';
    }
}

?>