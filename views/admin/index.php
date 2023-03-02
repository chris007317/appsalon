<h1 class="nombre-pagina">Panel de Administración</h1>
<?php include_once __DIR__.'/../templates/barra.php'; ?>
<h2>Buscar Citas</h2>
<div class="busqueda">
	<form class="formulario" method="POST">
		<div class="campo">
			<label for="dateFecha">Fecha</label>
			<input type="date" name="dateFecha" id="dateFecha" value="<?php echo $fecha; ?>">
		</div>
	</form>
</div>
<?php 
	if (count($citas) === 0) {
		echo "<h2>No hay citas</h2>";
	}
 ?>
<div id="citas-admin">
		<ul class="citas">
		<?php 
			$idCita = 0;
			foreach ($citas as $key => $cita): 
		?>
			<?php 
				if ($idCita !== $cita->idCita):
					$total = 0;
			 ?>
			<li>
				<p>ID: <span><?php echo $cita->idCita; ?></span></p>
				<p>Cliente: <span><?php echo $cita->cliente; ?></span></p>
				<p>Hora: <span><?php echo $cita->horaCita; ?></span></p>
				<p>Hora: <span><?php echo $cita->emailUsuario; ?></span></p>
				<p>Hora: <span><?php echo $cita->telefonoUsuario; ?></span></p>
				<h3>Servicios</h3>
			<?php
				$idCita = $cita->idCita; 
				endif 
			?>
				<p class="servicio"><?php echo $cita->nombreServicio.' $ '.$cita->precioServicio; ?></p>
				<?php 
					$actual = $cita->idCita;
					$proximo = $citas[($key+1)]->idCita ?? 0;
					$total = $cita->precioServicio + $total;
					if(!esUltimo($actual, $proximo)){
				?>
					<p>Total: <span>S/. <?php echo $total; ?></span></p>
					<form action="/api/eliminar" method="POST">
						<input type="hidden" name="idCita" value="<?php echo $cita->idCita; ?>">
						<input type="submit" class="boton-eliminar" value="Eliminar">
					</form>
				<?php
					}
				 ?>
		<?php endforeach ?>
		</ul>
</div>
<?php $script = '<script type="text/javascript" src="build/js/buscador.js"></script>';?>