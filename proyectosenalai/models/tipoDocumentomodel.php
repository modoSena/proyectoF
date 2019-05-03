<?php

class tipoDocumentomodel extends Model
{
    function __construct()
    {
        parent::__construct();

    }
    function consultartipoDocumentos(){
        $conexion = $this->db->connect();
        $consulta="SELECT * from tipo_documento";
        $stmt = $conexion->prepare($consulta);
        $stmt->execute();
        return $stmt;
        $conexion = null;
        $stmt= null;      
    }

    
    function validarNombretipoDocumento($tipoDocumento){
        $conexion = $this->db->connect();
        $consulta="SELECT Tipo_Documento from tipo_documento where Tipo_Documento = ?";
        $stmt = $conexion->prepare($consulta);
        $stmt->bindParam(1, $tipoDocumento, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
        $conexion = null;
        $stmt= null;
        $result = null;   
    }


    function consultartipoDocumento($idTipo_Documento){
        $conexion = $this->db->connect();
        $consulta="SELECT * from tipo_documento where idTipo_Documento = ?" ;
        $stmt = $conexion->prepare($consulta);
        $stmt->bindParam(1, $idTipo_Documento, PDO::PARAM_INT );
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
        $conexion = null;
        $stmt= null;
        $result = null;
    }

    function actualizartipoDocumento($idTipo_Documento,$Tipo_Documento){
        $conexion = $this->db->connect();
        $consulta="UPDATE tipo_documento SET Tipo_Documento = ? where idTipo_Documento = ? ";
        $stmt = $conexion->prepare($consulta);
        $stmt->bindParam(1, $Tipo_Documento, PDO::PARAM_STR );
        $stmt->bindParam(2, $idTipo_Documento, PDO::PARAM_INT );
        $stmt->execute();
        $conexion = null;
        $stmt= null;
        $result = null;  


    }

    function registrartipoDocumento($Tipo_Documento){
        $conexion = $this->db->connect();
        $consulta = "INSERT INTO tipo_documento (Tipo_Documento) values(?)";        
        $stmt = $conexion->prepare($consulta);
        $stmt->bindParam(1,$Tipo_Documento,PDO::PARAM_INT);
        $stmt->execute();
        $conexion = null;
        $stmt= null;  
    }
    
}
?>