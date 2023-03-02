<?php 
	namespace Model;

	class CitaServicio extends ActiveRecord{

		protected static $tabla = 'citasservicios';
		protected static $id = 'idCitaServicio';
		protected static $columnasDb = ['idCitaServicio', 'idCita', 'idServicio'];

		public $idCitaServicio;
		public $idCita;
		public $idServicio;

		public function __Construct($args = []){
			$this->idCitaServicio = $args['idCitaServicio'] ?? null;
			$this->idCita = $args['idCita'] ?? '';
			$this->idServicio = $args['idServicio'] ?? '';
		}
	}