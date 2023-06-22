
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
    var destinatario = document.getElementById('requerimientos-crear-destinatario').value;

    if(document.getElementById('requerimientos-crear-descripcion'))
    {
        if(destinatario != 'almacen')
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
        else
        {
            var articulos_lista = document.getElementById('requerimientos-crear-articulo-lista').value;

            if(articulos_lista != '')
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
            else
            {
                mensajeError = 'No se ha seleccionado ningun articulo.';
                mostrarAlerta('MENSAJE DE ERROR', mensajeError, 2);
            }
        }
    }
} 

function requerimientos_crear()
{
    var destinatario = $('#requerimientos-crear-destinatario').val();
    var opcion = '';
    var cantidad = $('#requerimientos-crear-cantidad').val();
    var punto = $('#requerimientos-crear-punto').val();
    var descripcion = $('#requerimientos-crear-descripcion').val();

    if(destinatario == 'almacen')
    {
        opcion = $('#requerimientos-crear-articulo-lista').val();
    }
    else
    {
        opcion = $('#requerimientos-crear-opcion').val();
    }

    var parametros = 
    {
        action: 'crear',
        destinatario: destinatario,
        opcion: opcion,
        cantidad: cantidad,
        punto: punto,
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
            requerimientos_cambiar_opcion('editar', $('#requerimientos-editar-opcion').val());
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
    var modo = $('#requerimientos-editar-modo').val();

    if(modo == 'almacen')
    {
        var opcion = $('#requerimientos-editar-opcion').val();
        var descripcion = $('#requerimientos-editar-descripcion').val();

        var parametros = 
        {
            action: 'editar',
            id: id,
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
    else
    {
        var opcion = $('#requerimientos-editar-opcion').val();
        var cantidad = $('#requerimientos-editar-cantidad').val();
        var punto = $('#requerimientos-editar-punto').val();
        var descripcion = $('#requerimientos-editar-descripcion').val();

        var parametros = 
        {
            action: 'editar',
            id: id,
            opcion: opcion,
            cantidad: cantidad,
            punto: punto,
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

function requerimientos_agregar_articulo()
{
    var subir = false;

    var articuloSelect = document.getElementById('requerimientos-crear-articulo');
    var articulo = articuloSelect.value;
    var articuloNombre = articuloSelect.options[articuloSelect.selectedIndex].text;
    var cantidad = parseInt(document.getElementById('requerimientos-crear-articulo-cantidad').value);

    if(articulo != '')
    {
        if(!isNaN(cantidad))
        {
            if(cantidad > 0)
            {
                subir = true;
            }
        }
    }

    if(subir)
    { 
        if(!requerimientos_verificar_duplicado(articulo))
        {
            var articulos = document.getElementById('requerimientos-crear-articulo-lista');
            var lista_articulos = document.getElementById('requerimientos-crear-articulo-contenedor-lista');

            var contenido_articulos = articulos.value;

            if(contenido_articulos != '')
            {
                contenido_articulos += '**';
            }

            contenido_articulos += articulo + '++' + cantidad + '++' + articuloNombre;

            articulos.value = contenido_articulos;

            var contenido = '<b>Articulo:</b> ' + articuloNombre + '<br><b>Cantidad:</b> ' + cantidad;

            if(lista_articulos.innerHTML.trim() != 'No se han agregado articulos.<br>')
            {
                lista_articulos.innerHTML = lista_articulos.innerHTML.trim() + '<br><br>';
            }
            else
            {
                lista_articulos.innerHTML = '';
            }

            lista_articulos.innerHTML = lista_articulos.innerHTML.trim() + contenido;

            document.getElementById('requerimientos-crear-articulo').selectedIndex = 0;
            document.getElementById('requerimientos-crear-articulo-cantidad').value = '1';
        }
        else
        {
            mensajeError = 'Ya se encuentra seleccionado este articulo.';
            mostrarAlerta('MENSAJE DE ERROR', mensajeError, 2);
        }
    }
    else
    {
        mensajeError = 'No se ha seleccionado el articulo o completado el campo de cantidad.';
        mostrarAlerta('MENSAJE DE ERROR', mensajeError, 2);
    }
}

function requerimientos_eliminar_articulo()
{
    var articulos = document.getElementById('requerimientos-crear-articulo-lista');
    var lista_articulos = document.getElementById('requerimientos-crear-articulo-contenedor-lista');
    var contenidoNuevo = '';
    var contenidoNuevoVisual = '';

    if(articulos.value != '')
    {
        var conf = confirm('Esta seguro que desea eliminar el ultimo articulo ingresado.');

        if(conf)
        {
            var datos = articulos.value.split('**');
            var datosVisual = lista_articulos.innerHTML.trim().split('<br><br>');

            for(var i = 0;i < datos.length;i++)
            {
                if(i < (datos.length - 1))
                {
                    if(contenidoNuevo != '')
                    {
                        contenidoNuevo += '**';
                    }

                    contenidoNuevo += datos[i];
                }
            }

            for(var i = 0;i < datosVisual.length;i++)
            {
                if(i < (datosVisual.length - 1))
                {
                    if(contenidoNuevoVisual != '')
                    {
                        contenidoNuevoVisual += '<br><br>';
                    }

                    contenidoNuevoVisual += datosVisual[i];
                }
            }

            if(contenidoNuevoVisual == '')
            {
                contenidoNuevoVisual = 'No se han agregado articulos.<br>';
            }

            articulos.value = contenidoNuevo;
            lista_articulos.innerHTML = contenidoNuevoVisual;
        }
    }
}

function requerimientos_verificar_duplicado(valor)
{
    var articulos_lista = document.getElementById('requerimientos-crear-articulo-lista').value;
    var articulos = articulos_lista.split('**');
    var salida = false;

    for(var i = 0; i < articulos.length; i++)
    {
        var dato = articulos[i].split('++');

        if(dato[0] == valor)
        {
            salida = true;

            break;
        }
    }

    return salida;
}

function requerimientos_cambiar_opcion(modo, valor)
{
    if(valor == 'COMPUTADOR' || valor == 'IMPRESORA')
    {
        $('#requerimientos-contenedor-' + modo + '-opcion').removeClass('col-sm-6');
        $('#requerimientos-contenedor-' + modo + '-punto').removeClass('col-sm-6');
        $('#requerimientos-contenedor-' + modo + '-opcion').addClass('col-sm-4');
        $('#requerimientos-contenedor-' + modo + '-punto').addClass('col-sm-4');
        mostrar('requerimientos-contenedor-' + modo + '-cantidad');
        document.getElementById('requerimientos-' + modo + '-cantidad').required = true;

        if(document.getElementById('requerimientos-' + modo + '-cantidad').value == '')
        {
            document.getElementById('requerimientos-' + modo + '-cantidad').value = 1;
        }
    }
    else
    {
        $('#requerimientos-contenedor-' + modo + '-opcion').removeClass('col-sm-4');
        $('#requerimientos-contenedor-' + modo + '-punto').removeClass('col-sm-4');
        $('#requerimientos-contenedor-' + modo + '-opcion').addClass('col-sm-6');
        $('#requerimientos-contenedor-' + modo + '-punto').addClass('col-sm-6');
        ocultar('requerimientos-contenedor-' + modo + '-cantidad');
        document.getElementById('requerimientos-' + modo + '-cantidad').required = false;
        document.getElementById('requerimientos-' + modo + '-cantidad').value = '';
    }
}

////////////////////// extras ///////////////////////////////////

