<?php

// Nada es tan grande en la vida como el hombre, si éste es tan grande como su mente. William Hamilton
// Ustedes pueden dar más que esto, todo lo que se propongan lo podrán lograr, así como yo lo hice aquí.

class Prestamosmodel extends Model
{
    # Atributos / Propiedades
    private $_idPrestamo;
    private $_Fecha_inicial;
    private $_Estado_Prestamo;
    private $_Persona_idPersona;
    private $_jornada_idJornada;
    public $Message;
    public $Request;
    public $Object;

    # Encapsulamiento
    function setidPrestamo($idPrestamo){ $this->_idPrestamo = $idPrestamo;}
    function getidPrestamo(){return $this->_idPrestamo;}
    function setfechaInicial($fechaInicial){ $this->_Fecha_inicial = $fechaInicial;}
    function getfechaInicial(){return $this->_Fecha_inicial;}
    function setestadoPrestamo($estadoPrestamo){ $this->_Estado_Prestamo = $estadoPrestamo;}
    function getestadoPrestamo(){return $this->_Estado_Prestamo;}
    function setidPersona($idPersona){ $this->_Persona_idPersona = $idPersona;}
    function getidPersona(){return $this->_Persona_idPersona;}
    function setidJornada($idJornada){ $this->_jornada_idJornada = $idJornada;}
    function getidJornada(){return $this->_jornada_idJornada;}

    #Constructor
    function __construct()
    {
        parent::__construct();
    }

