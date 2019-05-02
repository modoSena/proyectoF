<?php

class programamodel extends Model
{
    function __construct()
    {
        parent::__construct();

    }
    function consultarProgramas(){
        $conexion = $this->db->connect();
        $consulta="SELECT * from programa";
        $stmt = $conexion->prepare($consulta);
        $stmt->execute();
        return $stmt;
        $conexion = null;
        $stmt= null;      
    }

    
    function validarNombrePrograma($Programa){
        $conexion = $this->db->connect();
        $consulta="SELECT NombrePrograma from programa where NombrePrograma = ?";
        $stmt = $conexion->prepare($consulta);
        $stmt->bindParam(1, $Programa, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
        $conexion = null;
        $stmt= null;
        $result = null;   
    }


    function consultarPrograma($idPrograma){
        $conexion = $this->db->connect();
        $consulta="SELECT * from programa where idPrograma = ?" ;
        $stmt = $conexion->prepare($consulta);
        $stmt->bindParam(1, $idPrograma, PDO::PARAM_INT );
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
        $conexion = null;
        $stmt= null;
        $result = null;
    }

    function actualizarPrograma($idPrograma,$NombrePrograma){
        $conexion = $this->db->connect();
        $consulta="UPDATE programa SET NombrePrograma = ? where idPrograma = ? ";
        $stmt = $conexion->prepare($consulta);
        $stmt->bindParam(1, $NombrePrograma, PDO::PARAM_STR );
        $stmt->bindParam(2, $idPrograma, PDO::PARAM_INT );
        $stmt->execute();
        $conexion = null;
        $stmt= null;
        $result = null;  


    }

    function registrarPrograma($NombrePrograma){
        $conexion = $this->db->connect();
        $consulta = "INSERT INTO Programa (NombrePrograma) values(?)";        
        $stmt = $conexion->prepare($consulta);
        $stmt->bindParam(1,$NombrePrograma,PDO::PARAM_INT);
        $stmt->execute();
        $conexion = null;
        $stmt= null;  
    }
    
}
?>