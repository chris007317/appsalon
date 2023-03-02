<?php 
	namespace Controllers;

	use MVC\Router;

	class CitaController{

		public static function index(Router $router){
			isAuth();
			$router->render('cita/index', [
				'nombre' => $_SESSION['nombreUsuario'],
				'idUsuario' => $_SESSION['idUsuario']
			]);
		}
	}
