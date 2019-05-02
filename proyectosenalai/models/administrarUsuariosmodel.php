<?php

class administrarUsuariosModel extends Model
{
    function __construct()
    {
        parent::__construct();

    }


    function verificarId($idPersona){
        $conexion = $this->db->connect();
        $consulta="SELECT Roles_idRoles from persona  where idPersona = ?";
        $stmt = $conexion->prepare($consulta);
        $stmt->bindParam(1, $idPersona, PDO::PARAM_INT );
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
        $conexion = null;
        $stmt= null;
        $result = null;       

    }


      function consultarUsuarios(){
            $conexion = $this->db->connect();
            $consulta="SELECT idPersona,Numero_Documento,Estado_idEstado,Nombre,Apellido_Primero,Telefono,Direccion,Numero_Celular,Email,Usuario,NombrePrograma,Numero_Ficha,NombreCiudad,NombreRoles,Tipo_Documento,NombreSexo,Apellido_Segundo FROM persona   JOIN Programa ON Persona.Programa_idPrograma=Programa.idPrograma  JOIN Ciudad ON Persona.Ciudad_idCiudad=Ciudad.idCiudad JOIN Roles ON Persona.Roles_idRoles=Roles.idroles JOIN Tipo_Documento ON Persona.Tipo_Documento_idTipo_Documento=Tipo_Documento.idTipo_Documento   JOIN Sexo ON Persona.Sexo_idSexo=Sexo.idSexo";
            $stmt = $conexion->prepare($consulta);
            $stmt->execute();
            return $stmt;
            $conexion = null;
            $stmt= null;           

        }

        function consultarUsuariosInstructores(){
            $conexion = $this->db->connect();
            $consulta="SELECT idPersona,Numero_Documento,Estado_idEstado,Nombre,Apellido_Primero,Telefono,Direccion,Numero_Celular,Email,Usuario,NombrePrograma,Numero_Ficha,NombreCiudad,NombreRoles,Tipo_Documento,NombreSexo,Apellido_Segundo FROM persona   JOIN Programa ON Persona.Programa_idPrograma=Programa.idPrograma  JOIN Ciudad ON Persona.Ciudad_idCiudad=Ciudad.idCiudad JOIN Roles ON Persona.Roles_idRoles=Roles.idroles JOIN Tipo_Documento ON Persona.Tipo_Documento_idTipo_Documento=Tipo_Documento.idTipo_Documento   JOIN Sexo ON Persona.Sexo_idSexo=Sexo.idSexo where Roles_idRoles in(1,2) ";
            $stmt = $conexion->prepare($consulta);
            $stmt->execute();
            return $stmt;
            $conexion = null;
            $stmt= null;           

        }

        


        function inhabilitarUsuario($idPersona){
            try {
           
            $conexion = $this->db->connect();
            $consulta="UPDATE persona set Estado_idEstado = '2' where idPersona = :idPersona ";
            $stmt = $conexion->prepare($consulta);
            $stmt->bindParam(':idPersona', $idPersona, PDO::PARAM_INT );
            $stmt->execute();
            $conexion = null;
            $stmt= null;
            return true;
            
            } catch (PDOException $e) {
                return false;
            }

            }
    
    
        function habilitarUsuario($idPersona){
            try {
           
            $conexion = $this->db->connect();
            $consulta="UPDATE persona set Estado_idEstado = '1' where idPersona = :idPersona ";
            $stmt = $conexion->prepare($consulta);
            $stmt->bindParam(':idPersona', $idPersona , PDO::PARAM_INT);
            $stmt->execute();
            $conexion = null;
            $stmt= null;
                
            } catch (PDOException $e) {
                    return false;
            }
    
            } 
            
        public  function consultarsexo(){

            $conexion = $this->db->connect();
            $consulta = "SELECT * from Sexo";
            $stmt = $conexion->prepare($consulta);
            $stmt->execute();
            return $stmt;
            $conexion = null;
            $stmt= null;
            
            
            }
            
            
            public function consultarCiudadesPorDepartamento($q){
                $conexion = $this->db->connect();
                $consulta="SELECT * from ciudad INNER JOIN departamento ON ciudad.Departamento_idDepartamento=departamento.idDepartamento where Departamento_idDepartamento =:q ";
                $stmt = $conexion->prepare($consulta);
                $stmt->bindParam(':q',$q, PDO::PARAM_INT);
                $stmt->execute();
                return $stmt;
                $conexion = null;
                $stmt= null;
                
            }

