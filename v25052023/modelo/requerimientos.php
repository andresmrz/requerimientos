
<?php 

include_once 'conexion/conexion.php';
include_once 'conexion/conexion_p3.php';

date_default_timezone_set('America/Bogota');

class Requerimientos
{
    private $conexion;
    private $conexion_p3;
    private $id_usuario;
    private $fecha_actual;

    function __construct()
    {
        $this->conexion = new Conexion();
        $this->conexion_p3 = new Conexion_p3();
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
    
    function insert($destinatario, $opcion, $cantidad, $punto, $descripcion, $correo) // guarda en la bd un nuevo dato
    {
        $this->conexion->conectar();
        $correo_asunto = '';

        if(trim($destinatario == 'almacen'))
        {
            $this->conexion->ejecutar("INSERT INTO datos(destinatario, descripcion, user_create, date_create, date_update) 
                                    VALUES('$destinatario', '$descripcion', $this->id_usuario, '$this->fecha_actual', '$this->fecha_actual')");
            
            $datos = explode('**', $opcion);
            $id = $this->conexion->obtenerInsertId();

            $correo_asunto .= '<b>Lista de Articulos: </b><br><br>';

            for($i = 0;$i < sizeof($datos); $i++)
            {
                $valor = explode('++', $datos[$i]);
                $articulo = $valor[0];
                $cantidad = $valor[1];
                $articuloNombre = $valor[2];

                $correo_asunto .= '<b>'.$articuloNombre.': </b>'.$cantidad.'<br>';

                $this->conexion->ejecutar("INSERT INTO datos_almacen(datos, articulo, cantidad) VALUES($id, $articulo, $cantidad)");
            }

            $this->conexion->ejecutar("INSERT INTO historial_bd(usuario, detalle, fecha) VALUES($this->id_usuario,'genero el requerimiento $id','$this->fecha_actual')");
        }
        else
        {
            $correo_asunto .= '<b>Asunto: </b>'.$opcion.'<br>';

            if($opcion == 'COMPUTADOR' || $opcion == 'IMPRESORA')
            {
                $correo_asunto .= '<b>Cantidad: </b>'.$cantidad.'<br>';
            }

            $correo_asunto .= '<b>Punto: </b>'.$punto.'<br>';

            $cantidad = ((trim($cantidad) == '')?'null':"$cantidad");

            $this->conexion->ejecutar("INSERT INTO datos(destinatario, opcion, cantidad, punto, descripcion, user_create, date_create, date_update) 
                                    VALUES('$destinatario', '$opcion', $cantidad, '$punto', '$descripcion', $this->id_usuario, '$this->fecha_actual', '$this->fecha_actual')");
            
            $id = $this->conexion->obtenerInsertId();

            $this->conexion->ejecutar("INSERT INTO historial_bd(usuario, detalle, fecha) VALUES($this->id_usuario,'genero el requerimiento $id','$this->fecha_actual')");
        }

        if($correo != '')
        {
            $to = $correo;

            $subject = "Creacion de Requerimiento";
            $headers = "From: procesos@calivirtual.net\r\nMIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            
            $message = '<html lang="es" id="html">
            <head>
                <title>Sisben Requerimientos</title>
            
                <meta charset="utf-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, user-scalable=1.0, initial-scale=1.0, maximum-scale=3.0, minimum-scale=1.0">
                <meta name="description" content="">
            
                <style>
                    .contenedor
                    {
                        padding: 100px 0;
                        background-color: #f1f1f1;
                        font-family: -webkit-pictograph;
                    }
            
                    .logo
                    {
                        margin-top: 50px;
                    }
            
                    .logo img
                    {
                        position: relative;
                        width: 340px;
                    }
            
                    .titulo
                    {
                        position: relative;
                        margin: 70px 0 50px 0;
                        text-align: center;
                        font-size: 40px;
                    }
            
                    .mensaje
                    {
                        position: relative;
                        width: 500px;
                        background: white;
                        padding: 60px;
                        font-size: 20px;
                        margin-top: 50px;
                        text-align: left;
                    }
            
                    .mensaje a
                    {
                        text-decoration: none;
                        color: #246bed;
                    }
                </style>
            
            </head>
            <body>
                <div class="contenedor">
                    <div class="contenedor-principal">
                        <div class="logo">
                            <center>
                                <img src="https://calivirtual.net/images/favicon_v2.png" alt="">
                            </center>
                        </div>
            
                        <div class="titulo">
                            Notificación de creación de un requerimiento
                        </div>
            
                        <center>
                            <div class="mensaje">
                                Hola,
                                <br><br>
                                Se registro en el portal <a href="https://calivirtual.net/requerimientos" target="_blank">Sisben Requerimientos</a> la creación de un requerimiento.
                                <br><br>
                                '.$correo_asunto.'
                                <b>Descripción: </b> '.$descripcion.'<br>           
                            </div>
                        </center>
                    </div>
                </div>
            </body>';
            
            if(mail($to, $subject, $message, $headers))
            {
                echo '';
            }
            else
            {
                echo '';
            }
        }

        $this->conexion->desconectar();

        return '0';
    }

    function update($id, $opcion, $cantidad, $punto, $descripcion, $modo) // actualiza los valores del dato en la bd
    {
        $cantidad = ((trim($cantidad) == '')?'null':"$cantidad");

        $this->conexion->conectar();
        
        if($modo == 'almacen')
        {
            $this->conexion->ejecutar("UPDATE datos SET descripcion = '$descripcion', date_update = '$this->fecha_actual' WHERE id = $id limit 1");
            $this->conexion->ejecutar("DELETE FROM datos_almacen WHERE datos = $id");
            
            $datos = explode('**', $opcion);

            for($i = 0;$i < sizeof($datos); $i++)
            {
                $valor = explode('++', $datos[$i]);
                $articulo = $valor[0];
                $cantidad = $valor[1];
                $articuloNombre = $valor[2];

                $this->conexion->ejecutar("INSERT INTO datos_almacen(datos, articulo, cantidad) VALUES($id, $articulo, $cantidad)");
            }
        }
        else
        {
            $this->conexion->ejecutar("UPDATE datos SET opcion = '$opcion', cantidad = $cantidad, punto = '$punto', descripcion = '$descripcion', date_update = '$this->fecha_actual' WHERE id = $id limit 1");
        }

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

    function procesar($id, $observaciones, $data_articulos) // actualiza un dato de la bd
    {
        $this->conexion->conectar();
        $this->conexion_p3->conectar();
        
        $this->conexion->ejecutar("UPDATE datos set estado = 1, observaciones_solucion = '$observaciones', date_solucion = '$this->fecha_actual' WHERE id = $id limit 1");

        foreach($data_articulos as $lista)
        {
            $articulo = $lista['articulo'];
            $cantidad = intval($lista['cantidad']);

            $this->conexion_p3->ejecutar("UPDATE articulos set cantidad = (cantidad - $cantidad) WHERE id = $articulo limit 1");
        }

        $this->conexion->ejecutar("INSERT INTO historial_bd(usuario,detalle,fecha) VALUES($this->id_usuario,'proceso requerimiento ($id)','$this->fecha_actual')");

        $this->conexion->desconectar();
        $this->conexion_p3->desconectar();

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

    function getDataAlmacen($requerimiento) // retorna todos los datos de la bd
    {
        $sql = "SELECT * FROM datos_almacen WHERE datos = $requerimiento";

        $this->conexion->conectar();
        $result = $this->conexion->consultar($sql);
        $this->conexion->desconectar();

        return $result;
    }

    function getDataArrayAlmacen($requerimiento) // retorna todos los datos de la bd
    {
        $sql = "SELECT * FROM datos_almacen WHERE datos = $requerimiento";
        $salida = array();

        $this->conexion->conectar();
        $result = $this->conexion->consultar($sql);

        foreach($result as $lista)
        {
            $salida = array_merge($salida, 
            [
                [
                    'articulo' => $lista['articulo'],
                    'cantidad' => $lista['cantidad']
                ]
            ]);
        }

        $this->conexion->desconectar();

        return json_encode($salida);
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