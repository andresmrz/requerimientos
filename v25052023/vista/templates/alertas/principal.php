
<?php 
    
    $estilo = '';

?>


<div class="row">
    <div class="col-sm-12">
        <br>
        <?php 
            if(intval($view_alert->modo) == 1 || intval($view_alert->modo) == 2)
            {
                $estilo = 'float: right;width: 88%;text-align: justify;';
                $fondo = (intval($view_alert->modo) == 2)?'background: #e02e29;':'';
                $imagen = (intval($view_alert->modo) == 1)?'correcto.png':'error.png';
        ?>
        <img class="subventana-icono" src="<?php echo ($view_alert->inicio)?'':'../'; ?>img/<?php echo $imagen; ?>">
        <?php 
            }
        ?>
        <span style="<?php echo $estilo; ?>font-size: 20px;"><?php echo $view_alert->mensaje; ?></span>
        <br>
        <br>
    </div>
</div>