            public  function consultarciudad(){

                $conexion = $this->db->connect();
                $consulta = "SELECT * from ciudad";
                $stmt = $conexion->prepare($consulta);
                $stmt->execute();
                return $stmt;
                $conexion = null;
                $stmt= null;
            
             }
        
        
        
        
             public  function consultardepartamento(){
        
              $conexion = $this->db->connect();
              $consulta = "SELECT * from departamento";
              $stmt = $conexion->prepare($consulta);
              $stmt->execute();
              return $stmt;
              $conexion = null;
              $stmt= null;
          
           }
        
        
        
        
             public  function consultarrol(){
        
                $conexion = $this->db->connect();
                $consulta = "SELECT * from roles";
                $stmt = $conexion->prepare($consulta);
                $stmt->execute();
                return $stmt;
                $conexion = null;
                $stmt= null;
            
             }
        
        
        
             public  function consultarprograma(){
        
              $conexion = $this->db->connect();
              $consulta = "SELECT * from  Programa";
              $stmt = $conexion->prepare($consulta);
              $stmt->execute();
              return $stmt;
              $conexion = null;
              $stmt= null;
          
           }
        
        
             public  function consultartipodocumento(){
        
                $conexion = $this->db->connect();
                $consulta = "SELECT * from Tipo_Documento";
                $stmt = $conexion->prepare($consulta);
                $stmt->execute();
                return $stmt;
                $conexion = null;
                $stmt= null;
            
             }
        
        
        
                 /*Metodos para registrar un nuevo usuario*/
        
