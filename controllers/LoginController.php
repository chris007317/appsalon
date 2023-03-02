<?php 
	namespace Controllers;

	use MVC\Router;
	use Model\Usuario;
	use Classes\Email;

	Class LoginController{

		public static function login(Router $router){
			$alertas = [];
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				$args['emailUsuario'] = $_POST['txtEmail'];
				$args['contraUsuario'] = $_POST['txtContra'];
				$ingresar = new Usuario($args);
				$alertas = $ingresar->validarLogin();
				if (empty($alertas)) {
					$usuario = Usuario::where('emailUsuario', $ingresar->emailUsuario);
					if ($usuario) {
						// Verificar la contraseña
						$validar = $usuario->comporbarContraVeificado($ingresar->contraUsuario);
						if ($validar) {
							// Autenticar al usuario
							session_start();
							$_SESSION['idUsuario'] = $usuario->idUsuario;
							$_SESSION['nombreUsuario'] = $usuario->nombreUsuario . " " . $usuario->apellidosUsuario;
							$_SESSION['emailUsuario'] = $usuario->emailUsuario;
							$_SESSION['login'] = true;
							// Redireccionar
							if ($usuario->adminUsuario === "1"){
								$_SESSION['admin'] = $usuario->adminUsuario ?? null;
								header('Location: /admin');
							}else{
								header('Location: /cita');
							}
						}
					}else{
						Usuario::setAlerta('error', 'Usuario no encontrado');
					}
				}
			}
			$alertas = Usuario::getAlertas();
			$router->render('auth/login',[
				'alertas' => $alertas
			]);
		}

		public static function logout(){
			$_SESSION = [];
			header('Location: /');
		}

		public static function olvide(Router $router){
			$alertas = [];
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				$args['emailUsuario'] = $_POST['txtEmail'];
				$olvide = new Usuario($args);
				$alertas = $olvide->validarEmail();
				if (empty($alertas)) {
					$usuario = Usuario::where('emailUsuario', $olvide->emailUsuario);
					if ($usuario && $usuario->estadoUsuario === "1") {
						$usuario->crearToken();
						$usuario->guardar();
						// Enviar el email
						$email = new Email($usuario->emailUsuario, $usuario->nombreUsuario, $usuario->tokenUsuario);
						$email->enviarInstricuciones();
						//Alerta de exito
						Usuario::setAlerta('exito', 'Reviza la bandeja de entrada de email');
					}else{
						Usuario::setAlerta('error', 'El usuario no existe o no esta confirmado o no existe');
					}
				}
			}
			$alertas = Usuario::getAlertas();
			$router->render('auth/olvide',[
				'alertas' => $alertas
			]);
		}

		public static function recuperar(Router $router){
			$alertas = [];
			$error = false;
			$token = validarInput($_GET['token']);
			// Buscar al usuario por su token
			$usuario = Usuario::where('tokenUsuario', $token);
			if (empty($usuario)) {
				$error = true;
				Usuario::setAlerta('error', 'Token no valido');
			}
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				$usuario->nuevaContra = $_POST['txtContraNueva'];
				$alertas = $usuario->validarContraNueva();
				if (empty($alertas)) {
					$usuario->contraUsuario = null;
					$usuario->contraUsuario = $usuario->nuevaContra;
					$usuario->hashPassword();
					$usuario->tokenUsuario = null;
					$resultado = $usuario->guardar();
					if ($resultado) {
						header('Location: /');
					}
				}

			}
			$alertas = Usuario::getAlertas();
			$router->render('auth/recuperar-contra', [
				'alertas' => $alertas,
				'error' => $error
			]);
		}

		public static function crear(Router $router){
			$usuario = new Usuario;
			$alertas[] = '';
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				$args['nombreUsuario'] = $_POST['txtNombre'];
				$args['apellidosUsuario'] = $_POST['txtApellidos'];
				$args['telefonoUsuario'] = $_POST['txtTelefono'];
				$args['emailUsuario'] = $_POST['txtEmail'];
				$args['contraUsuario'] = $_POST['txtContra'];
				$usuario->sincronizar($args);
				$alertas = $usuario->validarNuevaCuenta();
				if (empty($alertas)) {
					$resultado = $usuario->existeUsuario();
					if ($resultado->num_rows) {
						$alertas = Usuario::getAlertas();
					}else{
						$usuario->hashPassword();
						//Generar un token único
						$usuario->crearToken();
						//Enviar el email
						$email = new Email($usuario->emailUsuario, $usuario->nombreUsuario, $usuario->tokenUsuario);
						$email->enviarConfirmacion();
						$resultado = $usuario->guardar();
						if ($resultado) {
							header('Location: /mensaje');
						}
					}
				}

			}
			$router->render('auth/crear-cuenta',[
				'usuario' => $usuario,
				'alertas' => $alertas
			]);
		}

		public static function mensaje(Router $router){
			$router->render('auth/mensaje');
		}

		public static function confirmar(Router $router){
			$alertas = [];
			$token = validarInput($_GET['token']);
			$usuario = new Usuario();
			$usuario = $usuario->where('tokenUsuario', $token);
			if (empty($usuario)) {
				// Mostrar mensaje de error
				Usuario::setAlerta('error', 'Token no valido');
			}else{
				// Modificar a usuario confirmado
				$usuario->estadoUsuario = 1;
				$usuario->tokenUsuario = null;
				$resultado = $usuario->guardar();
				if ($resultado) {
					Usuario::setAlerta('exito', 'Cuenta confirmada de forma exitosa');
				}
			}
			$alertas = Usuario::getAlertas();
			$router->render('auth/confirmar-cuenta',[
				'alertas' => $alertas
			]);	
			
		}
	}