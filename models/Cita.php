<?php 
	namespace Model;

	class Cita extends ActiveRecord{

		protected static $tabla = 'citas';
		protected static $id = 'idCita';
		protected static $columnasDb = ['idCita', 'fechaCita', 'horaCita', 'idUsuarioCita'];

		public $idCita;
		public $fechaCita;
		public $horaCita;
		public $idUsuarioCita;

		public function __Construct($args = []){
			//self::$idFun = $args['idCita'] ?? null;
			$this->idCita = $args['idCita'] ?? null;
			$this->fechaCita = $args['fechaCita'] ?? '';
			$this->horaCita = $args['horaCita'] ?? '';
			$this->idUsuarioCita = $args['idUsuarioCita'] ?? '';
		}

	}