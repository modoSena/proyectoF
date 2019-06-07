<?php

class ep extends Controller{


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
        $this->view->query=$this->model->consultarElementos();
        $this->view->render('ep/index');
  }
}
?>