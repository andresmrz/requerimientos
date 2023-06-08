<div class="row">
    <div class="form-group col-sm-12">
        <label><b>Opción </b><span class="text-danger hint--top hint--primary" data-hint="Campo obligatotio" style="cursor: pointer;">(*)</span></label>
        <select id="requerimientos-crear-opcion" class="form-control js-example-basic-single" style="height: 46.5px" required>
            <option value="" selected disabled>Seleccione la opción</option>
            <?php 
                foreach($view_requerimientos->list_opciones as $lista)
                {
            ?>
            <option value="<?php echo $lista['nombre']; ?>" title="<?php echo $lista['descripcion']; ?>"><?php echo $lista['nombre']; ?></option>
            <?php 
                }
            ?>
        </select>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <label><b>Descripción</b> </b><span class="text-danger hint--top hint--primary" data-hint="Campo obligatotio" style="cursor: pointer;">(*)</span></label>
        <textarea class="form-control" id="requerimientos-crear-descripcion" rows="4" placeholder="descripcion" style="height: auto !important;" required></textarea>
    </div>
</div>