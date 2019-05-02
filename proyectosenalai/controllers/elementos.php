<?php

class elementos extends Controller{


    function __construct()
    {
        parent::__construct();
    
        
    }

    function render(){
        session_start();

        if ( $_SESSION['usuario'] ==""  and  $_SESSION['contrasena'] =="" || $_SESSION['Roles_idRoles'] != 4 ) {
            header('Location:'.constant('URL').'login');
            die();        
        }

        $this->view->query = $this->model->consultarElementos();
        $this->view->render('elementos/index');
    }


    function registrarElementos(){
        session_start();

        if ( $_SESSION['usuario'] ==""  and  $_SESSION['contrasena'] =="" or $_SESSION['Roles_idRoles'] !=4 ) {
            header('Location:'.constant('URL').'login');
            die();
          }
        $this->view->consultarUbicaion = $this->model->consultarUbicaion();
        $this->view->consultarTipoEquipos = $this->model->consultarTipoEquipos();
        $this->view->consultarMarca = $this->model->consultarMarca();
        $this->view->render('elementos/registrarElementos');   
    }


    function ambientesPorUbicacion(){

        if (isset($_POST['consulta'])) {
            $q = $_POST['consulta'];
                  
                        
            $this->view->query = $this->model->consultarAmbientePorUbicacion($q);
                        
         
               
               
            if ($this->view->query->rowCount() > 0) {
                     
               
               
               
               $salida = "<label>Ambiente</label>";
               
               $salida .="<select class='form-control' id='ambiente' name='ambiente'> ";
               
               $salida .="<option value=''>selecciona:</option>";
               
               foreach($this->view->query as $resultado ){ 
               
               
                  $salida .= "<option value=".$resultado['idAmbientes'].">" .$resultado['Numero_Ambiente'].  "</option>";
               
               
               } 
               
               $salida .="</select>";
               
               
               
               
               
               
                     
               }else{
                  $salida = "<label>Ambiente</label>";
               
                  $salida .="<select class='form-control' id='ambiente' name='ambiente'> ";
               
                  $salida .="<option value='' >No hay resultados :</option>";
               
               
               
               
                  
               
               
               
               
               $salida .="</select>";
               }
               
               echo $salida;
               
               } 
    }

    function registrarElemento(){

        session_start();
        if ( $_SESSION['usuario'] ==""  and  $_SESSION['contrasena'] =="" or $_SESSION['Roles_idRoles'] !=4 ) {
            header('Location:'.constant('URL').'login');
            die();
          }

        if (isset($_POST["envioRegistroElemento"])) {

            $Numero_Serial = $_POST['Numero_Serial'];
            $Placa_Equipo = $_POST['Placa_Equipo'];
            $ubicacion = $_POST['ubicacion'];
            $ambiente = $_POST['ambiente'];
            $idTipo_Elementos = $_POST['idTipo_Elementos'];
            $marca = $_POST['marca'];


            //---- validar que numero de serial no exista ----- ///

            $this->view->t = $this->model->validarNumeroSerial($Numero_Serial);

            $this->view->u = $this->model->validarPlacaEquipo($Placa_Equipo);



                              //---- VALIDACIONES ----- ///
                     
                        //Si esta vacio  
                        if($Numero_Serial == "" ){                        
                        
                            echo '<div class="alert alert-danger">
                            <strong>ERROR!</strong>  El campo Numero Serial no puede ir vacio.
                            </div>';
                         }else if(!preg_match("/^[0-9]+$/",$Numero_Serial)){
                            echo '<div class="alert alert-danger">
                            <strong>ERROR!</strong>  El campo Numero Serial solo debe contener Numeros.
                            </div>';

                         }else if ($this->view->t > 0) {
                            echo '<div class="alert alert-danger">
                            <strong>ERROR!</strong>  El  Numero Serial ya existe.
                            </div>';
                             
                         } else if($Placa_Equipo == "" ){                        
                        
                            echo '<div class="alert alert-danger">
                            <strong>ERROR!</strong>  El campo  Placa Equipo no puede ir vacio.
                            </div>';
                         }else if(!preg_match("/^[0-9]+$/",$Placa_Equipo)){
                            echo '<div class="alert alert-danger">
                            <strong>ERROR!</strong>  El campo Placa Equipo solo debe contener Numeros.
                            </div>';

                         }else if ($this->view->u > 0) {
                            echo '<div class="alert alert-danger">
                            <strong>ERROR!</strong>  El Numero  Placa Equipo ya existe.
                            </div>';
                             
                         }else if($ubicacion ==""){
                            echo '<div class="alert alert-danger">
                            <strong>ERROR!</strong>  Seleccione una ubicacion.
                            </div>';
                         
                        }else if($ambiente ==""){
                            echo '<div class="alert alert-danger">
                            <strong>ERROR!</strong>  Seleccione un ambiente.
                            </div>';
                         

                        }else if( $idTipo_Elementos == ""){
                            echo '<div class="alert alert-danger">
                            <strong>ERROR!</strong>  Seleccione un Tipo de elemento.
                            </div>';
                         

                        }else if( $marca == ""){
                            echo '<div class="alert alert-danger">
                            <strong>ERROR!</strong>  Seleccione una marca.
                            </div>';
                         }else {
                             $this->model->registrarElemento($Placa_Equipo,$Numero_Serial,$idTipo_Elementos,$marca,$ambiente);
                             echo 1;
                         }
           
        }
    }

}

?>