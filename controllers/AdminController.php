<?php 
	namespace Controllers;
	
	use MVC\Router;
	use Model\AdminCita;

	class AdminController{

		public static function index(Router $router){
			$fecha = $_GET['fecha'] ?? date('Y-m-d');
			$fechas = explode('-', $fecha);
			if (!checkdate($fechas[1], $fechas[2], $fechas[0])) {
				header('Location: /404');
			}
			// Consultar a la base de datos
			$consulta = "SELECT citas.idCita, citas.horaCita, CONCAT(usuarios.nombreUsuario, usuarios.apellidosUsuario) AS cliente, emailUsuario, telefonoUsuario, nombreServicio, precioServicio 
				FROM citas
					LEFT OUTER JOIN usuarios ON citas.idUsuarioCita = usuarios.idUsuario
					LEFT OUTER JOIN citasservicios ON citas.idCita = citasservicios.idCita
					LEFT OUTER JOIN servicios ON citasservicios.idServicio = servicios.idServicio
					WHERE fechaCita = '{$fecha}';";
					
			$citas = AdminCita::SQL($consulta);
			$router->render('admin/index',[
				'nombre' => $_SESSION['nombreUsuario'],
				'citas' => $citas,
				'fecha' => $fecha
			]);
		}
	}