
function cargarPaginaActual(pagina,info)
{
    var admin = $('#requerimientos_admin').val();

    if(pagina != '')
    {
        if(admin == 'admin')
        {
            cargando_admin();
        }

        switch(pagina)
        {
            case 'login':
            {
                login();

                break;
            }

            ///////// usuarios ///////////

            case 'usuarios_permisos_index':
            {
                usuarios_permisos_cargarIndex();

                break;
            }

            ///////////////// ///////////////

            case 'requerimientos_index':
            {
                requerimientos_cargarIndex();

                break;
            }

            ///////////////// opciones ///////////////

            case 'opciones_sistemas_index':
            {
                opciones_sistemas_cargarIndex();

                break;
            }

            case 'opciones_campo_index':
            {
                opciones_campo_cargarIndex();

                break;
            }

            case 'opciones_puntos_atencion_index':
            {
                opciones_puntos_atencion_cargarIndex();

                break;
            }

            default:
            {
                vacio();

                break;
            }
        }
    }
    else
    {
        if(admin.trim() == '')
        {
            window.location = '?v=login';
        }
        else
        {
            
        }
    }
}

function cerrarSesion()
{
    location = 'inicio/salir.php';
}

function inicio()
{
    var admin = $('#requerimientos_admin').val();

    location = admin + '../controlador/inicio/enrutador.php';
}

//////////////// menu //////////////

