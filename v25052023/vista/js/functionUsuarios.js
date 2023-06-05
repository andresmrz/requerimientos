
function usuarios_ventana_crear()
{
    var ejecutar = ()=>
    {
        $('#usuarios-contenedor-2').load('../../controlador/usuario/indexUsuario.php',{action:'crear'},function()
        {
            cargando_ocultar();

            cambiarSubcontenedor('usuarios-contenedor',2);
        });
    };

    cargando_done('Cargando datos',true,ejecutar);
}

function usuarios_crear_confirmar()
{
    var documento = $('#usuario-crear-documento').val();
    var correo = $('#usuario-crear-correo').val();

    var parametros = {action:'verificarUsuario', documento:documento, correo:correo};

    $.ajax(
    {
        type: 'POST',
        url: '../../controlador/usuario/controllerUsuario.php',
        data: parametros,
        success: function(respuesta)
        {
            if(respuesta.trim() == '0')
            {
                var titulo = 'Esta seguro que desea crear este usuario?';
                var funcion = 'usuarios_crear()'; 

                var parametros = 
                {
                    action: 'ventanaConfirmacion',
                    titulo: titulo,
                    funcion: funcion
                };

                mostrarSubventana('CREAR USUARIO','../../controlador/alertas/indexAlertas.php',parametros);
            }
            else if(respuesta.trim() == '1')
            {
                $('#usuario-crear-notificacion').removeClass('alert-success');
                $('#usuario-crear-notificacion').addClass('alert-danger');

                mostrar('usuario-crear-notificacion');
                document.getElementById('usuario-crear-notificacion').innerHTML = '<b>Error,</b> el usuario con número de documento <b>' 
                                                                                    + documento + '</b> ya existe.';
            }
            else if(respuesta.trim() == '2')
            {
                $('#usuario-crear-notificacion').removeClass('alert-success');
                $('#usuario-crear-notificacion').addClass('alert-danger');

                mostrar('usuario-crear-notificacion');
                document.getElementById('usuario-crear-notificacion').innerHTML = '<b>Error,</b> el usuario con correo electronico <b>' 
                                                                                    + correo + '</b> ya existe.';
            }
            else if(respuesta.trim() == '3')
            {
                $('#usuario-crear-notificacion').removeClass('alert-success');
                $('#usuario-crear-notificacion').addClass('alert-danger');

                mostrar('usuario-crear-notificacion');
                document.getElementById('usuario-crear-notificacion').innerHTML = '<b>Error,</b> ya existe un colaborador con el mismo número de documento o correo.';
            }
            else
            {
                console.log(respuesta.trim());
                alert(respuesta.trim());
            }
        }
    });
}

function usuarios_crear()
{
    var documento = $('#usuario-crear-documento').val();
    var nombres = $('#usuario-crear-nombres').val();
    var apellidos = $('#usuario-crear-apellidos').val();
    var correo = $('#usuario-crear-correo').val();
    var telefono = $('#usuario-crear-telefono').val();
    var estado = $('#usuario-crear-estado').val();
    var permisos = $('#usuario-crear-permisos').val();

    var parametros = 
    {
        action: 'crear',
        documento: documento, 
        nombres: nombres,
        apellidos: apellidos,
        correo: correo,
        telefono: telefono,
        estado: estado,
        permisos: permisos
    };

    $.ajax(
    {
        type: 'POST',
        url: '../../controlador/usuario/controllerUsuario.php',
        data: parametros,
        success: function(respuesta)
        {
            if(respuesta.trim() == '0')
            {
                mostrarAlerta('MENSAJE DE CONFIRMACIÓN','Usuario creado correctamente.',1);

                usuarios_cargarIndex(false);
            }
            else
            {
                console.log(respuesta.trim());
                alert(respuesta.trim());
            }
        }
    });
}

function usuarios_ventana_editar(id)
{
    var ejecutar = ()=>
    {
        $('#usuarios-contenedor-2').load('../../controlador/usuario/indexUsuario.php',{action:'editar', id:id},function()
        {
            cargando_ocultar();

            cambiarSubcontenedor('usuarios-contenedor',2);
        });
    };

    cargando_done('Cargando datos',true,ejecutar);
}

