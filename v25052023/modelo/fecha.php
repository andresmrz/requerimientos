<?php 

	date_default_timezone_set('America/Bogota');
	
	class Fecha
	{
		private $meses;
		private $dias;

		function __construct()
		{
			$this->meses = ['','Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];

			$this->dias = ['Domingo','Lunes','Martes','Míercoles','Jueves','Viernes','Sabado'];
		}

		function formatoFecha($formato)
		{
			return date($formato);
		}

		function cambiarFormatoFecha($fecha,$formato)
		{
			$datos = date_create($fecha);

			return $datos->format($formato);
		}

		/////////////////////////////////////

		function obtenerMes($valorNumerico)
		{
			return $this->meses[$valorNumerico];
		}

		function obtenerDiaSemana($valorNumerico)
		{
			return $this->dias[$valorNumerico];
		}

		/////////////// fecha //////////////////

		function obtenerFecha($separador)
		{
			if($separador == '')
			{
				return date('Y-m-d');
			}
			else
			{
				return date('Y'.$separador.'m'.$separador.'d');
			}
		}

		function fechaCompleta($fecha)
		{
			if($fecha == '')
			{
				return $this->dias[date('w')].' '.date('j').' '.' de '.$this->meses[date('n')].' del '.date('Y');
			}
			else
			{
				$datos = date_create($fecha);

				return $this->dias[$datos->format('w')].' '.$datos->format('j').' '.' de '.$this->meses[$datos->format('n')].' del '.$datos->format('Y');
			}
		}

		function soloFecha($fecha, $indice = 0)
		{
			$dia = 'j';

			if($indice == 1)
			{
				$dia = 'd';
			}

			if($fecha == '')
			{
				return date($dia).' '.' de '.$this->meses[date('m')].' del '.date('Y');
			}
			else
			{
				$datos = date_create($fecha);

				return $datos->format($dia).' '.' de '.$this->meses[$datos->format('n')].' del '.$datos->format('Y');
			}
		}

		function soloMes($mes)
		{
			if($mes == '')
			{
				return $this->meses[date('m')].' del '.date('Y');
			}
			else
			{
				$datos = date_create($mes);

				return $this->meses[$datos->format('n')].' del '.$datos->format('Y');
			}
		}

		///////////////// tiempo //////////////////

		function obtenerTiempo($separador)
		{
			if($separador == '')
			{
				return date('H-i-s');
			}
			else
			{
				return date('H'.$separador.'i'.$separador.'s');
			}
		}

		function tiempoCompleto($tiempo)
		{
			if($tiempo == '')
			{
				return date('g:i:s a');
			}
			else
			{
				$datos = date_create($tiempo);

				return $datos->format('g:i:s a');
			}
		}

		function totalHoras($fecha1,$fecha2)
		{
			
		}

		////////////////    //////////////////////////

		function invertir($fecha)
		{
			$fecha = explode('-',$fecha);

			return $fecha[2].'-'.$fecha[1].'-'.$fecha[0];
		}

		function calcularEdad($fecha)
		{
			$fechaInicial = date_create($fecha);
			$fechaFinal = date_create($this->formatoFecha('Y-m-d')); /// obtiene la fecha de hoy

			$edad = 0;

			$edad += ($fechaFinal->format('Y') - $fechaInicial->format('Y')); // obtiene el dato de año de cada fecha y los resta

			if($fechaInicial->format('n') <= $fechaFinal->format('n')) // obtiene el dato mes de cada fecha y compara si el mes en el que cumple años ya paso
			{
				if($fechaInicial->format('j') > $fechaFinal->format('j')) // obtiene el dato dia de cada fecha y compara si el dia en el que cumple años ya paso
				{
					$edad--; // resta 1 al total de la resta de los años obtenido anteriormente en caso de no haber cumplido años aun
				}
			}

			return $edad; 
		}

		function fechaAndHora($fecha)
		{
			if($fecha == '')
			{
				return $this->dias[date('w')].' '.date('j').' '.' de '.$this->meses[date('n')].' del '.date('Y').', '.date('g:i:s a');
			}
			else
			{
				$datos = date_create($fecha);

				return $this->dias[$datos->format('w')].' '.$datos->format('j').' '.' de '.$this->meses[$datos->format('n')].' del '.$datos->format('Y').', '.$datos->format('g:i:s a');
			}
		}
	}
	
 ?>