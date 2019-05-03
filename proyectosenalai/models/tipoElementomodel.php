<?php

class tipoElementomodel extends Model
{
    function __construct()
    {
        parent::__construct();

    }
    function consultartipoElementos(){
        $conexion = $this->db->connect();
        $consulta="SELECT * from tipo_elementos";
        $stmt = $conexion->prepare($consulta);
        $stmt->execute();
        return $stmt;
        $conexion = null;
        $stmt= null;      
    }

    
    function validarNombretipoElemento($NombreTipoElemento){
        $conexion = $this->db->connect();
        $consulta="SELECT NombreTipoElemento from tipo_elementos where NombreTipoElemento = ?";
        $stmt = $conexion->prepare($consulta);
        $stmt->bindParam(1, $NombreTipoElemento, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
        $conexion = null;
        $stmt= null;
        $result = null;   
    }


    function consultartipoElemento($idTipo_Elementos){
        $conexion = $this->db->connect();
        $consulta="SELECT * from tipo_elementos where idTipo_Elementos = ?" ;
        $stmt = $conexion->prepare($consulta);
        $stmt->bindParam(1, $idTipo_Elementos, PDO::PARAM_INT );
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
        $conexion = null;
        $stmt= null;
        $result = null;
    }

    function actualizartipoElemento($idTipo_Elementos,$NombreTipoElemento){
        $conexion = $this->db->connect();
        $consulta="UPDATE tipo_elementos SET NombreTipoElemento = ? where idTipo_Elementos = ? ";
        $stmt = $conexion->prepare($consulta);
        $stmt->bindParam(1, $NombreTipoElemento, PDO::PARAM_STR );
        $stmt->bindParam(2, $idTipo_Elementos, PDO::PARAM_INT );
        $stmt->execute();
        $conexion = null;
        $stmt= null;
        $result = null;  


    }

    function registrartipoElemento($NombreTipoElemento){
        $conexion = $this->db->connect();
        $consulta = "INSERT INTO tipo_elementos (NombreTipoElemento) values(?)";        
        $stmt = $conexion->prepare($consulta);
        $stmt->bindParam(1,$NombreTipoElemento,PDO::PARAM_INT);
        $stmt->execute();
        $conexion = null;
        $stmt= null;  
    }
    
}
?>