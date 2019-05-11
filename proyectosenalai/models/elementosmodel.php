<?php

class elementosModel extends Model
{
    function __construct()
    {
        parent::__construct();

    }

    function consultarElementos(){

        $conexion = $this->db->connect();
        $consulta="SELECT idElementos,Numero_Serial,Placa_Equipo,Fecha_Salida,Fecha_Entrada,Marca,Descripcion,Estado_Elementos_idEstado_Elementos,NombreEstado,NombreTipoElemento from elementos JOIN tipo_elementos ON elementos.Tipo_Equipo_idTipo_Equipo=tipo_elementos.idTipo_Elementos JOIN estado_elementos ON elementos.Estado_Elementos_idEstado_Elementos=estado_elementos.idEstado_Elementos JOIN Marcas ON elementos.Marcas_idMarcas =Marcas.idMarcas";
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


    public function  registrarElemento($Placa_Equipo,$Numero_Serial,$idTipo_Elementos,$marca,$NombreTipoElemento,$Descripcion,$Fecha_Salida){

        ini_set('date.timezone','America/Bogota'); 
        $fechaentrada = date("Y-m-d H:i:s");
        $estadoElementos =1;
        $conexion = $this->db->connect();
        $consulta  ="INSERT into elementos(idElementos,Numero_Serial,Placa_Equipo,Fecha_Entrada,Marca,Estado_Elementos_idEstado_Elementos,NombreTipoElemento,Descripcion) values (?,?,?,?,?,?,?,?)";
        $stmt=$conexion->prepare($consulta);
        $stmt->bindParam(1,$Numero_Serial,PDO::PARAM_INT);
        $stmt->bindParam(2,$Placa_Equipo, PDO::PARAM_INT);
        $stmt->bindParam(3,$Fecha_Salida,PDO::PARAM_INT);
        $stmt->bindParam(4,$fechaentrada,PDO::PARAM_STR);
        $stmt->bindParam(5,$marca,PDO::PARAM_INT);
        $stmt->bindParam(6,$estadoElementos,PDO::PARAM_INT);
        $stmt->bindParam(7,$NombreTipoElemento,PDO::PARAM_INT);
        $stmt->bindParam(8,$Descripcion,PDO::PARAM_INT);
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