<?php 
	namespace Model;
	class AdminCita extends ActiveRecord{
		protected static $tabla = 'citas';
		protected static $id = 'citas.idCita';
		protected static $columnasDb = ['idCita', 'horaCita', 'cliente', 'emailUsuario', 'telefonoUsuario', 'nombreServicio', 'precioServicio'];

		public $idCita;
		public $horaCita;
		public $cliente;
		public $emailUsuario;
		public $telefonoUsuario;
		public $nombreServicio;
		public $precioServicio;

		public function __Construct($args = []){
			$this->idCita = $args['idCita'] ?? null;
			$this->horaCita = $args['horaCita'] ?? '';
			$this->cliente = $args['cliente'] ?? '';
			$this->emailUsuario = $args['emailUsuario'] ?? '';
			$this->telefonoUsuario = $args['telefonoUsuario'] ?? '';
			$this->nombreServicio = $args['nombreServicio'] ?? '';
			$this->precioServicio = $args['precioServicio'] ?? '';
		}
	}