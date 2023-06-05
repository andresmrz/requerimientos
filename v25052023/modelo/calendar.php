<?php

// Developed by Artyom from <tutofox/>

class Calendar
{
  public static function calendar_month($month)
  {
    //$mes = date("Y-m");
    $mes = $month;

    $nextmonth = date("Y-M",strtotime($mes."+ 1 month")); // se obtine el siguiente mes
    $lastmonth = date("Y-M",strtotime($mes."- 1 month")); // se obtine el mes anterios
    $month = date("M",strtotime($mes)); // se obtiene el nombre del mes
    $yearmonth = date("Y",strtotime($mes)); // se obtine año
    //$month = date("M",strtotime("2019-03"));
    //
    
    $calendario = array();

    $dato_fecha_inicial = date("Y-m-d", strtotime("first day of ".$mes)); //fecha del  primer dia del mes
    $dato_fecha_final = date("Y-m-d", strtotime("last day of ".$mes)); // fecha del ultimo dia del mes

    $dia_semana_inicial = intval(date("N",strtotime($dato_fecha_inicial))); // dia de la semana (1-7, 7 = domingo) del primer dia del mes 
    $dia_semana_final = intval(date("N",strtotime($dato_fecha_final))); // dia de la semana (1-7, 7 = domingo) del ultimo dia del mes

    $fecha_inicial = date("Y-m-d",strtotime("$dato_fecha_inicial - ".($dia_semana_inicial - 1)." day")); // dia donde se iniciar el calendario
    $fecha_final = date("Y-m-d",strtotime("$dato_fecha_final + ".(7 - $dia_semana_final)." day")); // dia donde debe terminar el calendario

    $dia_semana = 0;
    $semana = 1;
    $weekdata = [];

    while($fecha_inicial <= $fecha_final)
    {
      $dia_semana++;

      $datanew['mes'] = date("M", strtotime($fecha_inicial));
      $datanew['dia'] = date("d", strtotime($fecha_inicial));
      $datanew['fecha'] = $fecha_inicial; 

      array_push($weekdata,$datanew);
      $fecha_inicial = date("Y-m-d",strtotime("$fecha_inicial + 1 day"));

      if($dia_semana == 7)
      {
        $dataweek['semana'] = $semana;
        $dataweek['datos'] = $weekdata;
        array_push($calendario,$dataweek);

        $dia_semana = 0;
        $semana++;
        $weekdata = [];
      }
    }

    $data = array
    (
      'next' => $nextmonth,
      'month'=> $month,
      'year' => $yearmonth,
      'last' => $lastmonth,
      'calendar' => $calendario,
    );

    return $data;
  }

  public static function spanish_month($month)
  {
    switch($month)
    {
      case "Jan":
      {
        $mes = "Enero";

        break;
      }
      case "Feb": 
      {
        $mes = "Febrero";

        break;
      }
      case "Mar": 
      {
        $mes = "Marzo";

        break;
      }
      case "Apr":
      {
        $mes = "Abril";

        break;
      }
      case "May":
      {
        $mes = "Mayo";

        break;
      }
      case "Jun":
      {
        $mes = "Junio";

        break;
      }
      case "Jul":
      {
        $mes = "Julio";

        break;
      }
      case "Aug":
      {
        $mes = "Agosto";

        break;
      }
      case "Sep":
      {
        $mes = "Septiembre";

        break;
      }
      case "Oct":
      {
        $mes = "Octubre";

        break;
      }
      case "Nov":
      {
        $mes = "Noviembre";

        break;
      }
      case "Dec":
      {
        $mes = "Diciembre";

        break;
      }
      default:
      {
        $mes = $month;

        break;
      }
    }

    return $mes;
  }


}
 ?>
