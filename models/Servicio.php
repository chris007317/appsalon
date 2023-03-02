<?php 
	namespace Model;

	class Servicio extends ActiveRecord{

		protected static $tabla = 'Servicios';
		protected static $id = 'idServicio';
		protected static $columnasDb = ['idServicio', 'nombreServicio', 'precioServicio'];

		public $idServicio;
		public $nombreServicio;
		public $precioServicio;

		public function __Construct($args = []){
			$this->idServicio = $args['idServicio'] ?? null;
			$this->nombreServicio = $args['nombreServicio'] ?? '';
			$this->precioServicio = $args['precioServicio'] ?? '';
		}

		public function validar(){
			if (!$this->nombreServicio) {
				self::$alertas['error'][] = 'El nombre del servicio es obligatorio';
			}
			if (!$this->precioServicio) {
				self::$alertas['error'][] = 'El precio del servicio es obligatorio';
			}
			if (!is_numeric($this->precioServicio)) {
				self::$alertas['error'][] = 'El precio no es valido';
			}
			return self::$alertas;
		}
	}