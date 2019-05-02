<?php

class elementosModel extends Model
{
    function __construct()
    {
        parent::__construct();

    }


    function consultarElementos(){

        $conexion = $this->db->connect();
        $consulta="SELECT idElementos,Ambientes_idAmbientes,Numero_Serial,Placa_Equipo,Tipo_Equipo_idTipo_Equipo,Fecha_Salida,Fecha_Entrada,Marca,Estado_Elementos_idEstado_Elementos,NombreEstado,NombreTipoElemento,Numero_Ambiente,idAmbientes,idUbicacion,NombreUbicacion from elementos JOIN tipo_elementos ON elementos.Tipo_Equipo_idTipo_Equipo=tipo_elementos.idTipo_Elementos JOIN estado_elementos ON elementos.Estado_Elementos_idEstado_Elementos=estado_elementos.idEstado_Elementos  JOIN Marcas ON elementos.Marcas_idMarcas =Marcas.idMarcas JOIN ambientes ON elementos.Ambientes_idAmbientes = ambientes.idAmbientes JOIN ubicacion ON ambientes.Ubicacion_idUbicacion = ubicacion.idUbicacion ";
        $stmt = $conexion->prepare($consulta);
        $stmt->execute();
        return $stmt;
        $conexion = null;
        $stmt= null;
        
    }

    function consultarTipoEquipos(){

        $conexion = $this->db->connect();
        $consulta="SELECT * FROM  tipo_elementos ";
        $stmt = $conexion->prepare($consulta);
        $stmt->execute();
        return $stmt;
        $conexion = null;
        $stmt= null;
        
    }

    function consultarMarca(){

        $conexion = $this->db->connect();
        $consulta="SELECT * FROM  Marcas  ";
        $stmt = $conexion->prepare($consulta);
        $stmt->execute();
        return $stmt;
        $conexion = null;
        $stmt= null;
        
    }



    function consultarUbicaion(){

        $conexion = $this->db->connect();
        $consulta="SELECT * FROM  ubicacion  ";
        $stmt = $conexion->prepare($consulta);
        $stmt->execute();
        return $stmt;
        $conexion = null;
        $stmt= null;
        
    }




    function consultarAmbientePorUbicacion($idUbicacion){

        $conexion = $this->db->connect();
        $consulta=" SELECT idAmbientes,Numero_Ambiente FROM ambientes where Ubicacion_idUbicacion = ? ";
        $stmt = $conexion->prepare($consulta);
        $stmt->bindParam(1,$idUbicacion, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
        $conexion = null;
        $stmt= null;
        
    }


    function validarPlacaEquipo($Placa_Equipo){

        $conexion = $this->db->connect();
        $consulta="SELECT idElementos  FROM elementos where Placa_Equipo = ? ";
        $stmt = $conexion->prepare($consulta);
        $stmt->bindParam(1,$Placa_Equipo, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
        $conexion = null;
        $stmt= null;
        $result = null;  
        
    }


    function validarNumeroSerial($Numero_Serial){

        $conexion = $this->db->connect();
        $consulta="SELECT idElementos  FROM elementos where Numero_Serial = ? ";
        $stmt = $conexion->prepare($consulta);
        $stmt->bindParam(1,$Numero_Serial, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
        $conexion = null;
        $stmt= null;
        $result = null;  
        
    }


    public function  registrarElemento($Placa_Equipo,$Numero_Serial,$idTipo_Elementos,$marca,$ambiente){

        ini_set('date.timezone','America/Bogota'); 
        $fechaentrada = date("Y-m-d H:i:s");
        $estadoElementos =1;

        $conexion = $this->db->connect();
        $consulta  ="INSERT into elementos(Ambientes_idAmbientes,Numero_Serial,Placa_Equipo,Tipo_Equipo_idTipo_Equipo,Fecha_Entrada,Estado_Elementos_idEstado_Elementos,Marcas_idMarcas) values (?,?,?,?,?,?,?)";
        $stmt=$conexion->prepare($consulta);

        $stmt->bindParam(1,$ambiente,PDO::PARAM_INT);
        $stmt->bindParam(2,$Numero_Serial, PDO::PARAM_INT);
        $stmt->bindParam(3,$Placa_Equipo,PDO::PARAM_INT);
        $stmt->bindParam(4,$idTipo_Elementos,PDO::PARAM_INT);
        $stmt->bindParam(5,$fechaentrada,PDO::PARAM_STR);
        $stmt->bindParam(6,$estadoElementos,PDO::PARAM_INT);
        $stmt->bindParam(7,$marca,PDO::PARAM_INT);
  
        $stmt->execute();  
    }



    function inhabilitarElemento($idElementos){

        $conexion = $this->db->connect();
        $consulta="UPDATE elementos set Estado_Elementos_idEstado_Elementos = '2' where idElementos = ? ";
        $stmt = $conexion->prepare($consulta);
        $stmt->bindParam(1,$idElementos,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
        $conexion = null;
        $stmt= null;
        
    }

    function hablitarelemento($idElementos){
        $conexion = $this->db->connect();
        $consulta="UPDATE elementos set Estado_Elementos_idEstado_Elementos = '1' where idElementos = ? ";
        $stmt = $conexion->prepare($consulta);
        $stmt->bindParam(1,$idElementos,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
        $conexion = null;
        $stmt= null;
    }




 

    
    
}

?>


























