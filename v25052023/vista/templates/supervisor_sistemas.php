<?php 

    session_start();

    include_once '../../modelo/usuario.php';

    $usuario = '';
    $pagina_actual = '';
    $pagina_info = '';
    $nombre = '';
    $claseUsuario = new Usuario();

    if(!isset($_SESSION['requerimientos_usuario']))
    {
        header('location: ../index.php');
    }
    else
    {
        $usuario = $_SESSION['requerimientos_usuario'];
        $permisos = intval($claseUsuario->getPermisos($usuario));
        $nombre = $claseUsuario->getValorId($usuario, 'nomb_us');

        if($permisos != 2)
        {
            header('location: ../index.php');
        }
    }

    if(isset($_GET['v']))
    {
        $pagina_actual = $_GET['v'];
    }

    if(isset($_GET['info']))
    {
        $pagina_info = $_GET['info'];
    }

?>

<html lang="es" id="html">
<head>
    <title>Sisben Requerimientos</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=1.0, initial-scale=1.0, maximum-scale=3.0, minimum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="AMRZ">

    <link rel="icon" href="../img/favicon.png">

    <link rel="stylesheet" type="text/css" href="../lb/jquery/jquery-ui.css">
    <link rel="stylesheet" href="../lb/bootstrap/css/bootstrap.min.css">
    <script src="../lb/jquery/jquery-3.4.1.min.js"></script>
    <script src="../lb/bootstrap/js/bootstrap.min.js"></script>

    <!--<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC60AUNIA0mLM81wGD82NzKBgbdfg1FL1A"></script>
    <script type="text/javascript" src="../js/MarkerWithLabel.js"></script>-->
    
    <link rel="stylesheet" type="text/css" href="../css/estilos.css">
    <link rel="stylesheet" type="text/css" href="../css/menu.css">
    <link rel="stylesheet" type="text/css" href="../css/hint/hint.min.css">
    <link rel="stylesheet" type="text/css" href="../lb/graficos/css/graficos.css">

    <script Src="../lb/graficos/lb/highcharts/code/highcharts.js"></script>
    <script src="../lb/graficos/lb/highcharts/code/highcharts-3d.js"></script>
    <script src="../lb/graficos/lb/highcharts/code/modules/cylinder.js"></script>
    <script src="../lb/graficos/lb/highcharts/code/modules/funnel3d.js"></script>
    <script src="../lb/graficos/lb/highcharts/code/modules/pyramid3d.js"></script>
    <script src="../lb/graficos/lb/highcharts/code/modules/series-label.js"></script>
    <script src="../lb/graficos/lb/highcharts/code/modules/data.js"></script>
    <script src="../lb/graficos/lb/highcharts/code/modules/drilldown.js"></script>
    <script type="text/javascript" src="../lb/graficos/lb/highcharts/code/modules/exporting.js"></script>
    <script type="text/javascript" src="../lb/graficos/lb/highcharts/code/modules/export-data.js"></script>
    <script type="text/javascript" src="../lb/graficos/js/graficos.js"></script>
    

    <script type="text/javascript" src="../js/function.js"></script>
    <script type="text/javascript" src="../js/menu.js"></script>
    <script type="text/javascript" src="../lb/cargando/cargando.js"></script>
    <script type="text/javascript" src="../lb/fontAwesome/js/all.js"></script>
    <!--<script type="text/javascript" src="../lb/fontAwesome/v5.14.0.js"></script>-->
    <!--<script src="https://use.fontawesome.com/releases/v5.14.0/js/all.js" data-auto-replace-svg="nest"></script>-->

