<?php 

    session_start();

    $usuario = '';
    $pagina_actual = '';
    $pagina_info = '';

    if(isset($_SESSION['requerimientos_usuario']))
    {
        header('location: ../controlador/inicio/enrutador.php');
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
        <meta name="description" content="Primero cali valle adelante">
        <meta name="author" content="AMRZ">

        <link rel="icon" href="img/favicon.png">

        <link rel="stylesheet" type="text/css" href="lb/jquery/jquery-ui.css">
        <link rel="stylesheet" href="lb/bootstrap/css/bootstrap.min.css">
        <script src="lb/jquery/jquery-3.4.1.min.js"></script>
        <script src="lb/bootstrap/js/bootstrap.min.js"></script>

        <!--<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC60AUNIA0mLM81wGD82NzKBgbdfg1FL1A"></script>
        <script type="text/javascript" src="js/MarkerWithLabel.js"></script>-->
        
        <link rel="stylesheet" type="text/css" href="css/inicio.css">
        <link rel="stylesheet" type="text/css" href="css/estilos.css">
        <link rel="stylesheet" type="text/css" href="css/menu.css">
        <link rel="stylesheet" type="text/css" href="css/hint/hint.min.css">

        <script type="text/javascript" src="js/inicio.js"></script>
        <script type="text/javascript" src="js/function.js"></script>
        <script type="text/javascript" src="js/menu.js"></script>
        <script type="text/javascript" src="lb/cargando/cargando.js"></script>
        <!--<script type="text/javascript" src="lb/fontAwesome/v5.14.0.js"></script>-->
        <script src="https://use.fontawesome.com/releases/v5.14.0/js/all.js" data-auto-replace-svg="nest"></script>

    </head>
    
    <body onload="cargarPaginaActual('<?php echo $pagina_actual; ?>','<?php echo $pagina_info; ?>');">

        <!-- datos --->

        <input type="text" id="requerimientos_admin" value="" style="display: none">

        <!-- ----------->

        <div class="contenedor-principal">
            
            <div id="particles-js" class="contenedor-principal-fondo"></div>

        <!-- menu -->

            <div class="contenedor-menu">
                <div class="boton-menu" id="boton-menu">
                    <a href="javascript:void(0)" class="texto-menu">
                        <span class="glyphicon glyphicon-align-justify texto-menu-span" style="right: 2%;"></span>
                        <span class="texto-menu-span"><img src="img/favicon.png" style="height: 75px"></span>
                    </a>
                </div>

                <nav id="contenedor-menu-nav" style="">
                    <ul class="menu">
                        <li class="menu-logo"><img src="img/favicon_v2.png"></li>

                        <!-- sesion -->

                        <li onclick="//login()" class="menu-redes" style="width: initial"><a href="?v=login"><span class="menu-pc-ocultar2"><i class="fas fa-user-circle"></i>&nbsp;&nbsp;&nbsp;</span><b>Ingresar</b></a><span class="menu-texto-oculto"><span class="menu-pc-ocultar2"><i class="fas fa-user-circle"></i>&nbsp;&nbsp;&nbsp;</span><b>Ingresar</b></span></li>

                        <li class="menu-redes menu-movil-ocultar" style="width: 25px;"><a href="javascript: void(0)">|</a><span class="menu-texto-oculto">|</span></li>
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

        <script type="text/javascript" src="lb/jquery/jquery-1.9.1.min.js"></script>
        <script type="text/javascript" src="lb/jquery/jquery-ui.min.js"></script>
        <!--<script type="text/javascript" src="lb/map/MarkerWithLabel.js"></script>-->
    
    </body>
 </html>

        