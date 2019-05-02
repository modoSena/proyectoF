<?php

class ambientesModel extends Model{
    function __construct()
    {
        parent::__construct();
        
    }



     function consultarAmbientes(){
        $conexion = $this->db->connect();
        $consulta="SELECT Numero_Ambiente,Numero_Documento,Nombre,Numero_Celular,Estado_Ambientes_idEstado_Ambientes,idAmbientes,NombreUbicacion,NombreEstadoA from ambientes JOIN persona ON Persona.idPersona=ambientes.Cuentadante JOIN ubicacion ON ambientes.Ubicacion_idUbicacion=ubicacion.idUbicacion  JOIN estado_ambientes ON ambientes.Estado_Ambientes_idEstado_Ambientes=estado_ambientes.idEstado_Ambientes";
        $stmt = $conexion->prepare($consulta);
        $stmt->execute();
        return $stmt;
        $conexion = null;
        $stmt= null;
        
    }




     function consultarIdPersona($Cuentadante){

        $conexion = $this->db->connect();
        $consulta = "SELECT idPersona from Persona where Numero_Documento= :Numero_Documento";
        $stmt=$conexion->prepare($consulta);
        $stmt->bindParam(':Numero_Documento',$Cuentadante,PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
        $conexion = null;
        $stmt= null;
        $result = null; 

    }



     function ambienteExiste($numeroAmbiente,$ubicacion){

        $conexion = $this->db->connect();
        $consulta = "SELECT Numero_Ambiente from Ambientes  where Numero_Ambiente= :Numero_Ambiente and Ubicacion_idUbicacion =:ubicacion ";
        $stmt=$conexion->prepare($consulta);
        $stmt->bindParam(':Numero_Ambiente',$numeroAmbiente,PDO::PARAM_INT);
        $stmt->bindParam(':ubicacion',$ubicacion,PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
        $conexion = null;
        $stmt= null;
        $result = null; 

    }


     function registrarAmbiente($NumeroAmbiente,$idCuentadante,$ubicacion){
        $estado = 1;
        $conexion = $this->db->connect();
        $consulta = "INSERT INTO Ambientes  (Numero_Ambiente,Cuentadante,Estado_Ambientes_idEstado_Ambientes,Ubicacion_idUbicacion) values(?,?,?,?)";        
        $stmt = $conexion->prepare($consulta);
        $stmt->bindParam(1,$NumeroAmbiente,PDO::PARAM_INT);
        $stmt->bindParam(2,$idCuentadante ,PDO::PARAM_INT);
        $stmt->bindParam(3,$estado,PDO::PARAM_INT);
        $stmt->bindParam(4,$ubicacion,PDO::PARAM_INT);
        
        $stmt->execute();
        $conexion = null;
        $stmt= null;

       
    }



    function inhabilitarambiente($idAmbientes){
        try {
       
        $conexion = $this->db->connect();
        $consulta="UPDATE ambientes set Estado_Ambientes_idEstado_Ambientes = '2' where idAmbientes = :idAmbientes ";
        $stmt = $conexion->prepare($consulta);
        $stmt->bindParam(':idAmbientes', $idAmbientes, PDO::PARAM_INT );
        $stmt->execute();
        $conexion = null;
        $stmt= null;
        return true;
        
        } catch (PDOException $e) {
            return false;
        }

        }


    function habilitarambiente($idAmbientes){
        try {
       
        $conexion = $this->db->connect();
        $consulta="UPDATE ambientes set Estado_Ambientes_idEstado_Ambientes = '1' where idAmbientes = :idAmbientes ";
        $stmt = $conexion->prepare($consulta);
        $stmt->bindParam(':idAmbientes', $idAmbientes, PDO::PARAM_INT );
        $stmt->execute();
        $conexion = null;
        $stmt= null;
        return true;
        
        } catch (PDOException $e) {
            return false;
        }

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
        
        function consultarAmbiente($idAmbientes){
            $conexion = $this->db->connect();
            $consulta="SELECT Numero_Ambiente,Numero_Documento,idAmbientes,idPersona,Ubicacion_idUbicacion from ambientes JOIN persona ON Persona.idPersona=ambientes.Cuentadante  JOIN ubicacion ON ambientes.Ubicacion_idUbicacion=ubicacion.idUbicacion  where idAmbientes= ?";
            $stmt = $conexion->prepare($consulta);
            $stmt->bindParam(1,$idAmbientes,PDO::PARAM_INT);
            $stmt->execute();
            $resul = $stmt->fetch();
            return $resul;
            $conexion = null;
            $stmt= null;
            $resul= null;
            
        }

        function actualizarAmbiente($NumeroAmbiente,$Cuentadante,$Ubicacion,$idAmbientes){

            $conexion = $this->db->connect();
            $consulta="UPDATE ambientes set Numero_Ambiente = ? , Cuentadante = ? ,Ubicacion_idUbicacion = ? where idAmbientes = ? ";
            $stmt = $conexion->prepare($consulta);
            $stmt->bindParam(1, $NumeroAmbiente, PDO::PARAM_INT );
            $stmt->bindParam(2, $Cuentadante, PDO::PARAM_INT );
            $stmt->bindParam(3, $Ubicacion, PDO::PARAM_INT );
            $stmt->bindParam(4, $idAmbientes, PDO::PARAM_INT );

            $stmt->execute();
            $conexion = null;
            $stmt= null;
            

        }


        function consultarElementos($idAmbientes){

            $conexion = $this->db->connect();
            $consulta="SELECT idElementos,Ambientes_idAmbientes,Numero_Serial,Placa_Equipo,Tipo_Equipo_idTipo_Equipo,Fecha_Salida,Fecha_Entrada,Marca,Estado_Elementos_idEstado_Elementos,NombreEstado,NombreTipoElemento from elementos JOIN tipo_elementos ON elementos.Tipo_Equipo_idTipo_Equipo=tipo_elementos.idTipo_Elementos JOIN estado_elementos ON elementos.Estado_Elementos_idEstado_Elementos=estado_elementos.idEstado_Elementos  JOIN Marcas ON elementos.Marcas_idMarcas =Marcas.idMarcas  where Ambientes_idAmbientes = ? ";
            $stmt = $conexion->prepare($consulta);
            $stmt->bindParam(1, $idAmbientes, PDO::PARAM_INT );
            $stmt->execute();
            return $stmt;
            $conexion = null;
            $stmt= null;

        }


        function consultarNumeroAmbiente($idAmbientes){
            $conexion = $this->db->connect();
            $consulta="SELECT Numero_Ambiente from ambientes where idAmbientes= ?";
            $stmt = $conexion->prepare($consulta);
            $stmt->bindParam(1,$idAmbientes,PDO::PARAM_INT);
            $stmt->execute();
            $resul = $stmt->fetch();
            return $resul;
            $conexion = null;
            $stmt= null;
            $resul= null;
            
        }

        function consultarUbicacion(){

            $conexion = $this->db->connect();
            $consulta="SELECT * FROM ubicacion";
            $stmt = $conexion->prepare($consulta);
            $stmt->execute();
            return $stmt;
            $conexion = null;
            $stmt= null;

        }


        function registrarNovedad($novedad,$idpersona,$idelemento,$fecha){

            $conexion = $this->db->connect();
            $consulta="INSERT INTO novedades  (Persona_idPersona,Descripcion,Fecha_Realizacion,Elementos_idElementos)values (?,?,?,?) ";
            $stmt = $conexion->prepare($consulta);
            $stmt->bindParam(1, $idpersona, PDO::PARAM_INT );
            $stmt->bindParam(2, $novedad, PDO::PARAM_STR );
            $stmt->bindParam(3, $fecha, PDO::PARAM_STR);
            $stmt->bindParam(4, $idelemento, PDO::PARAM_INT );
            $stmt->execute();
            $conexion = null;
            $stmt= null;

        }
         

        function consultarNovedades($idElemento){

            $conexion = $this->db->connect();
            $consulta="SELECT Descripcion,Numero_Documento,Nombre,Apellido_Primero,Fecha_Realizacion FROM novedades   JOIN persona ON novedades.Persona_idPersona = persona.idPersona WHERE Elementos_idElementos = ?";
            $stmt = $conexion->prepare($consulta);
            $stmt->bindParam(1, $idElemento, PDO::PARAM_INT );
            $stmt->execute();
            return $stmt;
            $conexion = null;
            $stmt= null;


        }

 



     


 
   
    
    
}

?>