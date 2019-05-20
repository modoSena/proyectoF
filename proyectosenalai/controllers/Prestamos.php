<?php
class Prestamos extends Controller{

	public $Mensaje;
	public $Respuesta; 

    function __construct()
    {
        parent::__construct();
        $Mensaje = 'No se pudo ejecutar la aplicación, por favor contacte al administrador.';
		$Respuesta = false; 
    }
    function render(){
        $this->view->query = $this->model->getPrestamos();
        $this->view->render('Prestamo/index');
    }
    function addprestamo(){
    	session_start();
    	$this->view->render('Prestamo/registrarPrestamo');
    }
    function obtenerElementos(){
    	$this->model->getElementos($_POST['tipoElemento'], $_POST['slJornadas'], $_POST['dtFechaInicial']);
    	$respuestaJson = array('Objeto' => $this->model->Object);

		echo json_encode($respuestaJson);
    }
    function obtenerElementosByPrestamo(){
        $this->model->ElementosByPrestamo($_POST['Prestamo']);
        $respuestaJson = array('Objeto' => $this->model->Object);
        echo json_encode($respuestaJson);
    }
    function obtenerPersonas(){
    	$this->model->getPersonas();
    	$respuestaJson = array('Objeto' => $this->model->Object);

		echo json_encode($respuestaJson);
    }
    function actualizarPrestamo(){
        
        $this->model->setidPrestamo($_POST['Prestamo']);
        $this->model->setestadoPrestamo($_POST['Estado']);
        if($this->model->updatePrestamo()){
            $this->Respuesta = true;;
        }else{
            $this->Respuesta = false;
        }
        $this->Mensaje = $this->model->Message;
        $respuestaJson = array('Respuesta' => $this->Respuesta,'Mensaje'=>$this->Mensaje);

        echo json_encode($respuestaJson);
    }
    function obtenerJornadas(){
    	
    	$this->model->getJornadas();
    	$respuestaJson = array('Objeto' => $this->model->Object);

		echo json_encode($respuestaJson);
    }
    function obtenerPrestamos(){

    	$this->model->getPrestamos();
    	$respuestaJson = array('Objeto' => $this->model->Object);
		echo json_encode($respuestaJson);
    }
    function obtenerTipoElementos(){
        $this->model->getTipoElementos();
        $respuestaJson = array('Objeto' => $this->model->Object);
        echo json_encode($respuestaJson);
    }
    function guardarPrestamo(){
        session_start();
    	$this->model->setfechaInicial($_POST['dtFechaInicial']);
        if ($_SESSION['Roles_idRoles'] == 3 || $_SESSION['Roles_idRoles'] == 4) {
            $this->model->setidPersona($_POST['slPersonas']);
        }else{
            $this->model->setidPersona($_SESSION['idPersona']);
        }
    	
    	$this->model->setidJornada($_POST['slJornadas']);
    	
		$this->model->guardarPrestamo();

		if ($this->model->Request) {

			$listaElementos = $_POST['listaElementos'];
			$decodeElements = json_decode($listaElementos, true);
			$Rows = 0;
			foreach ($decodeElements as $key) {
				if(!$this->model->guardarDetallePrestamo($key['idElemento'],$this->model->getidPrestamo())){
					break;
					$Mensaje = 'Se presentó un error al ingresar el detalle '+$key['nombreElemento'];
				}else{
					$Rows += 1;
				}
			}
			if ($Rows == $_POST['cantidadElementos']) {
				$Respuesta = $this->model->Request;
				$Mensaje = $this->model->Message;
			}
		}else{
			$Respuesta = $this->model->Request;
			$Mensaje = $this->model->Message;
		}

    	$respuestaJson = array('Mensaje' => $Mensaje, 'Respuesta' => $Respuesta);
		echo json_encode($respuestaJson);
    }

}

?>