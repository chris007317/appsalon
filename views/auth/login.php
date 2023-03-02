<h1 class="nombre-pagina">Login</h1>
<p class="descripcion-pagina">Inicia sesión con tus datos</p>
<?php include_once __DIR__."/../templates/alertas.php"; ?>
<form class="formulario" action="" method="POST">
	<div class="campo">
		<label for="txtEmail">Email</label>
		<input type="email" name="txtEmail" id="txtEmail" placeholder="Tu Email">
	</div>
	<div class="campo">
		<label for="txtContra">Contraseña</label>
		<input type="password" name="txtContra" id="txtContra" placeholder="Tu contraseña">
	</div>
	<input type="submit" class="boton" value="Iniciar Sesión">
</form>
<div class="acciones">
	<a href="/crear-cuenta">¿Aún no tienes una cuenta? Crea una</a>
	<a href="/olvide">¿Olvidaste tu contraseña?</a>
</div>