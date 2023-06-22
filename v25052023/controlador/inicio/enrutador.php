
<?php 

    session_start();

    include_once '../../modelo/usuario.php';

    $usuario = '';
    $permisos = '';
    $claseUsuario = new Usuario();

    if(!isset($_SESSION['requerimientos_usuario']))
    {
        header('location: ../index.php');
    }
    else
    {
        $usuario = $_SESSION['requerimientos_usuario'];
        $permisos = intval($claseUsuario->getPermisos($usuario));
    }

    unset($_SESSION['pagina_actual']);

    switch($permisos)
    {
    	case 1:
    	{
            $_SESSION['requerimientos_admin'] = '../';
            
    		echo '<script language="javascript">window.location="../../vista/templates/super_admin"</script>';

    		break;
    	}

        case 2:
        {
            $_SESSION['requerimientos_admin'] = '../';
            
            echo '<script language="javascript">window.location="../../vista/templates/supervisor_sistemas"</script>';

            break;
        }

        case 21:
        {
            $_SESSION['requerimientos_admin'] = '../';
            
            echo '<script language="javascript">window.location="../../vista/templates/auxiliar_sistemas"</script>';

            break;
        }

        case 3:
        {
            $_SESSION['requerimientos_admin'] = '../';
            
            echo '<script language="javascript">window.location="../../vista/templates/supervisor_campo"</script>';

            break;
        }

        case 31:
        {
            $_SESSION['requerimientos_admin'] = '../';
            
            echo '<script language="javascript">window.location="../../vista/templates/auxiliar_campo"</script>';

            break;
        }

        case 4:
        {
            $_SESSION['requerimientos_admin'] = '../';
            
            echo '<script language="javascript">window.location="../../vista/templates/supervisor_puntos_atencion"</script>';

            break;
        }

        case 41:
        {
            $_SESSION['requerimientos_admin'] = '../';
            
            echo '<script language="javascript">window.location="../../vista/templates/auxiliar_puntos_atencion"</script>';

            break;
        } 
        
        case 5:
        {
            $_SESSION['requerimientos_admin'] = '../';
            
            echo '<script language="javascript">window.location="../../vista/templates/supervisor_almacen"</script>';

            break;
        }

        case 51:
        {
            $_SESSION['requerimientos_admin'] = '../';
            
            echo '<script language="javascript">window.location="../../vista/templates/auxiliar_almacen"</script>';

            break;
        } 

    	default:
    	{
            echo '<script language="javascript">window.location="../../vista/templates/inicio/salir"</script>';

    		break;
    	}
    }

?>

