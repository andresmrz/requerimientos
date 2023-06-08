
function requerimientos_cargar_crear(cargar)
{
    var ejecutar = ()=>
    {
        $('#requerimientos-contenedor-2').load('../../controlador/requerimientos/indexRequerimientos.php',{action:'crear'},function()
        {
            cambiarSubcontenedor('requerimientos-contenedor', 2);
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

function requerimientos_crear_confirmar()
{
    if(document.getElementById('requerimientos-crear-descripcion'))
    {
        var titulo = 'Esta seguro que desea enviar esta información?';
        var funcion = 'requerimientos_crear()'; 

        var parametros = 
        {
            action: 'ventanaConfirmacion',
            titulo: titulo,
            funcion: funcion
        };

        mostrarSubventana('GENERAR REQUERIMIENTO','../../controlador/alertas/indexAlertas.php', parametros);
    }
} 

function requerimientos_crear()
{
    var asunto = $('#requerimientos-crear-asunto').val();
    var destinatario = $('#requerimientos-crear-destinatario').val();
    var opcion = $('#requerimientos-crear-opcion').val();
    var descripcion = $('#requerimientos-crear-descripcion').val();

    var parametros = 
    {
        action: 'crear',
        asunto: asunto,
        destinatario: destinatario,
        opcion: opcion,
        descripcion: descripcion
    };

    $.ajax(
    {
        type: 'POST',
        url: '../../controlador/requerimientos/controllerRequerimientos.php',
        data: parametros,
        success: function(respuesta)
        {
            var response = JSON.parse(respuesta);

            if(response.modo == 0)
            {
                mostrarAlerta('MENSAJE DE CONFIRMACIÓN','Requerimiento creado correctamente<br><br>' + response.mensaje, 1);

                requerimientos_cargarIndex();
            }
            else
            {
                console.log(respuesta.trim());
                alert(respuesta.trim());
            }
        }
    });
} 

function requerimientos_cargar_ver(id)
{
    var ejecutar = ()=>
    {
        $('#requerimientos-contenedor-2').load('../../controlador/requerimientos/indexRequerimientos.php',{action:'ver', id:id},function()
        {
            cambiarSubcontenedor('requerimientos-contenedor', 2);
            verMenu();

            cargando_ocultar();
        });
    };

    cargando_done('Cargando datos', true, ejecutar);
} 

function requerimientos_cargar_editar(id)
{
    var ejecutar = ()=>
    {
        $('#requerimientos-contenedor-2').load('../../controlador/requerimientos/indexRequerimientos.php',{action:'editar', id:id},function()
        {
            cambiarSubcontenedor('requerimientos-contenedor', 2);
            verMenu();

            cargando_ocultar();
        });
    };

    cargando_done('Cargando datos', true, ejecutar);
} 

function requerimientos_editar_confirmar(id)
{ 
    var titulo = 'Esta seguro que desea actualizar la información de este requerimiento?';
    var funcion = 'requerimientos_editar(' + id + ')'; 

    var parametros = 
    {
        action: 'ventanaConfirmacion',
        titulo: titulo,
        funcion: funcion
    };

    mostrarSubventana('EDITAR REQUERIMIENTO','../../controlador/alertas/indexAlertas.php', parametros);
}

function requerimientos_editar(id)
{
    var asunto = $('#requerimientos-editar-asunto').val();
    var opcion = $('#requerimientos-editar-opcion').val();
    var descripcion = $('#requerimientos-editar-descripcion').val();

    var parametros = 
    {
        action: 'editar',
        id: id,
        asunto: asunto,
        opcion: opcion,
        descripcion: descripcion
    };

    $.ajax(
    {
        type: 'POST',
        url: '../../controlador/requerimientos/controllerRequerimientos.php',
        data: parametros,
        success: function(respuesta)
        {
            if(respuesta.trim() == '0')
            {
                mostrarAlerta('MENSAJE DE CONFIRMACIÓN','Requerimiento actualizado correctamente.', 1);

                requerimientos_cargarIndex(false);
            }
            else
            {
                console.log(respuesta.trim());
                alert(respuesta.trim());
            }
        }
    });
}

function requerimientos_eliminar_confirmar(id)
{
    var titulo = 'Esta seguro que desea eliminar toda la información de este requerimiento?';
    var funcion = 'requerimientos_eliminar(' + id + ')'; 

    var parametros = 
    {
        action: 'ventanaConfirmacion',
        titulo: titulo,
        funcion: funcion
    };

    mostrarSubventana('ELIMINAR REQUERIMIENTO','../../controlador/alertas/indexAlertas.php', parametros);
}

function requerimientos_eliminar(id)
{
    var parametros = 
    {
        action: 'eliminar',
        id: id
    };

    $.ajax(
    {
        type: 'POST',
        url: '../../controlador/requerimientos/controllerRequerimientos.php',
        data: parametros,
        success: function(respuesta)
        {  
            if(respuesta.trim() == '0')
            {
                mostrarAlerta('MENSAJE DE CONFIRMACIÓN','Requerimiento eliminado correctamente.', 1);

                requerimientos_cargarIndex(false);
            }
            else
            {                
                console.log(respuesta.trim());
                alert(respuesta.trim());
            }
        }
    });
}

function requerimientos_cargar_rechazar(id, cargar)
{
    var ejecutar = ()=>
    {
        $('#requerimientos-contenedor-3').load('../../controlador/requerimientos/indexRequerimientos.php',{action:'rechazar', id:id},function()
        {
            cambiarSubcontenedor('requerimientos-contenedor', 3);
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

function requerimientos_rechazar_confirmar(id)
{
    var titulo = 'Esta seguro que desea rechazar este requerimiento?';
    var funcion = 'requerimientos_rechazar(' + id + ')'; 

    var parametros = 
    {
        action: 'ventanaConfirmacion',
        titulo: titulo,
        funcion: funcion
    };

    mostrarSubventana('RECHAZAR REQUERIMIENTO','../../controlador/alertas/indexAlertas.php', parametros);
}

function requerimientos_rechazar(id)
{
    var observaciones = $('#requerimientos-rechazar-observaciones').val();

    var parametros = 
    {
        action: 'rechazar',
        id: id,
        observaciones: observaciones
    };

    $.ajax(
    {
        type: 'POST',
        url: '../../controlador/requerimientos/controllerRequerimientos.php',
        data: parametros,
        success: function(respuesta)
        {  
            if(respuesta.trim() == '0')
            {
                mostrarAlerta('MENSAJE DE CONFIRMACIÓN','Requerimiento rechazado correctamente.', 1);

                requerimientos_cargarIndex(false);
            }
            else
            {                
                console.log(respuesta.trim());
                alert(respuesta.trim());
            }
        }
    });
}

function requerimientos_cargar_procesar(id, cargar)
{
    var ejecutar = ()=>
    {
        $('#requerimientos-contenedor-3').load('../../controlador/requerimientos/indexRequerimientos.php',{action:'procesar', id:id},function()
        {
            cambiarSubcontenedor('requerimientos-contenedor', 3);
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

function requerimientos_procesar_confirmar(id)
{
    var titulo = 'Esta seguro que desea procesar este requerimiento?';
    var funcion = 'requerimientos_procesar(' + id + ')'; 

    var parametros = 
    {
        action: 'ventanaConfirmacion',
        titulo: titulo,
        funcion: funcion
    };

    mostrarSubventana('PROCESAR REQUERIMIENTO','../../controlador/alertas/indexAlertas.php', parametros);
}

function requerimientos_procesar(id)
{
    var observaciones = $('#requerimientos-procesar-observaciones').val();

    var parametros = 
    {
        action: 'procesar',
        id: id,
        observaciones: observaciones
    };

    $.ajax(
    {
        type: 'POST',
        url: '../../controlador/requerimientos/controllerRequerimientos.php',
        data: parametros,
        success: function(respuesta)
        {  
            if(respuesta.trim() == '0')
            {
                mostrarAlerta('MENSAJE DE CONFIRMACIÓN','Requerimiento procesado correctamente.', 1);

                requerimientos_cargarIndex(false);
            }
            else
            {                
                console.log(respuesta.trim());
                alert(respuesta.trim());
            }
        }
    });
}

function requerimientos_en_proceso_confirmar(id)
{
    var titulo = 'Esta seguro que desea cambiar el estado este requerimiento a <b>"en proceso"</b>?';
    var funcion = 'requerimientos_en_proceso(' + id + ')'; 

    var parametros = 
    {
        action: 'ventanaConfirmacion',
        titulo: titulo,
        funcion: funcion
    };

    mostrarSubventana('ACTUALIZAR REQUERIMIENTO','../../controlador/alertas/indexAlertas.php', parametros);
}

function requerimientos_en_proceso(id)
{
    var parametros = 
    {
        action: 'en_proceso',
        id: id
    };

    $.ajax(
    {
        type: 'POST',
        url: '../../controlador/requerimientos/controllerRequerimientos.php',
        data: parametros,
        success: function(respuesta)
        {  
            if(respuesta.trim() == '0')
            {
                mostrarAlerta('MENSAJE DE CONFIRMACIÓN','Requerimiento actualizado correctamente.', 1);

                requerimientos_cargarIndex(false);
            }
            else
            {                
                console.log(respuesta.trim());
                alert(respuesta.trim());
            }
        }
    });
}

function requerimientos_destinatario(valor)
{
    var ejecutar = ()=>
    {
        $('#requerimientos-crear-datos').load('../../controlador/requerimientos/indexRequerimientos.php',{action:'datos', modo: valor},function()
        {
            verMenu();

            cargando_ocultar();
        });
    };

    cargando_done('Cargando datos',true, ejecutar);
}

////////////////////// extras ///////////////////////////////////

