<h1 class="nombre-pagina">Nuevo servicios</h1>
<p class="descripcion-pagina">Registrar nuevo servicios</p>

<?php 
	include_once __DIR__.'/../templates/barra.php';
 	include_once __DIR__.'/../templates/alertas.php'; 
?>
<form class="formulario" action="/servicios/crear" method="POST">
	<?php include_once __DIR__.'/../servicios/formulario.php'; ?>
	<input type="submit" class="boton" value="Guardar">
</form>