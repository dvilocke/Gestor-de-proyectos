<?php

class Conexion{
    private $servidor = "localhost";
    private $usuario = "root";
    private $clave = "";
    private $conexion;

    public function __construct(){
       try{
           $this->conexion = new PDO("mysql:host=$this->servidor;dbname=album", $this->usuario, $this->clave);
           $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

       }catch(PDOException $error){
           return "falla de conexion " . $error;
       } 
    }

    public function ejecutar($sql){//insertar, delete, actualizar
        $this->conexion->exec($sql);
        return $this->conexion->lastInsertId();
    }
    
    public function consultar($sql){
        $setencia = $this->conexion->prepare($sql);
        $setencia->execute();
        #retorna todos los registros que tu puedas consultar con tu sentencia
        return $setencia->fetchAll();
    }
}

?>