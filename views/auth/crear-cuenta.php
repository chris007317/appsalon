<h1 class="nombre-pagina">Crear cuenta</h1>
<p class="descripcion-pagina">Rellane el formulario para crear una cuenta</p>
<?php include_once __DIR__."/../templates/alertas.php"; ?>
<form class="formulario" method="POST" action="/crear-cuenta">
	<div class="campo">
		<label for="txtNombre">Nombre</label>
		<input type="text" name="txtNombre" id="txtNombre" placeholder="Tu nombre" value="<?php echo validarInput($usuario->nombreUsuario); ?>">
	</div>
	<div class="campo">
		<label for="txtApellidos">Apellidos</label>
		<input type="text" name="txtApellidos" id="txtApellidos" placeholder="Tus apellidos" value="<?php echo validarInput($usuario->apellidosUsuario); ?>">
	</div>
	<div class="campo">
		<label for="txtTelefono">Télefono</label>
		<input type="tel" name="txtTelefono" id="txtTelefono" placeholder="Tu telefono" value="<?php echo validarInput($usuario->telefonoUsuario); ?>">
	</div>
	<div class="campo">
		<label for="txtEmail">Email</label>
		<input type="email" name="txtEmail" id="txtEmail" placeholder="Tu Email" value="<?php echo validarInput($usuario->emailUsuario); ?>">
	</div>
	<div class="campo">
		<label for="txtContra">Contraseña</label>
		<input type="password" name="txtContra" id="txtContra" placeholder="Tu contraseña">
	</div>
	<input type="submit" value="Crear cuenta" class="boton">
</form>
<div class="acciones">
	<a href="/">¿Si ya tienes una cuenta? Inicia sesión</a>
	<a href="/olvide">¿Olvidaste tu contraseña?</a>
</div>