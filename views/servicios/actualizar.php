<h1 class="nombre-pagina">Actualizar servicios</h1>
<p class="descripcion-pagina">Modifica los datos del formulario</p>
<?php 
	include_once __DIR__.'/../templates/barra.php';
 	include_once __DIR__.'/../templates/alertas.php'; 
?>
<form class="formulario" method="POST">
	<?php include_once __DIR__.'/../servicios/formulario.php'; ?>
	<input type="hidden" name="idServicio" value="<?php echo $servicio->idServicio ?>">
	<input type="submit" class="boton" value="Guardar">
</form>