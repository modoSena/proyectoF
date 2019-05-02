<?php

class loginModel extends Model
{
    function __construct()
    {
        parent::__construct();

    }


      function validarUsuario($usuario,$contrasena){
        $conexion = $this->db->connect();
        $consulta="SELECT Usuario,Contrasena,idPersona,Nombre,Apellido_Primero,Email,Telefono,Roles_idRoles,Estado_idEstado from Persona
        where Usuario = :Usuario and Contrasena =  :Contrasena  ";
        $stmt=$conexion->prepare($consulta);
        $stmt->bindParam(':Usuario',$usuario,PDO::PARAM_STR);
        $stmt->bindParam(':Contrasena',$contrasena,PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
        $conexion = null;
        $stmt= null;
        $result = null;  
        }


 

    
    
}

?>