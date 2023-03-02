<h1 class="nombre-pagina">Crear nueva cita</h1>
<p class="descripcion-pagina">Elije tus servicios a y coloca tus datos</p>
<?php include_once __DIR__.'/../templates/barra.php'; ?>
<div id="app">
	<nav class="tabs">
		<button type="button" class="actual" data-paso="1">Servicios</button>
		<button type="button" data-paso="2">Información cita</button>
		<button type="button" data-paso="3">Resumen</button>
	</nav>
	<div id="paso-1" class="seccion">
		<h2>Servicios</h2>
		<p class="text-center">Elige tus servicios a continuación</p>
		<div id="servicios" class="listado-servicios"></div>
	</div>
	<div id="paso-2" class="seccion">
		<h2>Tus datos y cita</h2>
		<p class="text-center">Coloca tus datos y fecha de tu cita</p>
		<form class="formulario">
			<div class="campo">
				<label for="txtNombre">Nombre</label>
				<input type="text" name="txtNombre" id="txtNombre" placeholder="Tu nombre" value="<?php echo $nombre; ?>" disabled>
			</div>
			<div class="campo">
				<label for="dateFecha">Fecha</label>
				<input type="date" name="dateFecha" id="dateFecha" min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>">
			</div>
			<div class="campo">
				<label for="dateHora">Hora</label>
				<input type="time" name="dateHora" id="dateHora" min="10:00" max="18:00">
			</div>
			<input type="hidden" name="idUsuario" id="idUsuario" value="<?php echo $idUsuario; ?>">
		</form>
	</div>
	<div id="paso-3" class="seccion contenido-resumen">
		<h2>Resumen</h2>
		<p class="text-center">Verigica que la información sea correcta</p>
	</div>
	<div class="paginacion">
		<button id="anterior" class="boton">&laquo; Anterior</button>
		<button id="siguiente" class="boton">Siguiente &raquo;</button>
	</div>
</div>
<?php 
	$script = '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
	$script .= '<script type="text/javascript" src="build/js/app.js"></script>';
 ?>