<h1 class="nombre-pagina">Olvide la contraseña</h1>
<p class="descripcion-pagina">Restablece tu contraseña</p>
<?php include_once __DIR__."/../templates/alertas.php"; ?>
<form class="formulario" method="POST" action="/olvide">
	<div class="campo">
		<label for="txtEmail">Email</label>
		<input type="email" name="txtEmail" id="txtEmail" placeholder="Tu Email">
	</div>
	<input type="submit" class="boton" value="Enviar instrucciones">
</form>
<div class="acciones">
	<a href="/">¿Si ya tienes una cuenta? Inicia sesión</a>
	<a href="/crear-cuenta">¿Aún no tienes una cuenta? crea una</a>
</div>