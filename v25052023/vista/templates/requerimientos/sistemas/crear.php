<div class="row">
    <div class="form-group col-sm-6" id="requerimientos-contenedor-crear-opcion">
        <label><b>Asunto </b><span class="text-danger hint--top hint--primary" data-hint="Campo obligatotio" style="cursor: pointer;">(*)</span></label>
        <select id="requerimientos-crear-opcion" class="form-control js-example-basic-single" style="height: 46.5px" onchange="requerimientos_cambiar_opcion('crear', this.value)" required>
            <option value="" selected disabled>Seleccione el asunto</option>
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

    <div class="form-group col-sm-4" id="requerimientos-contenedor-crear-cantidad" style="display: none">
        <label><b>Cantidad </b><span class="text-danger hint--top hint--primary" data-hint="Campo obligatotio" style="cursor: pointer;">(*)</span></label>
        <input id="requerimientos-crear-cantidad" type="number" value="" class="form-control text-center" min="1" max="9999999" placeholder="">
    </div>

    <div class="form-group col-sm-6" id="requerimientos-contenedor-crear-punto">
        <label><b>Punto </b><span class="text-danger hint--top hint--primary" data-hint="Campo obligatotio" style="cursor: pointer;">(*)</span></label>
        <select id="requerimientos-crear-punto" class="form-control js-example-basic-single" style="height: 46.5px" required>
            <option value="" selected disabled>Seleccione el punto</option>
            <?php 
                foreach($view_requerimientos->list_puntos as $lista)
                {
            ?>
            <option value="<?php echo $lista['nombre']; ?>" title="<?php echo $lista['direccion']; ?>"><?php echo $lista['nombre']; ?></option>
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

<script>
	$(document).ready(function() {
		$('.js-example-basic-single').select2();
	});
</script>