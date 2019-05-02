<?php

class programa extends Controller{


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

        $this->view->query=$this->model->consultarProgramas();
        $this->view->render('programa/index');
    }


    function actualizarProgramas($param){
        session_start();

        if ( $_SESSION['usuario'] ==""  and  $_SESSION['contrasena'] =="" || $_SESSION['Roles_idRoles'] != 4 ) {
            header('Location:'.constant('URL').'login');
            die();        
        }
     $this->view->idPrograma = $param[0];
     $this->view->valores = $this->model->consultarPrograma($this->view->idPrograma);
     $this->view->render('programa/actualizarProgramas');
    }   

    function actualizarPrograma(){
        session_start();
        if ( $_SESSION['usuario'] ==""  and  $_SESSION['contrasena'] =="" or $_SESSION['Roles_idRoles'] != 4 ) {
          header('Location:'.constant('URL').'login');
          die();        
      }
        
         
        if (isset($_POST["envioActualizoPrograma"])){
        
          
          $idPrograma = $_POST['idPrograma'];
          $NombrePrograma = $_POST['NombrePrograma'];
          
          $this->r = $this->model->validarNombrePrograma($NombrePrograma);

          $this->comparador = $this->model->consultarPrograma($idPrograma);

           if ($NombrePrograma == "") {
            echo '<div class="alert alert-danger">
            <strong>ERROR!</strong>  El campo programa no puede ir vacio.
            </div>';
           

            }else if ($this->comparador['NombrePrograma'] != $NombrePrograma && $this->r > 0) {
            echo '<div class="alert alert-danger">
            <strong>ERROR!</strong>  El programa ya existe.
            </div>';
          }else {
            $this->model->actualizarPrograma($idPrograma,$NombrePrograma);
            echo 1 ;
          }
        }
    }

    function  registrarProgramas(){
        session_start();
  
        if ( $_SESSION['usuario'] ==""  and  $_SESSION['contrasena'] =="" or $_SESSION['Roles_idRoles'] != 4 ) {
          header('Location:'.constant('URL').'login');
          die();        
      }
      $this->view->render('programa/registrarProgramas');
      }

      function  registrarPrograma(){

        session_start();
        if ( $_SESSION['usuario'] ==""  and  $_SESSION['contrasena'] =="" or $_SESSION['Roles_idRoles'] != 4 ) {
          header('Location:'.constant('URL').'login');
          die();        
      }
        
      if (isset($_POST["envioRegistroPrograma"])){
        
          
        $NombrePrograma = $_POST['NombrePrograma'];
        
        $this->r = $this->model->validarNombrePrograma($NombrePrograma);


         if ($NombrePrograma == "") {
          echo '<div class="alert alert-danger">
          <strong>ERROR!</strong>  El campo programa no puede ir vacio.
          </div>';
         

          }else if ( $this->r > 0) {
          echo '<div class="alert alert-danger">
          <strong>ERROR!</strong>  El programa ya existe.
          </div>';
        }else {
          $this->model->registrarPrograma($NombrePrograma);
          echo 1 ;
        }
      }
      }

}

?>