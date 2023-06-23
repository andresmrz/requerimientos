<?php
    
?>

<hr>
<div class="row">
    <div class="form-group col-sm-6">
        <label><b>Articulo </b><span class="text-danger hint--top hint--primary" data-hint="Campo obligatotio" style="cursor: pointer;">(*)</span></label>
        <select id="requerimientos-crear-articulo" class="form-control js-example-basic-single" style="height: 46.5px">
            <option value="" selected disabled>Seleccione la opción</option>
            <?php 
                foreach($view_requerimientos->list_opciones as $lista)
                {
            ?>
            <option value="<?php echo $lista['id']; ?>" title="<?php echo $lista['nombre']; ?>"><?php echo $lista['nombre'].', existencias '.$lista['cantidad']; ?></option>
            <?php 
                }
            ?>
        </select>
    </div>

    <div class="form-group col-sm-6">
        <label><b>Cantidad </b><span class="text-danger hint--top hint--primary" data-hint="Campo obligatotio" style="cursor: pointer;">(*)</span></label>
        <input id="requerimientos-crear-articulo-cantidad" type="number" value="1" class="form-control text-center" min="1" max="9999999" placeholder="">
    </div>
</div>

<div class="row">
    <div class="form-group col-sm-12">
        <label><b>Lista de Articulos </b><span class="text-danger hint--top hint--primary" data-hint="Campo obligatotio" style="cursor: pointer;">(*)</span></label>
		<div class="alert alert-danger" style="background: white;" id="requerimientos-crear-articulo-contenedor-lista">No se han agregado articulos.<br></div>
        <input type="text" value="" id="requerimientos-crear-articulo-lista" style="display: none">
    </div>
</div>

<center>
    <button type="button" class="btn btn-danger" onclick="requerimientos_eliminar_articulo('crear')">
        <span class="glyphicon glyphicon-trash"></span>&nbsp;&nbsp;Eliminar Ultimo
    </button>

    <button type="button" class="btn btn-primary" onclick="requerimientos_agregar_articulo('crear')">
        <span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;Agregar Articulo
    </button>
</center>

<hr>

<div class="row">
    <div class="col-sm-12">
        <label><b>Descripción</b> </b><span class="text-danger hint--top hint--primary" data-hint="Campo obligatotio" style="cursor: pointer;">(*)</span></label>
        <textarea class="form-control" id="requerimientos-crear-descripcion" rows="4" placeholder="descripcion" style="height: auto !important;" required></textarea>
    </div>
</div>