function usuarios_editar_confirmar(id, documento_actual, correo_actual)
{
    var documento = $('#usuario-editar-documento').val();
    var correo = $('#usuario-editar-correo').val();

    if(documento.trim() == documento_actual.trim() && correo.trim() == correo_actual.trim())
    {
        var titulo = 'Esta seguro que desea actualizar esta información?';
        var funcion = 'usuarios_editar(' + id + ')'; 

        var parametros = 
        {
            action: 'ventanaConfirmacion',
            titulo: titulo,
            funcion: funcion
        };

        mostrarSubventana('ACTUALIZAR INFORMACIÓN','../../controlador/alertas/indexAlertas.php',parametros);
    }
    else
    {
        var parametros = {action:'verificarUsuarioEdit', id:id, documento:documento, correo:correo};

        $.ajax(
        {
            type: 'POST',
            url: '../../controlador/usuario/controllerUsuario.php',
            data: parametros,
            success: function(respuesta)
            {console.log(respuesta);
                if(respuesta.trim() == '0')
                {
                    var titulo = 'Esta seguro que desea actualizar esta información?';
                    var funcion = 'usuarios_editar(' + id + ')'; 

                    var parametros = 
                    {
                        action: 'ventanaConfirmacion',
                        titulo: titulo,
                        funcion: funcion
                    };

                    mostrarSubventana('ACTUALIZAR INFORMACIÓN','../../controlador/alertas/indexAlertas.php',parametros);
                }
                else if(respuesta.trim() == '1')
                {
                    $('#usuario-editar-notificacion').removeClass('alert-success');
                    $('#usuario-editar-notificacion').addClass('alert-danger');

                    mostrar('usuario-editar-notificacion');
                    document.getElementById('usuario-editar-notificacion').innerHTML = '<b>Error,</b> el usuario con número de documento <b>' 
                                                                                        + documento + '</b> ya existe.';
                }
                else if(respuesta.trim() == '2')
                {
                    $('#usuario-editar-notificacion').removeClass('alert-success');
                    $('#usuario-editar-notificacion').addClass('alert-danger');

                    mostrar('usuario-editar-notificacion');
                    document.getElementById('usuario-editar-notificacion').innerHTML = '<b>Error,</b> el usuario con correo electronico <b>' 
                                                                                        + correo + '</b> ya existe.';
                }
                else if(respuesta.trim() == '3')
                {
                    $('#usuario-editar-notificacion').removeClass('alert-success');
                    $('#usuario-editar-notificacion').addClass('alert-danger');

                    mostrar('usuario-editar-notificacion');
                    document.getElementById('usuario-editar-notificacion').innerHTML = '<b>Error,</b> ya existe un colaborador con el mismo número de documento o correo.';
                }
                else
                {
                    console.log(respuesta.trim());
                    alert(respuesta.trim());
                }
            }
        });
    }
}

function usuarios_editar(id)
{
    var documento = $('#usuario-editar-documento').val();
    var nombres = $('#usuario-editar-nombres').val();
    var apellidos = $('#usuario-editar-apellidos').val();
    var correo = $('#usuario-editar-correo').val();
    var telefono = $('#usuario-editar-telefono').val();
    var estado = $('#usuario-editar-estado').val();
    var permisos = $('#usuario-editar-permisos').val();

    var parametros = 
    {
        action: 'editar',
        id: id,
        documento: documento, 
        nombres: nombres,
        apellidos: apellidos,
        correo: correo,
        telefono: telefono,
        estado: estado,
        permisos: permisos
    };

    $.ajax(
    {
        type: 'POST',
        url: '../../controlador/usuario/controllerUsuario.php',
        data: parametros,
        success: function(respuesta)
        {
            if(respuesta.trim() === '0')
            {
                mostrarAlerta('MENSAJE DE CONFIRMACIÓN','Datos actualizados correctamente.',1);

                usuarios_cargarIndex(false);
            }
            else
            {
                console.log(respuesta.trim());
                alert(respuesta.trim());
            }
        }
    });
}

