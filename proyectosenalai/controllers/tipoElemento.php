<?php

class tipoElemento extends Controller{


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

        $this->view->query=$this->model->consultartipoElementos();
        $this->view->render('tipoElemento/index');
    }


    function actualizartipoElementos($param){
        session_start();

        if ( $_SESSION['usuario'] ==""  and  $_SESSION['contrasena'] =="" || $_SESSION['Roles_idRoles'] != 4 ) {
            header('Location:'.constant('URL').'login');
            die();        
        }
     $this->view->idTipo_Elementos = $param[0];
     $this->view->valores = $this->model->consultartipoElemento($this->view->idTipo_Elementos);
     $this->view->render('tipoElemento/actualizartipoElementos');
    }   

    function actualizartipoElemento(){
        session_start();
        if ( $_SESSION['usuario'] ==""  and  $_SESSION['contrasena'] =="" or $_SESSION['Roles_idRoles'] != 4 ) {
          header('Location:'.constant('URL').'login');
          die();        
      }
        
         
        if (isset($_POST["envioActualizotipoElemento"])){
        
          
          $idTipo_Elementos = $_POST['idTipo_Elementos'];
          $NombreTipoElemento = $_POST['NombreTipoElemento'];
          
          $this->r = $this->model->validarNombretipoElemento($NombreTipoElemento);

          $this->comparador = $this->model->consultartipoElemento($idTipo_Elementos);

           if ($NombreTipoElemento == "") {
            echo '<div class="alert alert-danger">
            <strong>ERROR!</strong>  El campo tipo elemento no puede ir vacio.
            </div>';
           

            }else if ($this->comparador['NombreTipoElemento'] != $NombreTipoElemento && $this->r > 0) {
            echo '<div class="alert alert-danger">
            <strong>ERROR!</strong>  El tipo elemento ya existe.
            </div>';
          }else {
            $this->model->actualizartipoElemento($idTipo_Elementos,$NombreTipoElemento);
            echo 1 ;
          }
        }
    }

    function  registrartipoElementos(){
        session_start();
  
        if ( $_SESSION['usuario'] ==""  and  $_SESSION['contrasena'] =="" or $_SESSION['Roles_idRoles'] != 4 ) {
          header('Location:'.constant('URL').'login');
          die();        
      }
      $this->view->render('tipoElemento/registrartipoElementos');
      }

      function  registrartipoElemento(){

        session_start();
        if ( $_SESSION['usuario'] ==""  and  $_SESSION['contrasena'] =="" or $_SESSION['Roles_idRoles'] != 4 ) {
          header('Location:'.constant('URL').'login');
          die();        
      }
        
      if (isset($_POST["envioRegistrotipoElemento"])){
        
          
        $NombreTipoElemento = $_POST['NombreTipoElemento'];
        
        $this->r = $this->model->validarNombretipoElemento($NombreTipoElemento);


         if ($NombreTipoElemento == "") {
          echo '<div class="alert alert-danger">
          <strong>ERROR!</strong>  El campo tipo elemento no puede ir vacio.
          </div>';
         

          }else if ( $this->r > 0) {
          echo '<div class="alert alert-danger">
          <strong>ERROR!</strong>  El tipo elemento ya existe.
          </div>';
        }else {
          $this->model->registrartipoElemento($NombreTipoElemento);
          echo 1 ;
        }
      }
      }

}

?>