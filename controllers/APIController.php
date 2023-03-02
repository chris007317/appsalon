<?php 
	namespace Controllers;

	use Model\Servicio;
	use Model\Cita;
	use Model\CitaServicio;

	class APIController{

		public static function index(){
			isAdmin();
			$servicios = Servicio::all();
			echo json_encode($servicios);
		}

		public static function guardar() {
			// Guardar la cita
			$cita = new Cita($_POST);
			$respuesta = $cita->guardar();
			$idCita = $respuesta['id'];
			// Registra los servicios
			$idServicios = explode(',', $_POST['idServicios']);
			foreach ($idServicios as $idServicio) {
				$args = [
					'idCita' => $idCita,
					'idServicio' => $idServicio
				];
				$citaServicio = new CitaServicio($args);
				$citaServicio->guardar();
			}
			echo json_encode($respuesta);
		}

		public static function eliminar(){
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				$idCita = $_POST['idCita'];
				$cita = Cita::find($idCita);
				$cita->eliminar();
				header('Location:'.$_SERVER['HTTP_REFERER']);
			}
		}
	}
