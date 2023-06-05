
function opciones_sistemas_cargar_crear(cargar)
{
    var ejecutar = ()=>
    {
        $('#opciones-sistemas-contenedor-2').load('../../controlador/opciones_sistemas/indexOpcionesSistemas.php',{action:'crear'},function()
        {
            cambiarSubcontenedor('opciones-sistemas-contenedor', 2);
            verMenu();

            if(cargar == undefined)
            {
                cargando_ocultar();
            }
        });
    };

    if(cargar == undefined)
    {
        cargando_done('Cargando datos',true,ejecutar);
    }
    else
    {
        ejecutar();
    }
} 

function opciones_sistemas_crear_confirmar()
{
    var parametros = 
    {
        action: 'verificar_existe',
        nombre: $('#opciones-sistemas-crear-nombre').val()
    };

    $.ajax(
    {
        type: 'POST',
        url: '../../controlador/opciones_sistemas/controllerOpcionesSistemas.php',
        data: parametros,
        success: function(respuesta)
        {
            var response = JSON.parse(respuesta);

            if(response.modo == 0)
            {
                var titulo = 'Esta seguro que desea enviar esta información?';
                var funcion = 'opciones_sistemas_crear()'; 

                var parametros = 
                {
                    action: 'ventanaConfirmacion',
                    titulo: titulo,
                    funcion: funcion
                };

                mostrarSubventana('CREAR OPCIÓN DE SISTEMAS','../../controlador/alertas/indexAlertas.php', parametros);
            }
            else
            {
                mostrarAlerta('MENSAJE DE ERROR','Información duplicada en el sistema:<br><br>' + response.mensaje, 2);
            }
        }
    });
} 

function opciones_sistemas_crear()
{
    var nombre = $('#opciones-sistemas-crear-nombre').val();
    var descripcion = $('#opciones-sistemas-crear-descripcion').val();

    var parametros = 
    {
        action: 'crear',
        nombre: nombre,
        descripcion: descripcion
    };

    $.ajax(
    {
        type: 'POST',
        url: '../../controlador/opciones_sistemas/controllerOpcionesSistemas.php',
        data: parametros,
        success: function(respuesta)
        {
            var response = JSON.parse(respuesta);

            if(response.modo == 0)
            {
                mostrarAlerta('MENSAJE DE CONFIRMACIÓN','Opción a sistemas creada correctamente<br><br>' + response.mensaje, 1);

                opciones_sistemas_cargarIndex();
            }
            else
            {
                console.log(respuesta.trim());
                alert(respuesta.trim());
            }
        }
    });
} 

function opciones_sistemas_cargar_ver(id)
{
    var ejecutar = ()=>
    {
        $('#opciones-sistemas-contenedor-2').load('../../controlador/opciones_sistemas/indexOpcionesSistemas.php',{action:'ver', id:id},function()
        {
            cambiarSubcontenedor('opciones-sistemas-contenedor', 2);
            verMenu();

            cargando_ocultar();
        });
    };

    cargando_done('Cargando datos', true, ejecutar);
} 

function opciones_sistemas_cargar_editar(id)
{
    var ejecutar = ()=>
    {
        $('#opciones-sistemas-contenedor-2').load('../../controlador/opciones_sistemas/indexOpcionesSistemas.php',{action:'editar', id:id},function()
        {
            cambiarSubcontenedor('opciones-sistemas-contenedor', 2);
            verMenu();

            cargando_ocultar();
        });
    };

    cargando_done('Cargando datos', true, ejecutar);
} 

function opciones_sistemas_editar_confirmar(id, nombre_inicial)
{ 
    var nombre = $('#opciones-sistemas-editar-nombre').val();

    if(nombre_inicial == nombre)
    {
        var titulo = 'Esta seguro que desea actualizar la información de esta opción de sistemas?';
        var funcion = 'opciones_sistemas_editar(' + id + ')'; 

        var parametros = 
        {
            action: 'ventanaConfirmacion',
            titulo: titulo,
            funcion: funcion
        };

        mostrarSubventana('EDITAR OPCIÓN DE SISTEMAS','../../controlador/alertas/indexAlertas.php', parametros);
    }
    else
    {
        var parametros = 
        {
            action: 'verificar_existe',
            nombre: nombre
        };

        $.ajax(
        {
            type: 'POST',
            url: '../../controlador/opciones_sistemas/controllerOpcionesSistemas.php',
            data: parametros,
            success: function(respuesta)
            {
                var response = JSON.parse(respuesta);

                if(response.modo == 0)
                {
                    var titulo = 'Esta seguro que desea actualizar la información de esta opción de sistemas?';
                    var funcion = 'opciones_sistemas_editar(' + id + ')'; 

                    var parametros = 
                    {
                        action: 'ventanaConfirmacion',
                        titulo: titulo,
                        funcion: funcion
                    };

                    mostrarSubventana('EDITAR OPCIÓN DE SISTEMAS','../../controlador/alertas/indexAlertas.php', parametros);
                }
                else
                {
                    mostrarAlerta('MENSAJE DE ERROR','Información duplicada en el sistema:<br><br>' + response.mensaje, 2);
                }
            }
        });
    }
}

function opciones_sistemas_editar(id)
{
    var nombre = $('#opciones-sistemas-editar-nombre').val();
    var descripcion = $('#opciones-sistemas-editar-descripcion').val();
    var estado = $('#opciones-sistemas-editar-estado').val();

    var parametros = 
    {
        action: 'editar',
        id: id,
        nombre: nombre,
        descripcion: descripcion,
        estado: estado
    };

    $.ajax(
    {
        type: 'POST',
        url: '../../controlador/opciones_sistemas/controllerOpcionesSistemas.php',
        data: parametros,
        success: function(respuesta)
        {
            if(respuesta.trim() == '0')
            {
                mostrarAlerta('MENSAJE DE CONFIRMACIÓN','Opción de sistemas actualizada correctamente.', 1);

                opciones_sistemas_cargarIndex(false);
            }
            else
            {
                console.log(respuesta.trim());
                alert(respuesta.trim());
            }
        }
    });
}

function opciones_sistemas_eliminar_confirmar(id)
{
    var titulo = 'Esta seguro que desea eliminar toda la información de esta opción de sistemas?';
    var funcion = 'opciones_sistemas_eliminar(' + id + ')'; 

    var parametros = 
    {
        action: 'ventanaConfirmacion',
        titulo: titulo,
        funcion: funcion
    };

    mostrarSubventana('ELIMINAR OPCIÓN DE SISTEMAS','../../controlador/alertas/indexAlertas.php', parametros);
}

function opciones_sistemas_eliminar(id)
{
    var parametros = 
    {
        action: 'eliminar',
        id: id
    };

    $.ajax(
    {
        type: 'POST',
        url: '../../controlador/opciones_sistemas/controllerOpcionesSistemas.php',
        data: parametros,
        success: function(respuesta)
        {  
            if(respuesta.trim() == '0')
            {
                mostrarAlerta('MENSAJE DE CONFIRMACIÓN','Opción de sistemas eliminada correctamente.', 1);

                opciones_sistemas_cargarIndex(false);
            }
            else
            {                
                console.log(respuesta.trim());
                alert(respuesta.trim());
            }
        }
    });
}

////////////////////// extras ///////////////////////////////////