            public function  validaremailexiste($email){
              $conexion = $this->db->connect();
              $consulta ="SELECT Email from persona where  Email = :Email ";
              $stmt=$conexion->prepare($consulta);
              $stmt->bindParam(':Email',$email,PDO::PARAM_STR);
              $stmt->execute();
              $result = $stmt->fetch();
              return $result;
              $conexion = null;
              $stmt= null;
              $result = null; 
        
          }
        
        
          public function  validardocumentoexiste($documento){
            $conexion = $this->db->connect();
            $consulta ="SELECT Numero_Documento from persona where  Numero_Documento = :Documento ";
            $stmt=$conexion->prepare($consulta);
            $stmt->bindParam(':Documento',$documento,PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch();
            return $result;
            $conexion = null;
            $stmt= null;
            $result = null; 
        }
        
          public function  validarusuarioexiste($usuario){
              $conexion = $this->db->connect();
              $consulta ="SELECT * from persona where  Usuario = :Usuario ";
              $stmt=$conexion->prepare($consulta);
              $stmt->bindParam(':Usuario',$usuario,PDO::PARAM_STR);
              $stmt->execute();
              $result = $stmt->fetch();
              return $result;
              $conexion = null;
              $stmt= null;
              $result = null; 
        
          }
        
        
          public function  ingresarusuario($nombres,$apellido_primero,$apellido_segundo,$usuario,$rol,$tipodocumento,$documento,$ciudad,$direccion,$email,$sexo,$numero_celular,$telefono,$idprograma,$numero_ficha){
              $conexion = $this->db->connect();
              $contrasenaa = $documento;
              $defaultestado = 1;
              $contrasena = md5($contrasenaa);
              $consulta  ="INSERT into persona(Numero_Documento,Tipo_Documento_idTipo_Documento,Nombre,Apellido_Primero,Apellido_Segundo,Direccion,Email,Estado_idEstado,Telefono,Sexo_idSexo,Numero_Celular,Ciudad_idCiudad,Usuario,Contrasena,Roles_idRoles,Numero_Ficha,Programa_idPrograma) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
              $stmt=$conexion->prepare($consulta);
        
        
              $stmt->bindParam(1,$documento,PDO::PARAM_STR);
              $stmt->bindParam(2,$tipodocumento, PDO::PARAM_INT);
              $stmt->bindParam(3,$nombres,PDO::PARAM_STR);
              $stmt->bindParam(4,$apellido_primero,PDO::PARAM_STR);
              $stmt->bindParam(5,$apellido_segundo,PDO::PARAM_STR);
              $stmt->bindParam(6,$direccion,PDO::PARAM_STR);
              $stmt->bindParam(7,$email,PDO::PARAM_STR);
              $stmt->bindParam(8,$defaultestado, PDO::PARAM_INT);
              $stmt->bindParam(9,$telefono,PDO::PARAM_STR);
              $stmt->bindParam(10,$sexo, PDO::PARAM_INT);
              $stmt->bindParam(11,$numero_celular,PDO::PARAM_STR);
              $stmt->bindParam(12,$ciudad, PDO::PARAM_INT);
              $stmt->bindParam(13,$usuario,PDO::PARAM_STR);
              $stmt->bindParam(14,$contrasena,PDO::PARAM_STR);
              $stmt->bindParam(15,$rol, PDO::PARAM_INT);
              $stmt->bindParam(16,$numero_ficha, PDO::PARAM_INT);
              $stmt->bindParam(17,$idprograma, PDO::PARAM_INT);
        
        
        
        
              $stmt->execute();
              
              
        
          }
          
          
          public function consultarUsuario($idPersona){
            $conexion = $this->db->connect();
            $consulta="SELECT idPersona,Numero_Documento,Nombre,Apellido_Primero,Telefono,Direccion,Numero_Celular,Email,Usuario,Programa_idPrograma,Numero_Ficha,Ciudad_idCiudad,Roles_idRoles,Tipo_Documento_idTipo_Documento,Sexo_idSexo,Apellido_Segundo FROM persona  WHERE idPersona = :idPersona ";
            $stmt = $conexion->prepare($consulta);
            $stmt->bindParam(':idPersona',$idPersona,PDO::PARAM_INT);
            $stmt->execute();
            $resul = $stmt->fetch();
            return $resul;
            $conexion = null;
            $stmt= null;
            $resul= null;
        }
        
    
        public function  consultarDatosParaComparar($idPersona){
            $conexion = $this->db->connect();
            $consulta  ="SELECT Numero_Documento ,Usuario ,Email FROM persona WHERE idPersona = '$idPersona' ";
            $stmt = $conexion->prepare($consulta);
            $stmt->bindParam(':idPersona',$idPersona,PDO::PARAM_INT);
            $stmt->execute();
            $resul = $stmt->fetch();
            return $resul;
            $conexion = null;
            $stmt= null;
            $resul= null;
      
        }
    
    
        public function  actualizarUsuario($idPersona,$nombres,$apellido_primero,$apellido_segundo,$usuario,$rol,$tipodocumento,$documento,$ciudad,$direccion,$email,$sexo,$numero_celular,$telefono,$idprograma,$numero_ficha){
            $conexion = $this->db->connect();
            $consulta  ="UPDATE  persona  set Numero_Documento = ? ,Tipo_Documento_idTipo_Documento = ? ,Nombre=? ,Apellido_Primero= ? ,Apellido_Segundo= ? ,Direccion= ? ,Email=  ? ,Telefono= ? ,Sexo_idSexo= ? ,Numero_Celular= ? ,Ciudad_idCiudad= ? ,Usuario= ? ,Roles_idRoles= ? ,Numero_Ficha= ? ,Programa_idPrograma = ? where idPersona = ? ";
            $stmt=$conexion->prepare($consulta);
    
    
            $stmt->bindParam(1,$documento,PDO::PARAM_STR);
            $stmt->bindParam(2,$tipodocumento, PDO::PARAM_INT);
            $stmt->bindParam(3,$nombres,PDO::PARAM_STR);
            $stmt->bindParam(4,$apellido_primero,PDO::PARAM_STR);
            $stmt->bindParam(5,$apellido_segundo,PDO::PARAM_STR);
            $stmt->bindParam(6,$direccion,PDO::PARAM_STR);
            $stmt->bindParam(7,$email,PDO::PARAM_STR);
            $stmt->bindParam(8,$telefono,PDO::PARAM_STR);
            $stmt->bindParam(9,$sexo, PDO::PARAM_INT);
            $stmt->bindParam(10,$numero_celular,PDO::PARAM_STR);
            $stmt->bindParam(11,$ciudad, PDO::PARAM_INT);
            $stmt->bindParam(12,$usuario,PDO::PARAM_STR);
            $stmt->bindParam(13,$rol, PDO::PARAM_INT);
            $stmt->bindParam(14,$numero_ficha, PDO::PARAM_INT);
            $stmt->bindParam(15,$idprograma, PDO::PARAM_INT);
            $stmt->bindParam(16,$idPersona, PDO::PARAM_INT);
      
      
      
      
            $stmt->execute();
    
        }
               
}

?>