<?php

class elementosModel extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    function consultarElementos(){
        $conexion = $this->db->connect();
        $consulta="SELECT idDetalleAmbiente,Fecha_Novedad,Descripcion,Numero_Ambiente,NombreUbicacion,Fecha_Entrada,Fecha_Salida,idElementos,Ambientes_idAmbientes,Numero_Serial,Placa_Equipo,Tipo_Equipo_idTipo_Equipo,Marca,Estado_Elementos_idEstado_Elementos,NombreEstado,NombreTipoElemento FROM  detalleambiente JOIN ambientes on detalleambiente.Ambientes_idAmbientes = Ambientes.idAmbientes  JOIN ubicacion ON ambientes.Ubicacion_idUbicacion=ubicacion.idUbicacion  JOIN elementos on detalleambiente.Elementos_idElementos = elementos.idElementos JOIN tipo_elementos ON elementos.Tipo_Equipo_idTipo_Equipo=tipo_elementos.idTipo_Elementos JOIN estado_elementos ON elementos.Estado_Elementos_idEstado_Elementos=estado_elementos.idEstado_Elementos  JOIN Marcas ON elementos.Marcas_idMarcas =Marcas.idMarcas  where   Estado_E = 1";
        $stmt = $conexion->prepare($consulta);
        $stmt->execute();
        return $stmt;
        $conexion = null;
        $stmt= null; 
    }

    function consultarElemento($idElementos){
        $conexion = $this->db->connect();
        $consulta="SELECT Tipo_Equipo_idTipo_Equipo,marcas_idMarcas,idElementos,Numero_Serial,Placa_Equipo,Descripcion,Marca,NombreTipoElemento from elementos JOIN tipo_elementos ON elementos.Tipo_Equipo_idTipo_Equipo=tipo_elementos.idTipo_Elementos JOIN Marcas ON elementos.Marcas_idMarcas =Marcas.idMarcas where idElementos = ?" ;
        $stmt = $conexion->prepare($consulta);
        $stmt->bindParam(1, $idElementos, PDO::PARAM_INT );
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
        $conexion = null;
        $stmt= null;
        $result = null;
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

     function  registrarElemento($Placa_Equipo,$Numero_Serial,$idTipo_Elementos,$marca,$Descripcion){
        ini_set('date.timezone','America/Bogota'); 
        $fechaentrada = date("Y-m-d H:i:s");
        $estadoElementos =1;
        $conexion = $this->db->connect();
        $consulta  ="INSERT into elementos(Numero_Serial,Placa_Equipo,Tipo_Equipo_idTipo_Equipo,Fecha_Entrada,Estado_Elementos_idEstado_Elementos,Marcas_idMarcas,Descripcion) values (?,?,?,?,?,?,?)";
        $stmt=$conexion->prepare($consulta);
        $stmt->bindParam(1,$Numero_Serial,PDO::PARAM_INT);
        $stmt->bindParam(2,$Placa_Equipo, PDO::PARAM_INT);
        $stmt->bindParam(3,$idTipo_Elementos, PDO::PARAM_INT);
        $stmt->bindParam(4,$fechaentrada, PDO::PARAM_STR);
        $stmt->bindParam(5,$estadoElementos, PDO::PARAM_INT);
        $stmt->bindParam(6,$marca, PDO::PARAM_INT);
        $stmt->bindParam(7,$Descripcion, PDO::PARAM_STR);
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

    public function  actualizarElemento($idElementos,$Placa_Equipo,$Numero_Serial,$idTipo_Elementos,$marca,$Descripcion){
        $conexion = $this->db->connect();
        $consulta  ="UPDATE  elementos  set Placa_Equipo = ? ,Numero_Serial = ? ,Tipo_Equipo_idTipo_Equipo = ? ,marcas_idMarcas = ? ,Descripcion = ? where idElementos = ? ";
        $stmt=$conexion->prepare($consulta);
        $stmt->bindParam(1,$Placa_Equipo, PDO::PARAM_INT);
        $stmt->bindParam(2,$Numero_Serial,PDO::PARAM_STR);
        $stmt->bindParam(3,$idTipo_Elementos,PDO::PARAM_STR);
        $stmt->bindParam(4,$marca,PDO::PARAM_STR);
        $stmt->bindParam(5,$Descripcion,PDO::PARAM_STR);
        $stmt->bindParam(6,$idElementos,PDO::PARAM_STR);
        $stmt->execute();
    } 

    public function  consultarDatosParaComparar($idElementos){
        $conexion = $this->db->connect();
        $consulta  ="SELECT Placa_Equipo ,Numero_Serial FROM elementos WHERE idElementos = '$idElementos' ";
        $stmt = $conexion->prepare($consulta);
        $stmt->bindParam(':idElementos',$idElementos,PDO::PARAM_INT);
        $stmt->execute();
        $resul = $stmt->fetch();
        return $resul;
        $conexion = null;
        $stmt= null;
        $resul= null;
    }


    
    function consultarUbicacion(){

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
    function consultaridELementoPorPlacaequipo($placa){

        $conexion = $this->db->connect();
        $consulta="SELECT idElementos FROM elementos where Placa_Equipo = ?  ";
        $stmt = $conexion->prepare($consulta);
        $stmt->bindParam(1,$placa, PDO::PARAM_INT);
        $stmt->execute();
        $resul = $stmt->fetch();
        return $resul;
        $conexion = null;
        $stmt= null;
        $resul= null;
        
    }

    function  ibicacionInicial($idElemento,$ambiente){
        ini_set('date.timezone','America/Bogota'); 
        $fechaentrada = date("Y-m-d H:i:s");
        $estadoElementos =1;
        $conexion = $this->db->connect();
        $consulta  ="INSERT into detalleambiente(Fecha_Novedad,Elementos_idElementos,Ambientes_idAmbientes,Estado_E) values (?,?,?,?)";
        $stmt=$conexion->prepare($consulta);
        $stmt->bindParam(1,$fechaentrada,PDO::PARAM_INT);
        $stmt->bindParam(2,$idElemento, PDO::PARAM_INT);
        $stmt->bindParam(3,$ambiente, PDO::PARAM_INT);
        $stmt->bindParam(4,$estadoElementos, PDO::PARAM_INT);
        $stmt->execute();  
    }



    function  destivarElementosDelAmbiente($idElementos){
        ini_set('date.timezone','America/Bogota'); 
        $estadoElementos =2;
        $fechasalida = date("Y-m-d H:i:s");
        $conexion = $this->db->connect();
        $consulta  ="UPDATE DetalleAmbiente set Estado_E = ?, Novedad_Fecha_Salida = ? where idDetalleAmbiente = ?";
        $stmt=$conexion->prepare($consulta);
        $stmt->bindParam(1,$estadoElementos,PDO::PARAM_INT);
        $stmt->bindParam(2,$fechasalida,PDO::PARAM_STR);
        $stmt->bindParam(3,$idElementos,PDO::PARAM_INT);
        $stmt->execute();  
    }


    function consultaridELementoPoridDetalleambiente($idDetalleambiente){

        $conexion = $this->db->connect();
        $consulta="SELECT Elementos_idElementos FROM DetalleAmbiente where idDetalleAmbiente = ?  ";
        $stmt = $conexion->prepare($consulta);
        $stmt->bindParam(1,$idDetalleambiente, PDO::PARAM_INT);
        $stmt->execute();
        $resul = $stmt->fetch();
        return $resul;
        $conexion = null;
        $stmt= null;
        $resul= null;
        
    }


    function consultarHistorialElemento($idElemento){

        $conexion = $this->db->connect();
        $consulta="SELECT idDetalleAmbiente,Fecha_Novedad,Novedad_Fecha_Salida,Numero_Ambiente,NombreUbicacion,Numero_Serial,Placa_Equipo,Marca,NombreEstado,NombreTipoElemento FROM  detalleambiente JOIN ambientes on detalleambiente.Ambientes_idAmbientes = Ambientes.idAmbientes  JOIN ubicacion ON ambientes.Ubicacion_idUbicacion=ubicacion.idUbicacion  JOIN elementos on detalleambiente.Elementos_idElementos = elementos.idElementos JOIN tipo_elementos ON elementos.Tipo_Equipo_idTipo_Equipo=tipo_elementos.idTipo_Elementos JOIN estado_elementos ON elementos.Estado_Elementos_idEstado_Elementos=estado_elementos.idEstado_Elementos  JOIN Marcas ON elementos.Marcas_idMarcas =Marcas.idMarcas  where idElementos = ? and  Estado_E = 2 ";
        $stmt = $conexion->prepare($consulta);
        $stmt->bindParam(1,$idElemento, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
        $conexion = null;
        $stmt= null;

        
    }



    
}
?>