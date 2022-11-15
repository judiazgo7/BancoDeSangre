<?php 
class conexion{
    private $usuario="root";
    private $clave="root";
    private $bd="BancoDeSangre";
    private $puerto="3306";
    private $servidor="bd:3306"; # Nombre del servicio en docker-compose.yaml (nombre contenedor)
    
    public $sql;        // almacena una sentencia SQL para ser ejecutada
    public $res;        // almacena la respuesta a la ejecución de la sentencia SQL
    public $conector;   // Almacena la conexión activa con la BD
    
    public function __Construct(){
        $this->conector = new mysqli($this->servidor,$this->usuario,
        $this->clave,$this->bd,$this->puerto);
    }
    public function cerrar(){
        mysqli_close($this->conector); 
    }
}
?> 