function vacio(cargar)
{
    var ejecutar = ()=>
    {
        $('#contenedor-ventanas').load('../../controlador/inicio/indexInicio.php',{action:'vacio'},function()
        {
            mostrar('contenedor-ventanas');
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

function perfil_cargarIndex(cargar)
{
    var ejecutar = ()=>
    {
        $('#contenedor-ventanas').load('../../controlador/usuario/indexUsuario.php',{action:'perfil'},function()
        {
            mostrar('contenedor-ventanas');
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

function opciones_sistemas_cargarIndex(cargar)
{
    var ejecutar = ()=>
    {
        $('#contenedor-ventanas').load('../../controlador/opciones_sistemas/indexOpcionesSistemas.php',{action:'index'},function()
        {
            var datosTabla = document.querySelectorAll('#opciones-sistemas-tabla tbody tr');
            $('#opciones-sistemas-tabla-total').val(datosTabla.length);

            if(datosTabla.length == 0)
            {
                var datosTabla = document.querySelectorAll('#opciones-sistemas-tabla thead');
                datosTabla[0].innerHTML += '<th class="text-center" colspan="4">Sin resultados</th>';
            }

            mostrar('contenedor-ventanas');
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

function opciones_campo_cargarIndex(cargar)
{
    var ejecutar = ()=>
    {
        $('#contenedor-ventanas').load('../../controlador/opciones_campo/indexOpcionesCampo.php',{action:'index'},function()
        {
            var datosTabla = document.querySelectorAll('#opciones-campo-tabla tbody tr');
            $('#opciones-campo-tabla-total').val(datosTabla.length);

            if(datosTabla.length == 0)
            {
                var datosTabla = document.querySelectorAll('#opciones-campo-tabla thead');
                datosTabla[0].innerHTML += '<th class="text-center" colspan="4">Sin resultados</th>';
            }

            mostrar('contenedor-ventanas');
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

function opciones_puntos_atencion_cargarIndex(cargar)
{
    var ejecutar = ()=>
    {
        $('#contenedor-ventanas').load('../../controlador/opciones_puntos_atencion/indexOpcionesPuntosAtencion.php',{action:'index'},function()
        {
            var datosTabla = document.querySelectorAll('#opciones-puntos-atencion-tabla tbody tr');
            $('#opciones-puntos-atencion-tabla-total').val(datosTabla.length);

            if(datosTabla.length == 0)
            {
                var datosTabla = document.querySelectorAll('#opciones-puntos-atencion-tabla thead');
                datosTabla[0].innerHTML += '<th class="text-center" colspan="4">Sin resultados</th>';
            }

            mostrar('contenedor-ventanas');
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

function perfil_editar_password_confirmar(id,nombre)
{
    var password = $('#usuario-perfil-password').val();
    var password2 = $('#usuario-perfil-password-2').val();

    if(password == password2)
    {
        var titulo = 'Esta seguro que desea actualizar esta información?';
        var funcion = 'perfil_editar_password(' + id + ')'; 

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
        $('#usuario-perfil-password-notificacion').removeClass('alert-success');
        $('#usuario-perfil-password-notificacion').addClass('alert-danger');

        mostrar('usuario-perfil-password-notificacion');
        document.getElementById('usuario-perfil-password-notificacion').innerHTML = '<b>Error,</b> las contraseñas no coinciden.';
    }
}

function perfil_editar_password(id)
{
    var parametros = 
    {
        action: 'editar_password',
        id: id,
        password: $('#usuario-perfil-password').val()
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
                $('#usuario-perfil-password-notificacion').removeClass('alert-danger');
                $('#usuario-perfil-password-notificacion').addClass('alert-success');

                mostrar('usuario-perfil-password-notificacion');
                document.getElementById('usuario-perfil-password-notificacion').innerHTML = 'Contraseña actualizada correctamente.';

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

function usuarios_permisos_cargarIndex(cargar)
{
    var ejecutar = ()=>
    {
        $('#contenedor-ventanas').load('../../controlador/usuario/indexUsuario.php',{action:'permisos_index'},function()
        {
            var datosTabla = document.querySelectorAll('#usuario-permisos-tabla tbody tr');
            $('#usuario-permisos-tabla-total').val(datosTabla.length);

            if(datosTabla.length == 0)
            {
                var datosTabla = document.querySelectorAll('#usuario-permisos-tabla thead');
                datosTabla[0].innerHTML += '<th class="text-center" colspan="4">Sin resultados</th>';
            }

            mostrar('contenedor-ventanas');
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

//////////////////////////////////

function verMenu()
{
    if(document.body.clientWidth <= 1100)
    {
        ocultarMenu();
    }
}

function filtrarTabla(tabla,valor,claseFila)
{
    var contador = 0;
    valor = valor.toLowerCase();
    var datosTabla = document.querySelectorAll('#' + tabla + ' tbody tr');
    var total = datosTabla.length;

    if(valor.trim() != '')
    {
        if(valor.length >= 4)
        {
            for(var i = 0;i < datosTabla.length;i++)
            {
                var fila = datosTabla[i];

                if(claseFila != undefined)
                {
                    fila.classList.remove(claseFila);
                }

                var seguir = true;

                for(var j = 0;j < fila.children.length && seguir;j++)
                {
                    var celda = (fila.children[j].textContent).toLowerCase();
                    var datosCelda = celda.split(valor);

                    if(datosCelda.length > 1)
                    {
                        seguir = false;
                    }
                }

                if(seguir)
                {
                    fila.style.display = 'none';
                    total--;
                }
                else
                {
                    contador++;
                    fila.style.display = 'table-row';

                    if(claseFila != undefined)
                    {
                        if((contador % 2) == 0)
                        {
                            fila.classList.add(claseFila);
                        }
                    }
                }
            }
        }
        else
        {
            total = datosTabla.length;

            for(var i = 0;i < datosTabla.length;i++)
            {
                contador++;
                var fila = datosTabla[i];

                if(claseFila != undefined)
                {
                    fila.classList.remove(claseFila);

                    if((contador % 2) == 0)
                    {
                        fila.classList.add(claseFila);
                    }
                }

                fila.style.display = 'table-row';
            }
        }
    }
    else
    {
        total = datosTabla.length;

        for(var i = 0;i < datosTabla.length;i++)
        {
            contador++;
            var fila = datosTabla[i];

            if(claseFila != undefined)
            {
                fila.classList.remove(claseFila);

                if((contador % 2) == 0)
                {
                    fila.classList.add(claseFila);
                }
            }

            fila.style.display = 'table-row';
        }
    }

    if(total != datosTabla.length)
    {
        $('#' + tabla + '-total').val(total + ' de ' + datosTabla.length);
    }
    else
    {
        $('#' + tabla + '-total').val(total);
    }
}

function ocultar(id)
{
	if(document.getElementById(id))
	{
		document.getElementById(id).style.display = 'none';
	}
	else
	{
		alert('Error, no existe el elemento ' + id);
	}
}

function mostrar(id)
{
	if(document.getElementById(id))
	{
		document.getElementById(id).style.display = 'block';
	}
	else
	{
		alert('Error, no existe el elemento ' + id);
	}

    if(id == 'contenedor-ventanas')
    {
        ocultar('contenedor-ventanas-2');
    }

    if(id == 'contenedor-ventanas-2')
    {
        ocultar('contenedor-ventanas');
    }
}

function generarClick(id)
{
	if(document.getElementById(id))
	{
		document.getElementById(id).click();
	}
	else
	{
		alert('Error, no existe el elemento ' + id);
	}
}

function enfocar(id)
{
    if(document.getElementById(id))
    {
        document.getElementById(id).focus();
    }
    else
    {
        alert('Error, no existe el elemento ' + id);
    }
}

function mostrarSubventana(titulo,source,parametros,funcion,size)
{
    document.getElementById('contenedor-subventana-titulo').style.background = '#ff0015';
    document.getElementById('subventana-dialog').style = '';

    if(parametros === undefined)
    {
        parametros = {};
    }
    else
    {
        if(parametros['action'] == 'ventanaConfirmacion')
        {
            document.getElementById('contenedor-subventana-titulo').style.background = '#006d32';
        }
    }

    if(size === undefined)
    {
    	document.getElementById('subventana-dialog').classList.remove('subventana-dialog');
    }
    else
    {
    	if(size == true)
    	{
    		document.getElementById('subventana-dialog').classList.add('subventana-dialog');
    	}
    	else
    	{
    		document.getElementById('subventana-dialog').style.width = size;
    	}
    }

    $('#subventana-contenido').load(source,parametros, function()
    {
        if(funcion != undefined)
        {
            funcion();
        }

        document.getElementById('subventana-titulo').innerHTML = titulo;

        if(document.getElementById('subventana').style.display != 'block')
        {
        	generarClick('boton-subventana');
        }
    });
}

function mostrarAlertaInicio(titulo,mensaje,modo)
{
    document.getElementById('subventana-dialog').classList.remove('subventana-dialog');
    
    var parametros = {action:'ventanaAlertasInicio', mensaje:mensaje, modo:modo};

    $('#subventana-contenido').load('../controlador/alertas/indexAlertas.php',parametros, function()
    {
        document.getElementById('subventana-titulo').innerHTML = titulo;

        if(document.getElementById('subventana').style.display != 'block')
        {
            generarClick('boton-subventana');
        }

        if(modo == 2)
        {
            document.getElementById('contenedor-subventana-titulo').style.background = '#e02e29';
        }
        else
        {
            document.getElementById('contenedor-subventana-titulo').style.background = '#014617';
        }
    });
}

function mostrarAlerta(titulo,mensaje,modo)
{
    document.getElementById('subventana-dialog').classList.remove('subventana-dialog');
    document.getElementById('subventana-dialog').style.width = '600px';
    
	var parametros = {action:'ventanaAlertas', mensaje:mensaje, modo:modo};

    $('#subventana-contenido').load('../../controlador/alertas/indexAlertas.php',parametros, function()
    {
        document.getElementById('subventana-titulo').innerHTML = titulo;

		if(document.getElementById('subventana').style.display != 'block')
        {
        	generarClick('boton-subventana');
        }

        if(modo == 2)
        {
            document.getElementById('contenedor-subventana-titulo').style.background = '#e02e29';
        }
        else
        {
            document.getElementById('contenedor-subventana-titulo').style.background = '#014617';
        }
    });
}

function cambiarSubcontenedor(id_contenedor,indice,funcion)
{
	for(var i = 1;document.getElementById(id_contenedor + '-' + i);i++)
	{
		if(i === indice)
		{
			document.getElementById(id_contenedor + '-' + i).style.display = 'block';
		}
		else
		{
			document.getElementById(id_contenedor + '-' + i).style.display = 'none';
		}
	}

    if(funcion != undefined)
    {
        funcion();
    }
}

function soloNumeros(e) 
{
    var key = window.Event ? e.which : e.keyCode;

    var salida = ((key >= 48 && key <= 57) || key === 8  || key === 13 || key === 46);

    return salida; 
}

function mayus(e)
{
    e.value = e.value.toUpperCase();
}

function verificarEntero(objeto,minimo,maximo)
{
    if(objeto.value != '')
    {
        valor = Math.trunc(objeto.value);

        if(isNaN(valor))
        {
            objeto.value = '';
        }
        else
        {
            if(minimo != undefined)
            {
                if(valor < minimo)
                {
                    objeto.value = minimo;
                }
            }
        	if(maximo != undefined)
        	{
	            if(valor > maximo)
	            {
	                objeto.value = maximo;
	            }
	        }
        }
    }
}

function colocar_punto_decimal(valor)
{
    valor = valor + '';
    var datos = valor.split('');
    var salida = '';
    var contador = 0;
    
    for(var i = datos.length - 1;i >= 0;i--)
    {
        contador++;

        if(contador == 4)
        {
            salida = '.' + salida;
            contador = 1;
        }

        salida = datos[i] + salida;
    }

    return salida;
}

function vaciarHTML(id)
{
	document.getElementById(id).innerHTML = '';
}

function inputAutocomplete(objeto,lista)
{
    if(objeto.dataset.info != '' || objeto.dataset.info == '00')
    {
        for(var i = 0;i < lista.length;i++)
        {
            eval('objeto.dataset.' + lista[i] + " = '';");
        }

        objeto.dataset.info = '';
        objeto.value = '';
    }
}

function generarVariosClicks(id)
{
    for(var i = 1;document.getElementById(id + i);i++)
    {
        if(continuarClicks)
        {
            generarClick(id + i);
        }
    }
}

function printDocument(url,nombre)
{
    nombre = nombre + '.pdf';
    var xhr = new XMLHttpRequest();
    xhr.open('GET', url, true);
    xhr.responseType = 'arraybuffer';
    xhr.onload = function(e)
    {
        if(this.status == 200)
        {
            var blob = new Blob([this.response], {type:"application/pdf"});
            var link = document.createElement('a');
            link.href = window.URL.createObjectURL(blob);
            link.download = nombre;
            link.click();
        }
    };
    
    xhr.send();
}

function nuevaPestania(url)
{
    window.open(url);
}

function go_down()
{
    var alto = (document.getElementsByTagName('body'))[0].clientHeight;

    window.scrollTo(0,alto);
}

function cero()
{
    mostrarAlerta('MENSAJE DE INFORMACIÓN','Funcionalidad en desarrollo.',2);
}

function get_dia_semana(dia)
{
    dia = parseInt(dia);

	var dias = ['Domingo','Lunes','Martes','Míercoles','Jueves','Viernes','Sabado'];

    return dias[dia];
}

function get_mes(mes)
{
    mes = parseInt(mes);

    var meses = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];

    return meses[mes];
}

