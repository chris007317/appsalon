<?php 
	namespace Model;

	Class Usuario extends ActiveRecord{

		protected static $tabla = 'usuarios';
		protected static $id = 'idUsuario';
		protected static $columnasDb = ['idUsuario', 'nombreUsuario', 'apellidosUsuario', 'emailUsuario', 'contraUsuario', 'telefonoUsuario', 'adminUsuario', 'estadoUsuario', 'tokenUsuario'];

		public $idUsuario;
		public $nombreUsuario;
		public $apellidosUsuario;
		public $emailUsuario;
		public $contraUsuario;
		public $telefonoUsuario;
		public $adminUsuario;
		public $estadoUsuario;
		public $tokenUsuario;
		public $nuevaContra;

		public function __Construct($args = []){
			self::$idFun = $args['idUsuario'] ?? null;
			$this->idUsuario = $args['idUsuario'] ?? null;
			$this->nombreUsuario = $args['nombreUsuario'] ?? '';
			$this->apellidosUsuario = $args['apellidosUsuario'] ?? '';
			$this->emailUsuario = $args['emailUsuario'] ?? '';
			$this->contraUsuario = $args['contraUsuario'] ?? '';
			$this->telefonoUsuario = $args['telefonoUsuario'] ?? '';
			$this->adminUsuario = $args['adminUsuario'] ?? '0';
			$this->estadoUsuario = $args['estadoUsuario'] ?? '0';
			$this->tokenUsuario = $args['tokenUsuario'] ?? '';
		}
		/* Mensajes de validación para la creacuón de la cuenta */
		public function validarNuevaCuenta(){
			if(!$this->nombreUsuario){
				self::$alertas['error'][] = 'El nombre del cliente es obligatorio';
			}
			if(!$this->apellidosUsuario){
				self::$alertas['error'][] = 'Los apellidos son obligatorios';
			}
			if(!$this->emailUsuario){
				self::$alertas['error'][] = 'El email es obligatorio';
			}
			if(!$this->telefonoUsuario){
				self::$alertas['error'][] = 'El teléfono es obligatorio';
			}
			if(!$this->contraUsuario){
				self::$alertas['error'][] = 'La contraseña es obligatoria';
			}
			if (strlen($this->contraUsuario) < 6) {
				self::$alertas['error'][] = 'La contraseña debe tener al menos 6 carateres';
			}
			return self::$alertas;
		}
		
		public function existeUsuario(){
			$query = "SELECT * FROM " . self::$tabla . " WHERE emailUsuario = '" . $this->emailUsuario . "' LIMIT 1;";
			$resultado = self::$baseDatos->query($query);
			if($resultado->num_rows){
				self::$alertas['error'][] = 'El usuario ya está registrado';
			}
			return $resultado;
		}

		public function hashPassword(){
			echo '<pre>'; var_dump(self::$idFun); echo '</pre>';
			$this->contraUsuario = password_hash($this->contraUsuario, PASSWORD_BCRYPT);
		}

		public function crearToken(){
			$this->tokenUsuario = uniqid();
		}

		public function validarLogin(){
			if (!$this->emailUsuario) {
				self::$alertas['error'][] = 'El email es obligatorio';
			}

			if (!$this->contraUsuario) {
				self::$alertas['error'][] = 'La contraseña es obligatoria';
			}

			return self::$alertas;
		}

		public function comporbarContraVeificado($contra){
			$validar = password_verify($contra, $this->contraUsuario);
			if (!$validar || !$this->estadoUsuario) {
				self::$alertas['error'][] = 'Contraseña incorrecta o cuenta no confirmada';
			}else{
				return true;
			}
			return false;
		}

		public function validarEmail(){
			if (!$this->emailUsuario) {
				self::$alertas['error'][] = 'El email es obligatorio';
			}
			return self::$alertas;
		}

		public function validarContraNueva(){

			if (!$this->nuevaContra) {
				self::$alertas['error'][] = 'La contraseña es obligatorio';
			}
			if (strlen($this->nuevaContra) < 6) {
				self::$alertas['error'][] = 'La contraseña debe tener al menos 6 caracteres';
			}
			return self::$alertas;
		}
	}