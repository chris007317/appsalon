<h1 class="nombre-pagina">Servicios</h1>
<p class="descripcion-pagina">Adminstrar servicios</p>
<?php include_once __DIR__.'/../templates/barra.php'; ?>
<ul class="servicios">
	<?php foreach ($servicios as $servicio): ?>
		<li>
			<p>Nombre: <span><?php echo $servicio->nombreServicio; ?></span></p>
			<p>Precio: <span>S/. <?php echo $servicio->precioServicio; ?></span></p>
			<div class="acciones">
				<a class="boton" href="/servicios/actualizar?idServicio=<?php echo $servicio->idServicio; ?>">Actualizar</a>
				<form method="POST" action="/servicios/eliminar">
					<input type="hidden" name="idServicio" value="<?php echo $servicio->idServicio; ?>">
					<input type="submit" class="boton-eliminar" value="Eliminar">
				</form>
			</div>
		</li>
	<?php endforeach ?>
</ul>