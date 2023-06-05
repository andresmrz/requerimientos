<?php
	
	session_start();

	require_once '../../vista/lb/pdf/vendor/autoload.php';

	use Spipu\Html2Pdf\Html2Pdf;
	use Spipu\Html2Pdf\Exception\Html2PdfException;
	use Spipu\Html2Pdf\Exception\ExceptionFormatter;

	if(isset($_SESSION['requerimientos_usuario']))
	{
		if((isset($_POST['action']) || isset($_GET['action'])) && isset($_POST['path']) || isset($_GET['path']) && isset($_POST['nombre']) || isset($_GET['nombre']))
		{
			$action = (isset($_POST['action']))?trim($_POST['action']):trim($_GET['action']);
			$path = (isset($_POST['path']))?trim($_POST['path']):trim($_GET['path']);
			$nombre = (isset($_POST['nombre']))?trim($_POST['nombre']):trim($_GET['nombre']);

			$view_pdf = new stdClass();

			switch($action)
			{
				case 'devolucion_campo':
				{
					$view_pdf->datos = json_decode($_GET['datos']);
					$view_pdf->cantidad = $_GET['cantidad'];

					try
					{
					    ob_start();
					    include $path;
					    $content = ob_get_clean();

					    $html2pdf = new Html2Pdf('P', 'A4', 'fr', true, 'UTF-8', array(10, 10, 10, 10));
					    $html2pdf->pdf->SetDisplayMode('fullpage');
					    $html2pdf->writeHTML($content);
					    $html2pdf->output($nombre);
					}
					catch (Html2PdfException $e)
					{
					    $html2pdf->clean();

					    $formatter = new ExceptionFormatter($e);
					    echo $formatter->getHtmlMessage();
					}

					break;
				}

				case 'devolucion_puntos':
				{
					$view_pdf->datos = json_decode($_GET['datos']);
					$view_pdf->cantidad = $_GET['cantidad'];

					try
					{
						ob_start();
						include $path;
						$content = ob_get_clean();

						$html2pdf = new Html2Pdf('P', 'A4', 'fr', true, 'UTF-8', array(10, 10, 10, 10));
						$html2pdf->pdf->SetDisplayMode('fullpage');
						$html2pdf->writeHTML($content);
						$html2pdf->output($nombre);
					}
					catch (Html2PdfException $e)
					{
						$html2pdf->clean();

						$formatter = new ExceptionFormatter($e);
						echo $formatter->getHtmlMessage();
					}

					break;
				}

				default:
				{
					break;
				}
			}
		}
	}
	else
	{
		echo 'No se han encontrado tus datos de inicio de sesión, por favor recarga la pagina.';
	}

?>