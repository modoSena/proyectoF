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
        $this->view->consultarUbicacion = $this->model->consultarUbicacion();
        $this->view->query = $this->model->consultarElementos();
        $this->view->queryy = $this->model->consultarElementos();
        $this->view->render('elementos/index');
    }

    function registrarElementos(){
        session_start();

        if ( $_SESSION['usuario'] ==""  and  $_SESSION['contrasena'] =="" or $_SESSION['Roles_idRoles'] !=4 ) {
            header('Location:'.constant('URL').'login');
            die();
          }
        $this->view->consultarUbicacion = $this->model->consultarUbicacion();  
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

    function moverElementos(){
        session_start();
        if ( $_SESSION['usuario'] ==""  and  $_SESSION['contrasena'] =="" or $_SESSION['Roles_idRoles'] !=4 ) {
            header('Location:'.constant('URL').'login');
            die();
          }

          if (isset($_POST['envioMoverElemento'])) {
              
          
            $ambiente = $_POST['ambiente'];

           if($ambiente == "" ){                        
                        
            echo '<div class="alert alert-danger">
            <strong>ERROR!</strong> Selecciona un ambiente.
            </div>';
           }else if (!isset($_POST['idsElementos'])) {
            echo '<div class="alert alert-danger">
            <strong>ERROR!</strong> No hay elementos seleccionados.
            </div>';
           }else {
            $idElementos =  $_POST['idsElementos'];
            
            foreach ($idElementos as $idElemento ) {
                $this->model->destivarElementosDelAmbiente($idElemento);
                $this->model->ibicacionInicial($idElemento,$ambiente);
            }           
            echo 1;
           }
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
            $idTipo_Elementos = $_POST['idTipo_Elementos'];
            $marca = $_POST['marca'];
            $Descripcion = $_POST['Descripcion'];
            $marca = $_POST['marca'];
            $Descripcion = $_POST['Descripcion'];
            $ubicacion = $_POST['ubicacion'];
            $ambiente = $_POST['ambiente'];


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
                        } else if($Descripcion == "" ){                        
                        
                            echo '<div class="alert alert-danger">
                            <strong>ERROR!</strong>  El campo descripcion equipo no puede ir vacio.
                            </div>';
                         }else if ($this->view->u > 0) {
                            echo '<div class="alert alert-danger">
                            <strong>ERROR!</strong>  El Numero  Placa Equipo ya existe.
                            </div>';
                        }else if( $idTipo_Elementos == ""){
                            echo '<div class="alert alert-danger">
                            <strong>ERROR!</strong>  Seleccione un Tipo de elemento.
                            </div>';
                         

                        }else if( $marca == ""){
                            echo '<div class="alert alert-danger">
                            <strong>ERROR!</strong>  Seleccione una marca.
                            </div>';


                        } else if($ambiente == "" ){                        
                        
                            echo '<div class="alert alert-danger">
                            <strong>ERROR!</strong>  seleccione un ambiente.
                            </div>';   
                         }else {
                             $this->model->registrarElemento($Placa_Equipo,$Numero_Serial,$idTipo_Elementos,$marca,$Descripcion);
                             $resultIdElemento = $this->model->consultaridELementoPorPlacaequipo($Placa_Equipo);
                             $idElemento = $resultIdElemento['idElementos'];
                             $this->model->ibicacionInicial($idElemento,$ambiente); 
                             echo 1;
                         }
           
        }
    }



    function inhabilitarElemento($param){
    session_start();
    if ( $_SESSION['usuario'] ==""  and  $_SESSION['contrasena'] =="" or $_SESSION['Roles_idRoles'] !=4 ) {
        header('Location:'.constant('URL').'login');
        die();
      }
     $idElemento = $param[0];
     $this->model->inhabilitarElemento($idElemento);
     header("Location:".constant('URL').'elementos');
    }

    function habilitarElemento($param){
        session_start();
    if ( $_SESSION['usuario'] ==""  and  $_SESSION['contrasena'] =="" or $_SESSION['Roles_idRoles'] !=4 ) {
        header('Location:'.constant('URL').'login');
        die();
      }
     $idElemento = $param[0];
     $this->model->hablitarelemento($idElemento);
     header("Location:".constant('URL').'elementos');

    }

    function actualizarElementos($param = null){
        session_start();

        if ( $_SESSION['usuario'] ==""  and  $_SESSION['contrasena'] =="" || $_SESSION['Roles_idRoles'] != 4 ) {
            header('Location:'.constant('URL').'login');
            die();        
        }
     $this->view->idElementos = $param[0];
     $this->view->consultarTipoEquipos = $this->model->consultarTipoEquipos();
     $this->view->consultarMarca = $this->model->consultarMarca();
     $this->view->valores = $this->model->consultarElemento($this->view->idElementos);
     $this->view->render('elementos/actualizarElementos');
    }   

      function actualizarElemento(){
        session_start();
        if ( $_SESSION['usuario'] ==""  and  $_SESSION['contrasena'] =="" or $_SESSION['Roles_idRoles'] != 4 ) {
          header('Location:'.constant('URL').'login');
          die();        
      }
        
         
        if (isset($_POST["envioActualizoElemento"])){
        
            $idElementos = $_POST['idElementos'];
            $Numero_Serial = $_POST['Numero_Serial'];
            $Placa_Equipo = $_POST['Placa_Equipo'];
            $idTipo_Elementos = $_POST['idTipo_Elementos'];
            $marca = $_POST['marca'];
            $Descripcion = $_POST['Descripcion'];


            //---- validar que numero de serial no exista ----- ///
            $this->comparador = $this->model->consultarDatosParaComparar($idElementos);
            $this->t = $this->model->validarNumeroSerial($Numero_Serial);
            $this->u = $this->model->validarPlacaEquipo($Placa_Equipo);

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

                         }else if($this->comparador['Numero_Serial'] != $Numero_Serial && $this->t > 0 ){
         
                            echo '<div class="alert alert-danger">
                            <strong>ERROR!</strong>  El numero serial ya ha sido registrado, intenta con otro.
                            </div>';
                            
                         } else if($Placa_Equipo == "" ){                        
                        
                            echo '<div class="alert alert-danger">
                            <strong>ERROR!</strong>  El campo  Placa Equipo no puede ir vacio.
                            </div>';
                         }else if(!preg_match("/^[0-9]+$/",$Placa_Equipo)){
                            echo '<div class="alert alert-danger">
                            <strong>ERROR!</strong>  El campo Placa Equipo solo debe contener Numeros.
                            </div>';
                            
                         }else if($this->comparador['Placa_Equipo'] != $Placa_Equipo && $this->u > 0 ){
         
                            echo '<div class="alert alert-danger">
                            <strong>ERROR!</strong>  La Placa Equipo ya ha sido registrado, intenta con otro.
                            </div>';
   
                           
                        } else if($Descripcion == "" ){                        
                        
                            echo '<div class="alert alert-danger">
                            <strong>ERROR!</strong>  El campo descripcion equipo no puede ir vacio.
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
                             $this->model->actualizarElemento($idElementos,$Placa_Equipo,$Numero_Serial,$idTipo_Elementos,$marca,$Descripcion);
                             echo 1;
                         }
        }
    }
}

?>