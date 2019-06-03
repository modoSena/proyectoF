<?php

class marca extends Controller{


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

        $this->view->query=$this->model->consultarMarcas();
        $this->view->render('marca/index');
    }


    function actualizarMarcas($param){
        session_start();

        if ( $_SESSION['usuario'] ==""  and  $_SESSION['contrasena'] =="" || $_SESSION['Roles_idRoles'] != 4 ) {
            header('Location:'.constant('URL').'login');
            die();        
        }
     $this->view->idMarcas = $param[0];
     $this->view->valores = $this->model->consultarMarca($this->view->idMarcas);
     $this->view->render('marca/actualizarMarcas');
    }   

    function actualizarMarca(){
        session_start();
        if ( $_SESSION['usuario'] ==""  and  $_SESSION['contrasena'] =="" or $_SESSION['Roles_idRoles'] != 4 ) {
          header('Location:'.constant('URL').'login');
          die();        
      }
        
         
        if (isset($_POST["envioActualizoMarca"])){
        
          
          $idMarcas = $_POST['idMarcas'];
          $Marca = $_POST['Marca'];
          
          $this->r = $this->model->validarNombreMarca($Marca);

          $this->comparador = $this->model->consultarMarca($idMarcas);

           if ($Marca == "") {
            echo '<div class="alert alert-danger">
            <strong>ERROR!</strong>  El campo marca no puede ir vacío.
            </div>';
           

            }else if ($this->comparador['Marca'] != $Marca && $this->r > 0) {
            echo '<div class="alert alert-danger">
            <strong>ERROR!</strong>  La marca ya existe.
            </div>';
          }else {
            $this->model->actualizarMarca($idMarcas,$Marca);
            echo 1 ;
          }
        }
    }

    function  registrarMarcas(){
        session_start();
  
        if ( $_SESSION['usuario'] ==""  and  $_SESSION['contrasena'] =="" or $_SESSION['Roles_idRoles'] != 4 ) {
          header('Location:'.constant('URL').'login');
          die();        
      }
      $this->view->render('marca/registrarMarcas');
      }

      function  registrarMarca(){

        session_start();
        if ( $_SESSION['usuario'] ==""  and  $_SESSION['contrasena'] =="" or $_SESSION['Roles_idRoles'] != 4 ) {
          header('Location:'.constant('URL').'login');
          die();        
      }
        
      if (isset($_POST["envioRegistroMarca"])){
        
          
        $Marca = $_POST['Marca'];
        
        $this->r = $this->model->validarNombreMarca($Marca);


         if ($Marca == "") {
          echo '<div class="alert alert-danger">
          <strong>ERROR!</strong>  El campo marca no puede ir vacío.
          </div>';
         

          }else if ( $this->r > 0) {
          echo '<div class="alert alert-danger">
          <strong>ERROR!</strong>  La marca ya existe.
          </div>';
        }else {
          $this->model->registrarMarca($Marca);
          echo 1 ;
        }
      }
      }

}

?>