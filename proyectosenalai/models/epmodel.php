<?php

class epmodel extends Model
{
    function __construct()
    {
        parent::__construct();

    }
    function consultarElementos(){
        $conexion = $this->db->connect();
        $consulta="SELECT Fecha_inicial, Numero_Documento, Nombre,Apellido_Primero,Apellido_Segundo, Placa_Equipo, Numero_Serial, NombreTipoElemento, elementos.Descripcion,tipoJornada, NombreUbicacion, Numero_Ambiente FROM prestamos INNER JOIN jornada ON prestamos.jornada_idJornada = jornada.idJornada 
        INNER JOIN ep ON ep.Prestamo_idPrestamo = prestamos.idPrestamos 
        INNER JOIN elementos ON ep.Elementos_idElementos = elementos.idElementos 
        INNER JOIN tipo_elementos ON elementos.Tipo_Equipo_idTipo_Equipo = tipo_elementos.idTipo_Elementos 
        INNER JOIN detalleambiente ON elementos.idElementos = detalleambiente.Elementos_idElementos 
        INNER JOIN ambientes ON detalleambiente.Ambientes_idAmbientes = ambientes.idAmbientes 
        INNER JOIN ubicacion ON ambientes.Ubicacion_idUbicacion = ubicacion.idUbicacion 
        INNER JOIN detallecuentadante ON ambientes.idAmbientes = detallecuentadante.Ambientes_idAmbientes
        INNER JOIN persona ON detallecuentadante.Cuentadante = persona.idPersona
        INNER JOIN tipo_documento ON persona.Tipo_Documento_idTipo_Documento = tipo_documento.idTipo_Documento
        WHERE detalleambiente.Ambientes_idAmbientes in (2,3,4,5,6,7,8,9,10,11) and detalleambiente.Estado_E = 1";

        $stmt = $conexion->prepare($consulta);
        $stmt->execute();
        return $stmt;
        $conexion = null;
        $stmt= null;      
    }

}
?>