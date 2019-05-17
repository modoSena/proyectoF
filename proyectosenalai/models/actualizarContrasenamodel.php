<?php 

class actualizarContrasenamodel extends Model{   
  


    public function actualizarContrasena($encriNuevaContrasena,$idPersona){
        $conexion = $this->db->connect();
        $consulta = "UPDATE  persona set contrasena = ? where  idPersona = ?";
        $stmt=$conexion->prepare($consulta);
        $stmt->bindParam(1,$encriNuevaContrasena,PDO::PARAM_STR);
        $stmt->bindParam(2,$idPersona, PDO::PARAM_INT);
        $stmt->execute();
        $conexion = null;
        $stmt= null;

    }

}

?>