<?php

class actualizarDatosModel extends Model
{
    function __construct()
    {
        parent::__construct();
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
        
          public function consultarUsuario($idPersona){
            $conexion = $this->db->connect();
            $consulta="SELECT NombreCiudad,NombreSexo,NombrePrograma,NombreRoles,Tipo_Documento,idPersona,Numero_Documento,Nombre,Apellido_Primero,Telefono,Direccion,Numero_Celular,Email,Usuario,Programa_idPrograma,Numero_Ficha,Ciudad_idCiudad,Roles_idRoles,Tipo_Documento_idTipo_Documento,Sexo_idSexo,Apellido_Segundo FROM persona JOIN Programa ON Persona.Programa_idPrograma=Programa.idPrograma  JOIN Ciudad ON Persona.Ciudad_idCiudad=Ciudad.idCiudad JOIN Roles ON Persona.Roles_idRoles=Roles.idroles JOIN Tipo_Documento ON Persona.Tipo_Documento_idTipo_Documento=Tipo_Documento.idTipo_Documento   JOIN Sexo ON Persona.Sexo_idSexo=Sexo.idSexo WHERE idPersona = :idPersona ";
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
    
        public function  actualizarUsuario($idPersona,$ciudad,$direccion,$email,$sexo,$numero_celular,$telefono){
            $conexion = $this->db->connect();
            $consulta  ="UPDATE  persona  set   Direccion= ? ,Email=  ? ,Telefono= ? ,Sexo_idSexo= ? ,Numero_Celular= ? ,Ciudad_idCiudad= ?   where idPersona = ? ";
            $stmt=$conexion->prepare($consulta);
            $stmt->bindParam(1,$direccion,PDO::PARAM_STR);
            $stmt->bindParam(2,$email,PDO::PARAM_STR);
            $stmt->bindParam(3,$telefono,PDO::PARAM_STR);
            $stmt->bindParam(4,$sexo, PDO::PARAM_INT);
            $stmt->bindParam(5,$numero_celular,PDO::PARAM_STR);
            $stmt->bindParam(6,$ciudad, PDO::PARAM_INT);
            $stmt->bindParam(7,$idPersona, PDO::PARAM_INT);
            $stmt->execute();
        }            
}
?>