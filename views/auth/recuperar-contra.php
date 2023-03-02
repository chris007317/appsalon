<h1 class="nombre-pagina">Recuperar contraseña</h1>
<p class="descripcion-pagina">Coloca tu nueva contraseña a continuación</p>
<?php include_once __DIR__."/../templates/alertas.php"; ?>
<?php if (!$error): ?>
<form class="formulario" method="POST">
	<div class="campo">
		<label for="txtContraNueva">Contraseña</label>
		<input type="password" name="txtContraNueva" id="txtContraNueva" placeholder="Ingrese contraseña">
	</div>
	<input type="submit" class="boton" value="Guardar nueva contraseña" >
</form>
<div class="acciones">
	<a href="/">¿Ya tienes cuenta? Inicia sesión</a>
	<a href="/crear-cuenta">¿Aún no tienes cuenta? Obtener una cuenta</a>
</div>
<?php endif ?>