    public function getElementos($tipoElemento, $Jornada, $fechaInicial)
    {

        $Connection = $this->db->connect();
        $SqlCommand = "SELECT elementos.idElementos, elementos.Placa_Equipo, elementos.Descripcion
        FROM elementos
        INNER JOIN detalleambiente ON elementos.idElementos = detalleambiente.Elementos_idElementos
        WHERE elementos.idElementos NOT IN (SELECT ep.Elementos_idElementos
                                            FROM ep
                                            INNER JOIN prestamos ON ep.Prestamo_idPrestamo = prestamos.idPrestamos
                                            WHERE prestamos.jornada_idJornada = :Jornada AND prestamos.Fecha_inicial = :Fecha AND prestamos.Estado_Prestamo = 'E') AND elementos.Estado_Elementos_idEstado_Elementos = 1 AND elementos.Tipo_Equipo_idTipo_Equipo = :tipo AND detalleambiente.Ambientes_idAmbientes in (1,2)";
        $stmt = $Connection->prepare($SqlCommand);
        $stmt->bindValue(":tipo",$tipoElemento, PDO::PARAM_INT);
        $stmt->bindValue(":Jornada",$Jornada, PDO::PARAM_INT);
        $stmt->bindValue(":Fecha",$fechaInicial, PDO::PARAM_STR);
        $stmt->execute();
        $this->Object = array();
        foreach ($stmt as $fila) {
           $objElemento = array('idElemento'=>$fila['idElementos'],'Placa'=>$fila['Placa_Equipo'],'Descripcion' => $fila['Descripcion']);
           array_push($this->Object,$objElemento);
        }
    }
    function ElementosByPrestamo($idPrestamo)
    {
        $Connection = $this->db->connect();
        $SqlCommand = "SELECT elementos.idElementos,elementos.Placa_Equipo,elementos.Numero_Serial, elementos.Descripcion, tipo_elementos.NombreTipoElemento
                        FROM elementos
                        INNER JOIN ep ON elementos.idElementos = ep.Elementos_idElementos
                        INNER JOIN tipo_elementos on elementos.Tipo_Equipo_idTipo_Equipo = tipo_elementos.idTipo_Elementos                  
                        WHERE ep.Prestamo_idPrestamo = $idPrestamo";
        $stmt = $Connection->prepare($SqlCommand);
        $stmt->execute();
        $this->Object = array();
        foreach ($stmt as $fila) {
           $objElemento = array('idElemento'=>$fila['idElementos'],'Placa'=>$fila['Placa_Equipo'],'Serial'=>$fila['Numero_Serial'],'TipoE'=>$fila['NombreTipoElemento'],'Descripcion' => $fila['Descripcion']);
           array_push($this->Object,$objElemento);
        }
    }
    function guardarPrestamo()
    {
        $this->_Estado_Prestamo = "E";
        $Connection = $this->db->connect();
        $SqlCommand = "INSERT INTO prestamos (Fecha_inicial, Estado_Prestamo, Persona_idPersona, jornada_idJornada) VALUES(?,?,?,?)";
        $stmt = $Connection->prepare($SqlCommand);
        $stmt->bindParam(1,$this->_Fecha_inicial,PDO::PARAM_STR);
        $stmt->bindParam(2,$this->_Estado_Prestamo,PDO::PARAM_STR);
        $stmt->bindParam(3,$this->_Persona_idPersona,PDO::PARAM_INT);
        $stmt->bindParam(4,$this->_jornada_idJornada,PDO::PARAM_INT);

        if ($stmt->execute()) {
            $this->Request = true;
            $this->Message = 'Préstamo registrado correctamente!.';
            $this->_idPrestamo = $Connection->lastInsertId();
            $conexion = null;
            $stmt= null;
        }else{
            $this->Request = false;
            $this->Message = 'No se pudo registrar el préstamo.';
        }  
    }
    function guardarDetallePrestamo($Elemento,$Prestamo){
        $Connection = $this->db->connect();
        $SqlCommand = "INSERT INTO ep (Elementos_idElementos,Prestamo_idPrestamo) VALUES (?,?)";
        $stmt = $Connection->prepare($SqlCommand);
        $stmt->bindParam(1,$Elemento,PDO::PARAM_INT);
        $stmt->bindParam(2,$Prestamo,PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        }else{
            return false;
        }
    }
    function getPersonas()
    {
        $Connection = $this->db->connect();
        $SqlCommand = "SELECT * FROM persona";
        $stmt = $Connection->prepare($SqlCommand);
        if ($stmt->execute()) {
            $this->Object = array();
            foreach ($stmt as $fila) {
                $objPersona = array('idPersona' => $fila['idPersona'], 'Nombre' => $fila['Nombre'].' '.$fila['Apellido_Primero'].' - '.$fila['Numero_Documento']);
                array_push($this->Object,$objPersona);
            }
        }
    }
    function getJornadas()
    {
        $Connection = $this->db->connect();
        $SqlCommand = "SELECT * FROM jornada";
        $stmt = $Connection->prepare($SqlCommand);
        if ($stmt->execute()) {
            $this->Object = array();
            foreach ($stmt as $fila) {
                $objJornada = array('idJornada' => $fila['idJornada'], 'tipoJornada' => $fila['tipoJornada']);
                array_push($this->Object,$objJornada);
            }
        }
    }
    function getTipoElementos()
    {
        $Connection = $this->db->connect();
        $SqlCommand = "SELECT idTipo_Elementos, NombreTipoElemento
                        FROM tipo_elementos
                        WHERE idTipo_Elementos IN (SELECT Tipo_Equipo_idTipo_Equipo
                                                    FROM elementos)";
        $stmt = $Connection->prepare($SqlCommand);
        if ($stmt->execute()) {
            $this->Object = array();
            foreach ($stmt as $fila) {
                $objTipoElementos = array('idTipo_Elementos' => $fila['idTipo_Elementos'], 'NombreTipoElemento' => $fila['NombreTipoElemento']);
                array_push($this->Object,$objTipoElementos);
            }
        }
    }
    function getPrestamos()
    {
        session_start();
        $Connection = $this->db->connect();
        if ($_SESSION['Roles_idRoles'] == 3 || $_SESSION['Roles_idRoles'] == 4) {
            $SqlCommand = "SELECT * FROM prestamos join persona on prestamos.Persona_idPersona = persona.idPersona join jornada on prestamos.jornada_idJornada = jornada.idJornada WHERE Estado_Prestamo = 'E'";
        }else{
            $codPersona = $_SESSION['idPersona'];
            $SqlCommand = "SELECT * FROM prestamos join persona on prestamos.Persona_idPersona = persona.idPersona join jornada on prestamos.jornada_idJornada = jornada.idJornada WHERE Persona_idPersona = $codPersona AND Estado_Prestamo = 'E'";
        }
        
        $stmt = $Connection->prepare($SqlCommand);
        $stmt->execute();
        return $stmt;
    }
    function updatePrestamo(){
        $Connection = $this->db->connect();
        $SqlCommand = "UPDATE prestamos SET Estado_Prestamo = '$this->_Estado_Prestamo' WHERE idPrestamos = $this->_idPrestamo";
        $stmt = $Connection->prepare($SqlCommand);
        if($stmt->execute()){
            $this->Message = 'Se realizó la devolución correctamente.';
            return true;
        }else{
            return false;
        }
    }
    
}
?>