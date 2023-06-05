
function opciones_puntos_atencion_cargar_crear(cargar)
{
    var ejecutar = ()=>
    {
        $('#opciones-puntos-atencion-contenedor-2').load('../../controlador/opciones_puntos_atencion/indexOpcionesPuntosAtencion.php',{action:'crear'},function()
        {
            cambiarSubcontenedor('opciones-puntos-atencion-contenedor', 2);
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

function opciones_puntos_atencion_crear_confirmar()
{
    var parametros = 
    {
        action: 'verificar_existe',
        nombre: $('#opciones-puntos-atencion-crear-nombre').val()
    };

    $.ajax(
    {
        type: 'POST',
        url: '../../controlador/opciones_puntos_atencion/controllerOpcionesPuntosAtencion.php',
        data: parametros,
        success: function(respuesta)
        {
            var response = JSON.parse(respuesta);

            if(response.modo == 0)
            {
                var titulo = 'Esta seguro que desea enviar esta información?';
                var funcion = 'opciones_puntos_atencion_crear()'; 

                var parametros = 
                {
                    action: 'ventanaConfirmacion',
                    titulo: titulo,
                    funcion: funcion
                };

                mostrarSubventana('CREAR OPCIÓN DE PUNTOS DE ATENCIÓN','../../controlador/alertas/indexAlertas.php', parametros);
            }
            else
            {
                mostrarAlerta('MENSAJE DE ERROR','Información duplicada en el sistema:<br><br>' + response.mensaje, 2);
            }
        }
    });
} 

function opciones_puntos_atencion_crear()
{
    var nombre = $('#opciones-puntos-atencion-crear-nombre').val();
    var descripcion = $('#opciones-puntos-atencion-crear-descripcion').val();

    var parametros = 
    {
        action: 'crear',
        nombre: nombre,
        descripcion: descripcion
    };

    $.ajax(
    {
        type: 'POST',
        url: '../../controlador/opciones_puntos_atencion/controllerOpcionesPuntosAtencion.php',
        data: parametros,
        success: function(respuesta)
        {
            var response = JSON.parse(respuesta);

            if(response.modo == 0)
            {
                mostrarAlerta('MENSAJE DE CONFIRMACIÓN','Opción a puntos de atención creada correctamente<br><br>' + response.mensaje, 1);

                opciones_puntos_atencion_cargarIndex();
            }
            else
            {
                console.log(respuesta.trim());
                alert(respuesta.trim());
            }
        }
    });
} 

function opciones_puntos_atencion_cargar_ver(id)
{
    var ejecutar = ()=>
    {
        $('#opciones-puntos-atencion-contenedor-2').load('../../controlador/opciones_puntos_atencion/indexOpcionesPuntosAtencion.php',{action:'ver', id:id},function()
        {
            cambiarSubcontenedor('opciones-puntos-atencion-contenedor', 2);
            verMenu();

            cargando_ocultar();
        });
    };

    cargando_done('Cargando datos', true, ejecutar);
} 

function opciones_puntos_atencion_cargar_editar(id)
{
    var ejecutar = ()=>
    {
        $('#opciones-puntos-atencion-contenedor-2').load('../../controlador/opciones_puntos_atencion/indexOpcionesPuntosAtencion.php',{action:'editar', id:id},function()
        {
            cambiarSubcontenedor('opciones-puntos-atencion-contenedor', 2);
            verMenu();

            cargando_ocultar();
        });
    };

    cargando_done('Cargando datos', true, ejecutar);
} 

function opciones_puntos_atencion_editar_confirmar(id, nombre_inicial)
{ 
    var nombre = $('#opciones-puntos-atencion-editar-nombre').val();

    if(nombre_inicial == nombre)
    {
        var titulo = 'Esta seguro que desea actualizar la información de esta opción de puntos de atención?';
        var funcion = 'opciones_puntos_atencion_editar(' + id + ')'; 

        var parametros = 
        {
            action: 'ventanaConfirmacion',
            titulo: titulo,
            funcion: funcion
        };

        mostrarSubventana('EDITAR OPCIÓN DE PUNTOS DE ATENCIÓN','../../controlador/alertas/indexAlertas.php', parametros);
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
            url: '../../controlador/opciones_puntos_atencion/controllerOpcionesPuntosAtencion.php',
            data: parametros,
            success: function(respuesta)
            {
                var response = JSON.parse(respuesta);

                if(response.modo == 0)
                {
                    var titulo = 'Esta seguro que desea actualizar la información de esta opción de puntos de atención?';
                    var funcion = 'opciones_puntos_atencion_editar(' + id + ')'; 

                    var parametros = 
                    {
                        action: 'ventanaConfirmacion',
                        titulo: titulo,
                        funcion: funcion
                    };

                    mostrarSubventana('EDITAR OPCIÓN DE PUNTOS DE ATENCIÓN','../../controlador/alertas/indexAlertas.php', parametros);
                }
                else
                {
                    mostrarAlerta('MENSAJE DE ERROR','Información duplicada en el sistema:<br><br>' + response.mensaje, 2);
                }
            }
        });
    }
}

function opciones_puntos_atencion_editar(id)
{
    var nombre = $('#opciones-puntos-atencion-editar-nombre').val();
    var descripcion = $('#opciones-puntos-atencion-editar-descripcion').val();
    var estado = $('#opciones-puntos-atencion-editar-estado').val();

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
        url: '../../controlador/opciones_puntos_atencion/controllerOpcionesPuntosAtencion.php',
        data: parametros,
        success: function(respuesta)
        {
            if(respuesta.trim() == '0')
            {
                mostrarAlerta('MENSAJE DE CONFIRMACIÓN','Opción de puntos de atención actualizada correctamente.', 1);

                opciones_puntos_atencion_cargarIndex(false);
            }
            else
            {
                console.log(respuesta.trim());
                alert(respuesta.trim());
            }
        }
    });
}

function opciones_puntos_atencion_eliminar_confirmar(id)
{
    var titulo = 'Esta seguro que desea eliminar toda la información de esta opción de puntos de atención?';
    var funcion = 'opciones_puntos_atencion_eliminar(' + id + ')'; 

    var parametros = 
    {
        action: 'ventanaConfirmacion',
        titulo: titulo,
        funcion: funcion
    };

    mostrarSubventana('ELIMINAR OPCIÓN DE PUNTOS DE ATENCIÓN','../../controlador/alertas/indexAlertas.php', parametros);
}

function opciones_puntos_atencion_eliminar(id)
{
    var parametros = 
    {
        action: 'eliminar',
        id: id
    };

    $.ajax(
    {
        type: 'POST',
        url: '../../controlador/opciones_puntos_atencion/controllerOpcionesPuntosAtencion.php',
        data: parametros,
        success: function(respuesta)
        {  
            if(respuesta.trim() == '0')
            {
                mostrarAlerta('MENSAJE DE CONFIRMACIÓN','Opción de puntos de atención eliminada correctamente.', 1);

                opciones_puntos_atencion_cargarIndex(false);
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

