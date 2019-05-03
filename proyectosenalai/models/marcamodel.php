<?php

class marcamodel extends Model
{
    function __construct()
    {
        parent::__construct();

    }
    function consultarMarcas(){
        $conexion = $this->db->connect();
        $consulta="SELECT * from marcas";
        $stmt = $conexion->prepare($consulta);
        $stmt->execute();
        return $stmt;
        $conexion = null;
        $stmt= null;      
    }

    
    function validarNombreMarca($Marca){
        $conexion = $this->db->connect();
        $consulta="SELECT Marca from marcas where Marca = ?";
        $stmt = $conexion->prepare($consulta);
        $stmt->bindParam(1, $Marca, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
        $conexion = null;
        $stmt= null;
        $result = null;   
    }


    function consultarMarca($idMarcas){
        $conexion = $this->db->connect();
        $consulta="SELECT * from marcas where idMarcas = ?" ;
        $stmt = $conexion->prepare($consulta);
        $stmt->bindParam(1, $idMarcas, PDO::PARAM_INT );
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
        $conexion = null;
        $stmt= null;
        $result = null;
    }

    function actualizarMarca($idMarcas,$Marca){
        $conexion = $this->db->connect();
        $consulta="UPDATE marcas SET Marca = ? where idMarcas = ? ";
        $stmt = $conexion->prepare($consulta);
        $stmt->bindParam(1, $Marca, PDO::PARAM_STR );
        $stmt->bindParam(2, $idMarcas, PDO::PARAM_INT );
        $stmt->execute();
        $conexion = null;
        $stmt= null;
        $result = null;  


    }

    function registrarMarca($Marca){
        $conexion = $this->db->connect();
        $consulta = "INSERT INTO marcas (Marca) values(?)";        
        $stmt = $conexion->prepare($consulta);
        $stmt->bindParam(1,$Marca,PDO::PARAM_INT);
        $stmt->execute();
        $conexion = null;
        $stmt= null;  
    }
    
}
?>