<?php

class tipoDocumento extends Controller{


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

        $this->view->query=$this->model->consultartipoDocumentos();
        $this->view->render('tipoDocumento/index');
    }


    function actualizartipoDocumentos($param){
        session_start();

        if ( $_SESSION['usuario'] ==""  and  $_SESSION['contrasena'] =="" || $_SESSION['Roles_idRoles'] != 4 ) {
            header('Location:'.constant('URL').'login');
            die();        
        }
     $this->view->idTipo_Documento = $param[0];
     $this->view->valores = $this->model->consultartipoDocumento($this->view->idTipo_Documento);
     $this->view->render('tipoDocumento/actualizartipoDocumentos');
    }   

    function actualizartipoDocumento(){
        session_start();
        if ( $_SESSION['usuario'] ==""  and  $_SESSION['contrasena'] =="" or $_SESSION['Roles_idRoles'] != 4 ) {
          header('Location:'.constant('URL').'login');
          die();        
      }
        
         
        if (isset($_POST["envioActualizotipoDocumento"])){
        
          
          $idTipo_Documento = $_POST['idTipo_Documento'];
          $Tipo_Documento = $_POST['Tipo_Documento'];
          
          $this->r = $this->model->validarNombretipoDocumento($Tipo_Documento);

          $this->comparador = $this->model->consultartipoDocumento($idTipo_Documento);

           if ($Tipo_Documento == "") {
            echo '<div class="alert alert-danger">
            <strong>ERROR!</strong>  El campo tipo documento no puede ir vacio.
            </div>';
           

            }else if ($this->comparador['Tipo_Documento'] != $Tipo_Documento && $this->r > 0) {
            echo '<div class="alert alert-danger">
            <strong>ERROR!</strong>  El tipo documento ya existe.
            </div>';
          }else {
            $this->model->actualizartipoDocumento($idTipo_Documento,$Tipo_Documento);
            echo 1 ;
          }
        }
    }

    function  registrartipoDocumentos(){
        session_start();
  
        if ( $_SESSION['usuario'] ==""  and  $_SESSION['contrasena'] =="" or $_SESSION['Roles_idRoles'] != 4 ) {
          header('Location:'.constant('URL').'login');
          die();        
      }
      $this->view->render('tipoDocumento/registrartipoDocumentos');
      }

      function  registrartipoDocumento(){

        session_start();
        if ( $_SESSION['usuario'] ==""  and  $_SESSION['contrasena'] =="" or $_SESSION['Roles_idRoles'] != 4 ) {
          header('Location:'.constant('URL').'login');
          die();        
      }
        
      if (isset($_POST["envioRegistrotipoDocumento"])){
        
          
        $Tipo_Documento = $_POST['Tipo_Documento'];
        
        $this->r = $this->model->validarNombretipoDocumento($Tipo_Documento);


         if ($Tipo_Documento == "") {
          echo '<div class="alert alert-danger">
          <strong>ERROR!</strong>  El campo tipo documento no puede ir vacio.
          </div>';
         

          }else if ( $this->r > 0) {
          echo '<div class="alert alert-danger">
          <strong>ERROR!</strong>  El tipo documento ya existe.
          </div>';
        }else {
          $this->model->registrartipoDocumento($Tipo_Documento);
          echo 1 ;
        }
      }
      }

}

?>