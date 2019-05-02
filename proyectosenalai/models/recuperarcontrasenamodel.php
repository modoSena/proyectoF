
<?php

class recuperarcontrasenamodel extends Model
{
    function __construct()
    {
        parent::__construct();

    }


    public function validarEmailRecuperarContrasena($email){

        $conexion = $this->db->connect();
        $consulta= "SELECT Email,Nombre from Persona where  Email= :Email ";
        $stmt = $conexion->prepare($consulta);
        $stmt->bindParam(':Email',$email,PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
        $conexion = null;
        $stmt= null;
        $result = null;
        
        }
        
        public function datosRecuperacion($codigo,$email,$fechaRecuperacion){
        
        $conexion = $this->db->connect();
        $consulta = " UPDATE persona SET CodigoRC = :Codigo, fecha_Recuperacion = :FeachaReacuperacion WHERE Email = :Email" ;
        $stmt = $conexion->prepare($consulta);
        $stmt->bindParam(':Codigo',$codigo,PDO::PARAM_STR);
        $stmt->bindParam(':Email',$email,PDO::PARAM_STR);
        $stmt->bindParam(':FeachaReacuperacion',$fechaRecuperacion,PDO::PARAM_STR);
        $stmt->execute();
        $conexion = null;
        $stmt= null;
        
        
        }
        
        
        public function codigoExiste($codigo){
        
        $conexion = $this->db->connect();;
        $consulta = "SELECT Numero_Documento,Fecha_Recuperacion  from persona where CodigoRC = :Codigo " ;
        $stmt = $conexion->prepare($consulta);
        $stmt->bindParam(':Codigo',$codigo ,PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
        $conexion = null;
        $stmt= null;
        $result = null;
        }
        
        public function actualizarContrasena($encriNuevaContrasena,$codigo){
        $conexion = $this->db->connect();
        $consulta = "UPDATE  persona set Contrasena =:EncriNuevaContrasena ,Fecha_Recuperacion='0000-00-00 00:00:00' where  CodigoRC = :Codigo";
        $stmt = $conexion->prepare($consulta);
        $stmt->bindParam(':EncriNuevaContrasena',$encriNuevaContrasena, PDO::PARAM_STR );
        $stmt->bindParam(':Codigo',$codigo, PDO::PARAM_STR);
        $stmt->execute();
        $conexion = null;
        $stmt= null;
        
        
        }





 

    
    
}

?>



