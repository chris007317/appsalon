<?php 
	namespace Controllers;

	use MVC\Router;
	use Model\Servicio;

	class ServicioController{

		public static function index(Router $router){
			isAdmin();
			$servicios = Servicio::all();
			$router->render('servicios/index',[
				'nombre' => $_SESSION['nombreUsuario'],
				'servicios' => $servicios
			]);
		}

		public static function crear(Router $router){
			isAdmin();
			$servicio = new Servicio;
			$alertas = [];
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$args['nombreServicio'] = $_POST['txtNombreServicio'];
				$args['precioServicio'] = $_POST['txtPrecioServicio'];
				$servicio->sincronizar($args);
				$alertas = $servicio->validar();
				if (empty($alertas)) {
					$servicio->guardar();
					header('Location: /servicios');
				}
			}
			$router->render('servicios/crear',[
				'nombre' => $_SESSION['nombreUsuario'],
				'servicio' => $servicio,
				'alertas' => $alertas
			]);
		}

		public static function actualizar(Router $router){
			isAdmin();
			$alertas = [];
			if (!is_numeric($_GET['idServicio'])) return;
			$servicio = Servicio::find($_GET['idServicio']);
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$args['nombreServicio'] = $_POST['txtNombreServicio'];
				$args['precioServicio'] = $_POST['txtPrecioServicio'];
				$args['idServicio'] = $_POST['idServicio'];
				$servicio->sincronizar($args);
				$alertas = $servicio->validar();
				if (empty($alertas)) {
					$servicio->guardar();
					header('Location: /servicios');
				}
			}
			$router->render('servicios/actualizar',[
				'nombre' => $_SESSION['nombreUsuario'],
				'servicio' => $servicio,
				'alertas' => $alertas
			]);
		}

		public static function eliminar(Router $router){
			isAdmin();
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$servicio = Servicio::find($_POST['idServicio']);
				$servicio->eliminar();
				header('Location: /servicios');
			}
		}
	}