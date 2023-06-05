<?php 

	date_default_timezone_set('America/Bogota');
	
	class Metodos
	{
		function __construct()
		{
			
		}

		function ajustarDecimales($valor)
		{
			$valor = intval($valor);
			$negativo = false;

			if($valor < 0)
			{
				$negativo = true;
				$valor *= -1;
			}

			$datos = str_split($valor);
			$salida = '';
			$contador = 0;
			
			for($i = (sizeof($datos) - 1);$i >= 0;$i--)
			{
				$contador++;

				$salida = "$datos[$i]$salida";

				if(($contador % 3) == 0 && $i > 0)
				{
					$salida = ".$salida";
				}
			}

			if($negativo)
			{
				$salida = '-'.$salida; 
			}

			return $salida;
		}

		function cortarDecimales($valor,$cantidad)
		{
			$valor = $valor * 1;
			$datos = explode('.',$valor);
			$salida = '';

			if(sizeof($datos) == 2)
			{
				$decimales = str_split($datos[1]);
				$sizeDecimales = sizeof($decimales);

				if($sizeDecimales >= 2)
				{
					if($sizeDecimales > $cantidad)
					{
						while($sizeDecimales > $cantidad)
						{
							$techo = $decimales[$sizeDecimales - 2] * 1;

							if(($decimales[$sizeDecimales - 1] * 1) >= 5)
							{
								$techo++;
							}

							$pivote = '';

							for($i = 0;$i < ($sizeDecimales - 2);$i++)
							{
								if($i == ($sizeDecimales - 3) && $techo == 10)
								{
									$pivote .= $decimales[$i] + 1;
									$techo = '';
								}
								else
								{
									$pivote .= $decimales[$i];
								}
							}

							$pivote .= $techo;

							$decimales = str_split($pivote);
							$sizeDecimales = sizeof($decimales);
						}

						$salida = $datos[0].'.';

						for($i = 0;$i < $sizeDecimales;$i++)
						{
							$salida .= $decimales[$i];
						}
					}
					else
					{
						$salida = $valor;
					} 
				}
				else
				{
					$salida = $valor;
				}
			}
			else
			{
				$salida = $valor;
			}

			return $salida;
		}

		function colocar_punto_decimal($valor)
		{
			$datos = str_split($valor);
			$salida = '';
			$contador = 0;
			
			for($i = sizeof($datos) - 1;$i >= 0;$i--)
			{
				$contador++;

				if($contador == 4)
				{
					$salida = '.'.$salida;
					$contador = 1;
				}

				$salida = $datos[$i].$salida;
			}

			return $salida;
		}

		function rotarImagen($foto,$nombre, $path)
		{
			$ancho_max = 300;
			$alto_max = 400;

			$ruta_foto = '';

			if(file_exists("$foto"))
			{
				$info = new SplFileInfo($foto);
				$info2 = pathinfo($foto);
				$formato = $info->getExtension();
				$imagen = '';

				if($formato == 'jpg')
				{
					$imagen = imagecreatefromjpeg($foto);
				}

				if($formato == 'png')
				{
					$imagen = imagecreatefrompng($foto);
				}

				$sizeImagen = getimagesize($foto);
				$ruta_foto_rotar = $path.$nombre.'.png';

				$ancho = $sizeImagen[0];
				$alto = $sizeImagen[1];
				$edito = false;

				if($ancho > $alto)
				{
					if($ancho > $ancho_max)
					{
						$edito = true;
						$resolucion = $alto / $ancho;

						$original = $imagen;
						$lienzo = imagecreatetruecolor($ancho_max,intval($resolucion * $ancho_max));
						imagecopyresampled($lienzo,$original,0,0,0,0,$ancho_max,intval($resolucion * $ancho_max),$ancho,$alto);

						$ancho = $ancho_max;
						$alto = intval($resolucion * $ancho_max);

						$imagen = $lienzo;
					}

					if($alto > $alto_max)
					{
						$edito = true;
						$resolucion = $ancho / $alto;

						$original = $imagen;
						$lienzo = imagecreatetruecolor(intval($resolucion * $alto_max),$alto_max);
						imagecopyresampled($lienzo,$original,0,0,0,0,intval($resolucion * $alto_max),$alto_max,$ancho,$alto);

						$ancho = intval($resolucion * $alto_max);
						$alto = $alto_max;

						$imagen = $lienzo;
					}

					$rotar = imagerotate($imagen, -90, 0);
					$imagen = $rotar;
				}
				else
				{
					if($alto > $alto_max)
					{
						$resolucion = $ancho / $alto;

						$original = $imagen;
						$lienzo = imagecreatetruecolor(intval($resolucion * $alto_max),$alto_max);
						imagecopyresampled($lienzo,$original,0,0,0,0,intval($resolucion * $alto_max),$alto_max,$ancho,$alto);

						$ancho = intval($resolucion * $alto_max);
						$alto = $alto_max;

						$imagen = $lienzo;
					}

					if($ancho > $ancho_max)
					{
						$resolucion = $alto / $ancho;

						$original = $imagen;
						$lienzo = imagecreatetruecolor($ancho_max,intval($resolucion * $ancho_max));
						imagecopyresampled($lienzo,$original,0,0,0,0,$ancho_max,intval($resolucion * $ancho_max),$ancho,$alto);

						$ancho = $ancho_max;
						$alto = intval($resolucion * $ancho_max);

						$imagen = $lienzo;
					}
				}

				imagepng($imagen,$ruta_foto_rotar);

				return '0';
			}
			else
			{
				return '1';
			}
		}
	}
	
 ?>