function usuarios_editar_password_confirmar(id,nombre)
{
    var password = $('#usuario-editar-password').val();
    var password2 = $('#usuario-editar-password-2').val();

    if(password == password2)
    {
        var titulo = 'Esta seguro que desea actualizar esta información?';
        var funcion = 'usuarios_editar_password(' + id + ')'; 

        var parametros = 
        {
            action: 'ventanaConfirmacion',
            titulo: titulo,
            funcion: funcion
        };

        mostrarSubventana('ACTUALIZAR INFORMACIÓN','../../controlador/alertas/indexAlertas.php',parametros);
    }
    else
    {
        $('#usuario-editar-password-notificacion').removeClass('alert-success');
        $('#usuario-editar-password-notificacion').addClass('alert-danger');

        mostrar('usuario-editar-password-notificacion');
        document.getElementById('usuario-editar-password-notificacion').innerHTML = '<b>Error,</b> las contraseñas no coinciden.';
    }
}

function usuarios_editar_password(id)
{
    var parametros = 
    {
        action: 'editar_password',
        id: id,
        password: $('#usuario-editar-password').val()
    };

    $.ajax(
    {
        type: 'POST',
        url: '../../controlador/usuario/controllerUsuario.php',
        data: parametros,
        success: function(respuesta)
        {  
            if(respuesta.trim() == '0')
            {                
                $('#usuario-editar-password-notificacion').removeClass('alert-danger');
                $('#usuario-editar-password-notificacion').addClass('alert-success');

                mostrar('usuario-editar-password-notificacion');
                document.getElementById('usuario-editar-password-notificacion').innerHTML = 'Contraseña actualizada correctamente.';

                mostrarAlerta('MENSAJE DE CONFIRMACIÓN','Contraseña actualizada correctamente.',1);
            }
            else
            {
                generarClick('boton-salir-subventana');
                
                console.log(respuesta.trim());
                alert(respuesta.trim());
            }
        }
    });
}

function usuarios_eliminar_confirmar(id)
{
    var titulo = 'Esta seguro que desea eliminar toda la información de este usuario? <br><br><b>Debe tener en cuenta que toda la informacion relacionada como coordinadores, lideres, colaboradores y grupos sera eliminada.</b>';
    var funcion = 'usuarios_eliminar(' + id + ')'; 

    var parametros = 
    {
        action: 'ventanaConfirmacion',
        titulo: titulo,
        funcion: funcion
    };

    mostrarSubventana('ELIMINAR USUARIO','../../controlador/alertas/indexAlertas.php',parametros);
}

function usuarios_eliminar(id)
{
    var parametros = 
    {
        action: 'eliminar',
        id: id
    };

    $.ajax(
    {
        type: 'POST',
        url: '../../controlador/usuario/controllerUsuario.php',
        data: parametros,
        success: function(respuesta)
        {  
            if(respuesta.trim() == '0')
            {
                mostrarAlerta('MENSAJE DE CONFIRMACIÓN','Usuario eliminado correctamente.',1);

                usuarios_cargarIndex(false);
            }
            else
            {                
                console.log(respuesta.trim());
                alert(respuesta.trim());
            }
        }
    });
}

function usuarios_permisos_confirmar(id, valor)
{
    var titulo = 'Esta seguro que desea actualizar la información de este usuario?</b>';
    var funcion = 'usuarios_permisos(' + id + ',' + valor + ')'; 

    var parametros = 
    {
        action: 'ventanaConfirmacion',
        titulo: titulo,
        funcion: funcion
    };

    mostrarSubventana('ACTUALIZAR USUARIO','../../controlador/alertas/indexAlertas.php',parametros);
}

function usuarios_permisos(id, valor)
{
    var parametros = 
    {
        action: 'permisos',
        id: id,
        permisos: valor
    };

    $.ajax(
    {
        type: 'POST',
        url: '../../controlador/usuario/controllerUsuario.php',
        data: parametros,
        success: function(respuesta)
        {  
            if(respuesta.trim() == '0')
            {
                mostrarAlerta('MENSAJE DE CONFIRMACIÓN','Usuario actualizado correctamente.', 1);

                usuarios_permisos_cargarIndex(false);
            }
            else
            {                
                console.log(respuesta.trim());
                alert(respuesta.trim());
            }
        }
    });
}
