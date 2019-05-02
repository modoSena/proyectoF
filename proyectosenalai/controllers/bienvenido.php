<?php

class bienvenido extends Controller{


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
        $this->view->render('bienvenido/index');
    }

}

?>