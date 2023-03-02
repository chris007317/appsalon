<?php
namespace Model;
class ActiveRecord {

  // BASE DE DATOS
    protected static $baseDatos;
    protected static $columnasDb = [];
    protected static $tabla = '';
    protected static $id = '';
    //alertas
    protected static $alertas = [];
    protected static $idFun = null;

    public function guardar(){
        if (!is_null(self::$idFun)) {
            $resultado = $this->actualizar();
        }else{
            $resultado = $this->crear();
        }
        return $resultado;
    }

    public function crear(){
        // sanitizar los datos
        $atributos = $this->sanitizarDatos();
        $query = "INSERT INTO ".static::$tabla." ( ".join(", ", array_keys($atributos))." ) VALUES (".join(", ", array_values($atributos)).")";
        // Resultado de la consulta
        $resultado = self::$baseDatos->query($query);
        return [
           'resultado' =>  $resultado,
           'id' => self::$baseDatos->insert_id
        ];
    }

    public function actualizar(){
        $atributos = $this->sanitizarDatos();
        $valores = [];
        foreach($atributos as $key => $valor){
            $valores[] = "{$key} = {$valor}";
        }
        $query = "UPDATE ".static::$tabla." SET ";
        $query .= join(", ", $valores);
        $query .= " WHERE ".static::$id." = '".self::$baseDatos->escape_string(self::$idFun)."'";
        $query .= " LIMIT 1 ";
        $resultado = self::$baseDatos->query($query);
        return $resultado;
    }

    public function eliminar(){
        $query = "DELETE FROM ".static::$tabla." WHERE ".static::$id." = ".self::$baseDatos->escape_string(self::$idFun)." LIMIT 1";
        $resultado = self::$baseDatos->query($query);
        return $resultado;
    }

    //Definir la conexión a la base de datos
    public static function setDb($dataBase){
        self::$baseDatos = $dataBase;
    }
    //Identificar y unir los atributos de la DB
    public function atributos(){
        $atributos = [];
        foreach (static::$columnasDb as $columna) {
            if ($columna === static::$id) continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    public function sanitizarDatos(){
        $atributos = $this->atributos();
        $sanitizado = [];
        foreach ($atributos as $key => $value) {
            $sanitizado[$key] = "'".self::$baseDatos->escape_string($value)."'";
        }
        return $sanitizado;
    }
    //subaida de archivos
    public function setImagen($imgPropiedad){
        //elimina la imagen previa
        if (!is_null($this->idPropiedad)) {
            // Comporbar si existe el archivo
            $this->eliminarImagen();
        }
        //asignar el nombre de la imagen
        if ($imgPropiedad) {
            $this->imgPropiedad = $imgPropiedad;
        }
    }

    public function eliminarImagen(){
        $existeArchivo = file_exists(CARPETA_IMAGENES.$this->imgPropiedad);
        if ($existeArchivo) {
            unlink(CARPETA_IMAGENES.$this->imgPropiedad);
        }
    }

    //Validación
    public static function getAlertas(){
        return static::$alertas;
    }

    public static function setAlerta($tipo, $mensaje){
        static::$alertas[$tipo][] = $mensaje;
    }

    public function validar(){
        static::$alertas = [];
        return static::$alertas;
    }

    public static function all(){
        $query = "SELECT * FROM ".static::$tabla;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    public static function get($cantidad){
        $query = "SELECT * FROM ".static::$tabla." LIMIT $cantidad";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    public static function find($idFInd){
        $query = "SELECT * FROM ".static::$tabla." WHERE ".static::$id." = ${idFInd} LIMIT 1";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }

    public static function where($columna, $valor){
        $query = "SELECT * FROM ".static::$tabla." WHERE ${columna} = '${valor}' LIMIT 1";
        $resultado = self::consultarSQL($query);
        $resultado = array_shift($resultado);
        return $resultado;
    }

    public static function SQL($consulta){
        $resultado = self::consultarSQL($consulta);
        return $resultado;   
    }

    public static function consultarSQL($query){
        // consuiltar base de datos
        $resultado = self::$baseDatos->query($query);
        // Iterar los resultados
        $arrData = [];
        while ($registro = $resultado->fetch_assoc()) {
            $arrData[] = static::crearObjeto($registro);
        }
        // liberar memorario
        $resultado->free();
        //Retornar el resultado
        return $arrData;
    }

    protected static function crearObjeto($registro){
        $con = 0;
        $objeto = new static;
        foreach ($registro as $key => $value) {
            if($con === 0){
                self::$idFun = $registro[$key];
                $con++;
            }
            if (property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }

    // Sincroniza el objeto en memoria con los cambios realizados por el usuario
    public function sincronizar($args = []){
        foreach($args as $key => $value){
            if (property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }

    }
}