</head>
<body onload="cargarPaginaActual('<?php echo $pagina_actual; ?>','<?php echo $pagina_info; ?>');cargando_admin();">

    <!-- datos --->

    <input type="text" id="requerimientos_admin" value="../" style="display: none">

    <!-- ----------->

    <div class="contenedor-principal">
        
        <div id="particles-js" class="contenedor-principal-fondo"></div>

    <!-- menu -->

        <div class="contenedor-menu">
            <div class="boton-menu" id="boton-menu">
                <a href="javascript:void(0)" class="texto-menu">
                    <span class="glyphicon glyphicon-align-justify texto-menu-span" style="right: 2%;"></span>
                    <span class="texto-menu-span"><img src="../img/favicon.png" style="height: 75px"></span>
                </a>
            </div>

            <nav id="contenedor-menu-nav" style="">
                <ul class="menu">
                    <li class="menu-logo"><img src="../img/favicon_v2.png"></li>

        

                    <!-- sesion -->

                    <li onclick="cerrarSesion()" class="menu-redes" style="width: initial"><a href="javascript: void(0)"><span class="menu-pc-ocultar2"><i class="fas fa-user-circle"></i>&nbsp;&nbsp;&nbsp;</span><b>Salir</b></a><span class="menu-texto-oculto"><span class="menu-pc-ocultar2"><i class="fas fa-user-circle"></i>&nbsp;&nbsp;&nbsp;</span><b>Salir</b></span></li>

                    <li class="menu-redes menu-movil-ocultar" style="width: 25px;"><a href="javascript: void(0)">|</a><span class="menu-texto-oculto">|</span></li>

                    <!-- buscar -->

                    <li onclick="" class="menu-redes menu-movil-ocultar" style="width: initial"><a href="javascript: void(0)"><i class="fas fa-user"></i>&nbsp;&nbsp;&nbsp;<?php echo $nombre; ?></a><span class="menu-texto-oculto"><i class="fas fa-search"></i>&nbsp;&nbsp;&nbsp;<?php echo $nombre; ?></span></li>

                    <li class="menu-redes menu-movil-ocultar" style="width: 25px;"><a href="javascript: void(0)">|</a><span class="menu-texto-oculto">|</span></li>

                    <!-- menu -->

                    <li onclick="inicio()"><a href="javascript: void(0)" class="menu-enfocar"><b><span class="menu-pc-ocultar"><i class="fas fa-home"></i>&nbsp;&nbsp;&nbsp;</span>Inicio</b></a><span class="menu-texto-oculto">Inicio</span></li>

                    <li onclick="//almacen_cargarIndex()"><a href="?v=almacen_index" class="menu-enfocar"><b><span class="menu-pc-ocultar"><i class="fas fa-chart-column"></i>&nbsp;&nbsp;&nbsp;</span>Almacen</b></a><span class="menu-texto-oculto">Almacen</span></li>

                    <li onclick="//articulos_cargarIndex()"><a href="?v=articulos_index" class="menu-enfocar"><b><span class="menu-pc-ocultar"><i class="fas fa-chart-column"></i>&nbsp;&nbsp;&nbsp;</span>Articulos</b></a><span class="menu-texto-oculto">Articulos</span></li>

                    <li onclick="//unidades_cargarIndex()"><a href="?v=unidades_index" class="menu-enfocar"><b><span class="menu-pc-ocultar"><i class="fas fa-chart-column"></i>&nbsp;&nbsp;&nbsp;</span>Unidades</b></a><span class="menu-texto-oculto">Unidades</span></li>

                    <!--<li class="dropdown" style="vertical-align: middle;">

                        <a href="javascript: void(0)" class="dropdown-toggle menu-enfocar" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><b><span class="menu-pc-ocultar"><i class="fas fa-cogs"></i>&nbsp;&nbsp;&nbsp;</span>Transacciones</b></a>
                        <span class="menu-texto-oculto"><b><span class="menu-pc-ocultar"><i class="fas fa-cogs"></i>&nbsp;&nbsp;&nbsp;</span>Transacciones</b></span>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                            <li onclick="//transacciones_entradas_cargarIndex()"><a href="?v=transacciones_entradas_index"><span class="fas fa-shopping-cart color-iconos"></span>&nbsp;&nbsp;&nbsp;<b>Entradas</b></a></li>
                            <li onclick="//transacciones_salidas_cargarIndex()"><a href="?v=transacciones_salidas_index"><span class="fas fa-minus color-iconos"></span>&nbsp;&nbsp;&nbsp;<b>Salidas</b></a></li>
                        </ul>
                    </li>

                    <li class="dropdown" style="vertical-align: middle;">

                        <a href="javascript: void(0)" class="dropdown-toggle menu-enfocar" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><b><span class="menu-pc-ocultar"><i class="fas fa-cogs"></i>&nbsp;&nbsp;&nbsp;</span>Complementos</b></a>
                        <span class="menu-texto-oculto"><b><span class="menu-pc-ocultar"><i class="fas fa-cogs"></i>&nbsp;&nbsp;&nbsp;</span>Complementos</b></span>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                            <li onclick="//categorias_cargarIndex()"><a href="?v=categorias_index"><span class="fas fa-filter color-iconos"></span>&nbsp;&nbsp;&nbsp;<b>Categorias</b></a></li>
                            <li onclick="//unidades_cargarIndex()"><a href="?v=unidades_index"><span class="fas fa-info-circle color-iconos"></span>&nbsp;&nbsp;&nbsp;<b>Unidades</b></a></li>
                        </ul>
                    </li>

                    <li class="dropdown" style="vertical-align: middle;">

                        <a href="javascript: void(0)" class="dropdown-toggle menu-enfocar" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><b><span class="menu-pc-ocultar"><i class="fas fa-cogs"></i>&nbsp;&nbsp;&nbsp;</span>Proveedores</b></a>
                        <span class="menu-texto-oculto"><b><span class="menu-pc-ocultar"><i class="fas fa-cogs"></i>&nbsp;&nbsp;&nbsp;</span>Proveedores</b></span>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                            <li onclick="//proveedor_individual_cargarIndex()"><a href="?v=proveedor_individual_index"><span class="fas fa-user color-iconos"></span>&nbsp;&nbsp;&nbsp;<b>Individual</b></a></li>
                            <li onclick="//proveedor_empresa_cargarIndex()"><a href="?v=proveedor_empresa_index"><span class="fas fa-building color-iconos"></span>&nbsp;&nbsp;&nbsp;<b>Empresas</b></a></li>
                        </ul>
                    </li>-->

                    <li class="dropdown" style="vertical-align: middle;">

                        <a href="javascript: void(0)" class="dropdown-toggle menu-enfocar" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><b><span class="menu-pc-ocultar"><i class="fas fa-cogs"></i>&nbsp;&nbsp;&nbsp;</span>Administrar</b></a>
                        <span class="menu-texto-oculto"><b><span class="menu-pc-ocultar"><i class="fas fa-cogs"></i>&nbsp;&nbsp;&nbsp;</span>Administrar</b></span>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                            <li onclick="//usuarios_permisos_cargarIndex()"><a href="?v=usuarios_permisos_index"><span class="fas fa-user-gear color-iconos"></span>&nbsp;&nbsp;&nbsp;<b>Permisos</b></a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>

        <div class="contenedor-slider" id="contenedor-slider"></div>
        
        <div class="contenedor">
            <!-- contenido -->

            <div class="contenedor-ventanas" id="contenedor-ventanas"></div>

            <div class="contenedor-ventanas-2" id="contenedor-ventanas-2"></div>

            <!-- footer -->

            <div class="footer">
                <div class="row">
                        <p class="footer-parrafo">
                            &copy; 2023 Sisben Requerimientos
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- /// modal // -->

        <button type="button" data-toggle="modal" data-target="#subventana" id="boton-subventana" style="display: none;"></button>

        <div id="subventana" class="modal fade" role="dialog">
            <div class="modal-dialog" id="subventana-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header subventana-titulo" id="contenedor-subventana-titulo">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title" id="subventana-titulo">Modal Header</h4>
                    </div>
                    <div class="modal-body" id="subventana-contenido"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal" id="boton-salir-subventana">Cerrar</button>
                    </div>
                </div>      
            </div>
        </div>

    </div>

    <script type="text/javascript" src="../lb/jquery/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="../lb/jquery/jquery-ui.min.js"></script>
 
 </body>
 </html>

        