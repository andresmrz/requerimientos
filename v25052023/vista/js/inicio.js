
function login()
{
	var funcion = function()
    {
    	$('#contenedor-ventanas').load('../controlador/inicio/indexInicio.php',{action:'login'},function()
	    {
	        verMenu();

	        cargando_ocultar();
	    });
    };

    cargando_done('Cargando datos',true,funcion);
}

function iniciarSesion()
{
    var usuario = $('#login-usuario').val();
    var password = $('#login-password').val();

    var parametros = {action:'iniciar_sesion', usuario:usuario, password:password};

    $.ajax({
        type: 'POST',
        url: '../controlador/inicio/controllerInicio.php',
        data: parametros,
        success: function(respuesta)
        {console.log(respuesta);
            if(respuesta.trim() != '0')
            {
                var mensaje = 'Ha ocurrido un error, vuelva a intentarlo';

                if(respuesta.trim() == '-1')
                {
                    mensaje = 'Usuario y/o contraseña incorrecta.';
                }

                if(respuesta.trim() == '-2')
                {
                    mensaje = 'Usuario Inactivo.';
                }

                document.getElementById('login-alerta').innerHTML = mensaje;
                mostrar('login-alerta');
            }
            else
            {
                location = '../controlador/inicio/enrutador.php';
            }
        }
    });
}
