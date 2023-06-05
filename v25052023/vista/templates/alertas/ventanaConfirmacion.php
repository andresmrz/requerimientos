

<div class="row">
	<div class="col-sm-12">
		<img class="subventana-icono" src="<?php echo ($view_alert->inicio)?'':'../'; ?>img/interrogacion.png">
		<div class="row">
			<span style="float: left;width: 100%;padding: 0 15px 0 90px;text-align: justify;font-size: 20px;"><?php echo $view_alert->titulo; ?></span>
		</div>
		
		<br>
		
		<div class="row">
			<center>
				<button class="btn btn-danger" onclick="generarClick('boton-salir-subventana')"><b>NO</b></button>
				<button class="btn btn-primary" onclick="<?php echo $view_alert->funcion; ?>"><b>SI</b></button>
			</center>
		</div>
	</div>
</div>

